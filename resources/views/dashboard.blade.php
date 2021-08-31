@extends('app')
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item active">Default </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 box-col-6 col-lg-12 col-md-6">
                    <div class="card o-hidden">
                        <div class="card-body">
                            <a href="{{route('apps.index')}}">
                                <div class="ecommerce-widgets media">
                                    <div class="media-body">
                                        <p class="f-w-500 font-roboto">Apps</p>
                                        <h4 class="f-w-500 mb-0 f-20"><span
                                                class="counter">{{App\Models\App::count()}}</span></h4>
                                    </div>
                                    <div class="ecommerce-box light-bg-primary"><i style="font-size: 25px"
                                            class="fa fa-briefcase" aria-hidden="true"></i></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
</div>
@endsection
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/chartist.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">
@endsection
@section('scripts')
<!-- Plugins JS start-->
<script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
<script src="{{ asset('assets/js/chart/chartist/chartist.js') }}"></script>
<script src="{{ asset('assets/js/chart/chartist/chartist-plugin-tooltip.js') }}"></script>
<script src="{{ asset('assets/js/chart/knob/knob.min.js') }}"></script>
<script src="{{ asset('assets/js/chart/knob/knob-chart.js') }}"></script>
<script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
<script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}"></script>
<script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
<script src="{{ asset('assets/js/notify/index.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
<script src="{{ asset('assets/js/typeahead/handlebars.js') }}"></script>
<script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
<script src="{{ asset('assets/js/typeahead-search/handlebars.js') }}"></script>
<script src="{{ asset('assets/js/typeahead-search/typeahead-custom.js') }}"></script>
<!-- Plugins JS Ends-->
@endsection
