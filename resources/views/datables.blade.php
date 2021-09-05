
@extends('app')
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Advanced DataTables</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Data Tables</li>
                        <li class="breadcrumb-item active">Advanced DataTables</li>
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
                                        <th>Logo</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($apps as $app)
                                    <tr>
                                        <td>
                                            <a href="{{route('apps.show', $app->id)}}">
                                                <img src="{{ $app->logo? $app->logo: '/images/default-logo.png' }}"
                                                    alt="Logo" class="circular-avatar">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('apps.show', $app->id)}}">
                                            {{ $app->name }}
                                            </a>
                                        </td>
                                        <td>{{ $app->code }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Logo</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                </tfoot>
                            </table>
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
