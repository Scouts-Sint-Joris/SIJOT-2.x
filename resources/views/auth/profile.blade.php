@extends('layouts.back-end')

@section('content-header')
<h1>
    User profile <!-- <small></small> -->
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Account</li>
</ol>
@endsection

@section('content')
    <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        @if (file_exists(public_path(auth()->user()->avatar)) && auth()->user()->avatar !== null)
                            <img class="profile-user-img img-responsive img-circle" src="{{ asset(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
                        @else
                            <img src="{{ asset('assets/avatars/default.png') }}" class="profile-user-img img-responsive img-circle" alt="{{ auth()->user()->name }}">
                        @endif

                        <h3 class="profile-username text-center">{{ $user->name }}</h3>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Creatie:</b> <span class="pull-right">{{ $user->created_at }}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Gewijzigd:</b> <span class="pull-right">{{ $user->updated_at }}</span>
                            </li>
                        </ul>

                        <a href="mailto:{{ $user->email }}" class="btn btn-primary btn-block"><b>Contact</b></a>
                    </div>
                    <!-- /.box-body -->
                </div>
        </div>

        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li><a href="#settings" data-toggle="tab">Account</a></li>
                    <li><a href="#security" data-toggle="tab">Security</a></li>
                    <li><a href="#api" data-toggle="tab">API</a></li>
                    <li><a href="#logs" data-toggle="tab">Logs</a></li>
                    <li class="active"><a href="#notifications" data-toggle="tab">Notifications</a></li>
                </ul>
                <div class="tab-content">
                    {{-- Includes --}}
                        @include('auth.partials.account-settings')
                        @include('auth.partials.account-security')
                        @include('auth.partials.account-api')
                        @include('auth.partials.account-notifications')
                        @include('auth.partials.account-logs')
                    {{-- /Includes --}}
                </div>
            </div>
        </div>
    </div>
@endsection
