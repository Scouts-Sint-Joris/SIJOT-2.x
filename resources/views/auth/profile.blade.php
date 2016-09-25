@extends('layouts.back-end')

@section('content-header')
<h1>
    Account configuratie
    <small>Configuratie module voor uw profiel..</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Account configuratie</li>
</ol>
@endsection

@section('content')
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab_1" data-toggle="tab">
                Account informatie
            </a>
        </li>
        <li>
            <a href="#tab_2" data-toggle="tab">
                Account beveiliging.
            </a>
        </li>
        <li>
            <a href="#tab_3" data-toggle="tab">
                Weergave
            </a>
        </li>
    </ul>

    <div class="tab-content">

        {{-- Account information --}}
        <div class="tab-pane fade in active" id="tab_1">
        </div>
        {{-- /Account information--}}

        {{-- Account security --}}
        <div class="tab-pane fade in" id="tab_2">
        </div>
        {{-- /Account security --}}

        {{-- Layout --}}
        <div class="tab-pane fade in" id="tab_3">
            <div class="row">
                <form method="POST" action="" class="form-horizontal">
                    {{-- CSRF TOKEN--}}
                    {{-- csrf_field() --}}

                    <div class="col-sm-4">
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>Naam:</th>
                                    <th>Actief:</th>
                                    <th>Niet actief.</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </form> 
            </div>
        </div>
        {{-- /Layout --}}
    </div>
@endsection
