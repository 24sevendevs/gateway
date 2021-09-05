@extends('app')
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Apps</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg></a></li>
                        <li class="breadcrumb-item active">Apps</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            @foreach ($apps as $app)
            <div class="col-sm-12 col-lg-4 col-xl-4 xl-50 col-md-6 box-col-6 minimize" style="margin-top: 50px">
                <div class="card height-equal">
                    <div class="calender-widget">
                        {{-- <div class="cal-img"></div> --}}
                        <div class="cal-date">
                            <img class="circular-avatar" src="{{$app->logo? $app->logo: '/images/default-logo.jpg'}}" alt="">
                        </div>
                        <div class="cal-desc text-center card-body">
                            <h6 class="f-w-600 theme-color">{{ $app->name }}</h6>
                        </div>
                        <div class="card-body">
                            <h6 class="f-w-600">Code</h6>
                            {{ $app->code }}
                            <hr>
                            <h6 class="f-w-600">Endpoint</h6>
                            {{ $app->endpoint }}
                            <hr>
                            <h6 class="f-w-600">Validation url</h6>
                            {{ $app->validation_url? $app->validation_url: 'Not set' }}
                            <hr>
                        </div>
                        <div class="cal-desc text-center card-body">
                            <p class="text-muted mt-3 mb-0">{{ $app->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
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
