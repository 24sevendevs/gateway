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
                <div class="col-xl-6 box-col-6 col-lg-12 col-md-6">
                    <div class="card o-hidden">
                        <div class="card-body">
                            <a href="{{route('transactions.index')}}">
                                <div class="ecommerce-widgets media">
                                    <div class="media-body">
                                        <p class="f-w-500 font-roboto">Transactions</p>
                                        <h4 class="f-w-500 mb-0 f-20"><span
                                                class="counter">{{App\Models\Transaction::count()}}</span></h4>
                                    </div>
                                    <div class="ecommerce-box light-bg-primary"><i style="font-size: 25px"
                                            class="fa fa-usd" aria-hidden="true"></i></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('styles')

@endsection
@section('scripts')
<!-- Plugins JS start-->
@endsection
