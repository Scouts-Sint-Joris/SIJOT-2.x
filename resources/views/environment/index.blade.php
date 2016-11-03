@extends('layouts.back-end')

@section('content-header')
    <h1>
        Framework settings.
        <small>Configure the backbone for this platform.</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ url('/') }}">
                <i class="fa fa-dashboard"></i>
                {{ trans('rental.lease-breadcrumb-index') }}
            </a>
        </li>
        <li class="active">
            Framework settings.
        </li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Environment configuratie.</h3>
        </div>
        <div id="settings" class="box-body">
            @foreach($keys as $name => $meh)
                {{ $name }} - {{ $meh }} <br>

            @endforeach
        </div>
    </div>
@endsection