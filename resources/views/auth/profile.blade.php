@extends('layouts.back-end')

@section('content-header')
<h1>
    Account configuratie <small>Configuratie module voor uw profiel..</small>
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
    </ul>

    <div class="tab-content">
        {{-- Account information --}}
        <div class="tab-pane fade in active" id="tab_1">
            <div class="row">
                <form action="" method="POST" class="form-horizontal">
                    {{-- CSRF TOKEN --}}
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name" class="control-label col-sm-1">
                            Naam: <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-2">
                            <input type="text" id="name" class="form-control" placeholder="Gebruikersnaam" value="{{ auth()->user()->name}}" name="name" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="control-label col-sm-1">
                            Email adres: <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-2">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email adres." value="{{ auth()->user()->email }}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="view" class="control-label col-sm-1">
                            Weergave: {{-- <span class="text-danger">*</span> --}}
                        </label>

                        <div class="col-sm-2">
                            <select id="view" class="form-control" name="theme">
                                <option value="">-- Selecteer uw weergave --</option>µ

                                @foreach($themes as $theme)
                                    <option value="{{ $theme->class }}">{{ $theme->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-1 col-sm-9">
                            <button type="submit" class="btn btn-sm btn-flat btn-success">Wijzigen.</button>
                            <button type="reset" class="btn btn-danger btn-flat btn-sm">Reset</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        {{-- /Account information --}}

        <div class="tab-pane fade in" id="tab_2">
            Password
        </div>
    </div>
</div>
@endsection
