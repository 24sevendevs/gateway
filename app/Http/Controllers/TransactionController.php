<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::latest()->paginate(50);
        return view("transactions.index", compact('transactions'));
    }
    public function showCheckDeposit()
    {
        return view("check_deposits");
    }
    public function c2b_confirmation(Request $request)
    {
        // WhiteList Safaricom's IPs
        $ips = ["196.201.214.200", "196.201.214.206", "196.201.213.114", "196.201.214.207", "196.201.214.208", "196.201.213.44", "196.201.212.127", "196.201.212.128", "196.201.212.129", "196.201.212.132", "196.201.212.136", "196.201.212.138", "196.201.212.69", "196.201.212.74"];
        $current_ip = $request->ip();
        if (!in_array($current_ip, $ips)) {
            return response()->json([
                "message" => "IP not whitelisted as Safaricom IP."
            ], 403);
        }

        // $request_data = '{"TransactionType":"Pay Bill","TransID":"PI87MDVMYZ","TransTime":"20210908072557","TransAmount":"1.00","BusinessShortCode":"4020109","BillRefNumber":"we-6","InvoiceNumber":null,"OrgAccountBalance":"57568.00","ThirdPartyTransID":null,"MSISDN":"254723077827","FirstName":"KELVIN","MiddleName":"THIONG\'O","LastName":"MAINA"}';
        // $data = json_decode($request_data);
        // dd($data);
        $data = $request->all();
        $data = json_encode($data);
        $data = json_decode($data);
        $accountNumber = preg_replace('/\s+/', '', $data->BillRefNumber); //remove white space
        $accountNumberArray = explode('-', $accountNumber);
        $code = strtolower($accountNumberArray[0]);
        $app = App::where("code", $code)->first();
        $app_id = null;
        if (!$app) {
            $accountNumberArray = explode('_', $accountNumber);
            $code = strtolower($accountNumberArray[0]);
            $app = App::where("code", $code)->first();
            if ($app) {
                $app_id = $app->id;
            }
        } else {
            $app_id = $app->id;
        }

        $transaction = Transaction::create([
            "app_id" => $app_id,
            "TransID" => $data->TransID,
            "MSISDN" => $data->MSISDN, //phone
            "TransAmount" => $data->TransAmount,
            "TransactionType" => $data->TransactionType,
            "BusinessShortCode" => $data->BusinessShortCode,
            "BillRefNumber" => $accountNumber,
            "OrgAccountBalance" => $data->OrgAccountBalance,
            "ThirdPartyTransID" => $data->ThirdPartyTransID,
            "FirstName" => $data->FirstName,
            "MiddleName" => $data->MiddleName,
            "LastName" => $data->LastName,
        ]);

        if ($app) {
            $tokenResponse = Http::retry(3, 100)->post($app->login_endpoint, [
                'username' => $app->username,
                'password' => $app->password,
            ])->json();
            if ($tokenResponse) {
                $token = $tokenResponse['access_token'];
                $headers = [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ];
                $response = Http::retry(3, 100)->withHeaders($headers)->post($app->endpoint, $request->all())->json();

                if ($response["success"] == true) {
                    $transaction->processed = true;
                    $transaction->save();
                }
            }
        } else {
            $transaction->processed = true;
            $transaction->save();
        }

        return response()->json([
            "message" => "success"
        ], 200);
        // dd($data);
    }
    public function mpesaFormatPhone($phone)
    {
        $phoneNumber = intval($phone);
        if (strlen($phoneNumber) < 10) {
            $phone = '254' . $phoneNumber;
        }
        // elseif()


        elseif (substr($phone, 0, 3) == "254") {
            $phone = $phone;
        } elseif (substr($phone, 0, 4) == "+254") {
            $phone = substr($phone, 1);
        }

        return $phone;
    }
    public function checkDeposit(Request $request)
    {
        $time_limit = ini_get('max_execution_time');
        $memory_limit = ini_get('memory_limit');

        set_time_limit(0);
        ini_set('memory_limit', '-1');
        // Get data from csv
        $row = 1;
        $dataArr = $receipts = [];
        $total = $verifiedCount = 0;
        if ($request->hasFile('file')) {
            if (!file_exists('employer/uploads')) {
                mkdir('employer/uploads', 0777, true);
            }
            $file = $request->file;
            $original_name = substr($file->getClientOriginalName(), -80);
            $unique_name = md5(uniqid() . $original_name) . "." . $file->extension();

            $file_name = 'employer/uploads/' . $unique_name;
            $file->move('employer/uploads/', $unique_name);
            $csv = $file_name;
        } else {
            $csv = "csv/mpesa.csv";
        }

        if (($handle = fopen($csv, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row == 4) {
                    $startDate = Carbon::createFromFormat('d-m-Y H:i:s', $data[2])->subHours(3);
                    $endDate = Carbon::createFromFormat('d-m-Y H:i:s', $data[4])->subHours(3);
                }
                if ($row == 2) {
                    $businessShortCode = $data[1];
                }


                if ($row > 6 && $data[12] != "Schemes" && $data[12] != "") {

                    // added
                    if (Transaction::where("TransID", $data[0])->count() > 0) {
                        continue;
                    }

                    $accountNumber = preg_replace('/\s+/', '', $data[12]); //remove white space
                    $accountNumberArray = explode('-', $accountNumber);
                    $code = strtolower($accountNumberArray[0]);
                    $app = App::where("code", $code)->first();
                    $app_id = null;
                    if (!$app) {
                        $accountNumberArray = explode('_', $accountNumber);
                        $code = strtolower($accountNumberArray[0]);
                        $app = App::where("code", $code)->first();
                        if ($app) {
                            $app_id = $app->id;
                        }
                    } else {
                        $app_id = $app->id;
                    }

                    if (!$app) {
                        continue;
                    }

                    // End

                    $phoneString = $data[10];
                    $arr = explode(' ', trim($phoneString));
                    $phoneNumber =  $this->mpesaFormatPhone($arr[0]);
                    $dataArr[] = [
                        "app_id" => $app_id,
                        "receiptId" => $data[0],
                        "accountNumber" => $data[12],
                        "amount" => (int) $data[5],
                        "phoneNumber" => $phoneNumber,
                        "businessShortCode" => $businessShortCode,
                    ];
                    $receipts[] = $data[0];

                    $total += (int) $data[5];
                }
                $row++;
            }
            $verifiedCount = count($dataArr);
            fclose($handle);
        }
        // End of csv mining
        foreach ($dataArr as $data) {

            $transaction = Transaction::create([
                "app_id" => $data['app_id'],
                "TransID" => $data['receiptId'],
                "MSISDN" => $data['phoneNumber'], //phone
                "TransAmount" => $data['amount'],
                "BusinessShortCode" => $data['businessShortCode'],
                "BillRefNumber" => $data['accountNumber'],
            ]);

            if ($app) {
                $tokenResponse = Http::retry(3, 100)->post($app->login_endpoint, [
                    'username' => $app->username,
                    'password' => $app->password,
                ])->json();
                if ($tokenResponse) {
                    $token = $tokenResponse['access_token'];
                    $headers = [
                        'Authorization' => 'Bearer ' . $token,
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ];
                    $response = Http::retry(3, 100)->withHeaders($headers)->post($app->endpoint, json_decode(json_encode($transaction), true))->json();

                    if ($response["success"] == true) {
                        $transaction->processed = true;
                        $transaction->save();
                    }
                }
            } else {
                $transaction->processed = true;
                $transaction->save();
            }

            return response()->json([
                "message" => "success"
            ], 200);
        }
    }

    public function complete_failed_transactions()
    {
        foreach (Transaction::where("processed", false)->get() as $transaction) {
            $accountNumber = preg_replace('/\s+/', '', $transaction->BillRefNumber); //remove white space
            $accountNumberArray = explode('-', $accountNumber);
            $code = strtolower($accountNumberArray[0]);
            $app = App::where("code", $code)->first();
            if (!$app) {
                $accountNumberArray = explode('_', $accountNumber);
                $code = strtolower($accountNumberArray[0]);
                $app = App::where("code", $code)->first();
            }
            if ($app) {
                $tokenResponse = Http::retry(3, 100)->post($app->login_endpoint, [
                    'username' => $app->username,
                    'password' => $app->password,
                ])->json();
                if ($tokenResponse) {
                    $token = $tokenResponse['access_token'];
                    $headers = [
                        'Authorization' => 'Bearer ' . $token,
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ];
                    $response = Http::retry(3, 100)->withHeaders($headers)->post($app->endpoint, json_decode(json_encode($transaction), true))->json();

                    if ($response["success"] == true) {
                        $transaction->processed = true;
                        $transaction->save();
                    }
                }
            } else {
                $transaction->processed = true;
                $transaction->save();
            }
        }
    }
    public function c2b_validation(Request $request)
    {
        $data = $request->all();
        Transaction::create([
            "app_id" => 1,
            "TransID" => "c2b_validation",
            "MSISDN" => "c2b_validation",
            "TransAmount" => 0,
        ]);
        return response()->json([
            "message" => "success"
        ], 200);
        // dd($data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
