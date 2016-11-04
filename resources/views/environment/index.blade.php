@extends('layouts.back-end')

@section('content-header')
    <h1>
        Environment settings.
        <small>Configure the framework.</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ url('/') }}">
                <i class="fa fa-dashboard"></i>
                {{ trans('rental.lease-breadcrumb-index') }}
            </a>
        </li>
        <li class="active">
            Environment settings.
        </li>
    </ol>
@endsection

@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Settings</a></li>
            <li><a href="#tab_2" data-toggle="tab">Backup</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="row">
                    <div class="col-sm-7">
                        <p class="text-danger">Here u can see the current active .env file.</p>

                        <table class="table table-condensed table-hover">
                            <thead>
                            <tr>
                                <th>Key:</th>
                                <th>Value:</th>
                                <th>Options:</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($keys as $key => $value)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $value }}</td>
                                        <td>
                                            <a href="" class="label label-warning">Edit</a>
                                            <a href="" class="label label-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade in" id="tab_2">
                <div class="row">
                    <div class="col-sm-4">
                        <a style="margin-bottom: 10px;" href="{{ route('settings.env.backup') }}" class="btn btn-sm btn-success">Take backup</a>

                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>Backup naam:</th>
                                    <th>Genomen op:</th>
                                    <th>Opties:</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($backups as $output) 
                                    <tr>
                                        <td>{{ $output['unformatted'] }}_env</td>
                                        <td>{{ $output['formatted'] }}</td>
                                        
                                        <td>
                                            <a href="label label-info">Herstel</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.tab-content -->
    </div>
@endsection