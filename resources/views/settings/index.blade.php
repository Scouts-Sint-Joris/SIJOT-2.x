@extends('layouts.back-end')

@section('content-header')
<h1>
    Login beheer
    <small>wie kan inloggen op het systeem?</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Login beheer</li>
</ol>
@endsection

@section('content')
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Groepen</a></li>
        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Modules</a></li>
        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade in active" id="tab_1">

        </div>
        <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
</div>
@endsection
