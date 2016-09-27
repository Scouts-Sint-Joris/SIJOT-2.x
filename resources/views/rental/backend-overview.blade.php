@extends('layouts.back-end')

@section('content-header')
<h1>
    Verhuur.
    <small>Verhuur module voor het domein.</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Verhuur</li>
</ol>
@endsection 

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Verhuur overzicht</h3>

        <div class="pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-xs btn-danger">Downloaden</button>
                <button type="button" class="btn btn-xs btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu-left dropdown-menu">
                    <li>
                        <a href="#">
                            <span class="fa fa-file-pdf-o"></span>PDF bestand
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="fa fa-file-code-o"></span>CSV bestand
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span class="fa fa-file-excel-o"></span>Excel bestand
                        </a>
                    </li>
                </ul>
            </div>

            <a href="" class="btn btn-success btn-xs">Verhuring toevoegen</a>
        </div>
    </div>
    <div class="box-body">
        Start creating your amazing application!
    </div>
    {{-- /.box-body --}}
    <div class="box-footer">
        Footer
    </div>
    {{-- /.box-footer--}}
</div>
@endsection