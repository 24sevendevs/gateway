@extends('app')
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Recent Transactions</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Transactions</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="advance-1">
                                <thead>
                                    <tr>
                                        <th>App</th>
                                        <th>Phone</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>
                                            @if ($transaction->app)
                                            <a href="{{route('apps.show', $transaction->app->id)}}">
                                                <img src="{{ $transaction->app->logo? $transaction->app->logo: '/images/default-logo.png' }}"
                                                    alt="Logo" class="circular-avatar">
                                                {{ $transaction->app->name }}
                                            </a>
                                            @endif
                                        </td>
                                        <td>{{ $transaction->MSISDN }}</td>
                                        <td>
                                            {{ "$transaction->FirstName $transaction->MiddleName $transaction->LastName" }}
                                            {{ $transaction->content }}
                                        </td>
                                        <td>{{ $transaction->TransAmount }}
                                        </td>
                                        <td>{{ date('M d, Y g:i A', strtotime($transaction->created_at)) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>App</th>
                                        <th>Phone</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Time</th>
                                </tfoot>
                            </table>
                            {{ $transactions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">
@endsection
@section('scripts')
<!-- Plugins JS start-->
<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/js/datatable/datatables/datatable.custom.js"></script>
<!-- Plugins JS Ends-->
@endsection
