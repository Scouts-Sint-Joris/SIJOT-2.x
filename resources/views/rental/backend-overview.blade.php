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
            <a href="{{ route('rental.backend.export') }}" class="btn btn-danger btn-xs">
                {{ trans('rental.lease-export') }}
            </a>
            <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#insert">
                {{ trans('rental.lease-add') }}
            </a>
        </div>
    </div>
    <div class="box-body">
        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('rental.lease-start-date') }}</th>
                    <th>{{ trans('rental.lease-end-date') }}</th>
                    <th>{{ trans('rental.lease-status') }}</th>
                    <th>{{ trans('rental.lease-group') }}</th>
                    <th>{{ trans('rental.lease-email') }}</th>
                    <th>{{ trans('rental.lease-phone-number') }}</th>
                    <th>{{ trans('rental.lease-create-date') }}</th>
                    <th></th> {{-- Options --}}
                </tr>
            </thead>
            <tbody>
                @foreach($rentals as $rental)
                    <tr>
                        <td><code>#R{{ $rental->id }}</code></td>
                        <td>{{ date('d/m/Y', strtotime($rental->start_date)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($rental->end_date)) }}</td>
                        <td><span class="{{ $rental->status->class }}">{{ $rental->status->name}}</span></td>
                        <td>{{ $rental->group }}</td>
                        <td>{{ $rental->email }}</td>
                        <td>{{ $rental->phone_number }}</td>
                        <td>{{ $rental->created_at }}</td>

                        {{-- Options --}}
                        <td>
                            <div class="pull-right">
                                <div class="btn-group">
                                    <a class="btn btn-xs btn-success @if($rental->status->name === 'Bevestigd') disabled @endif" href="{{ route('rental.backend.confirm', ['id' => $rental->id]) }}">
                                        <span class="fa fa-check"></span> {{ trans('rental.lease-confirm') }}
                                    </a>

                                    <a class="btn btn-xs btn-warning @if($rental->status->name === 'Optie') disabled @endif" href="{{ route('rental.backend.option', ['id' => $rental->id]) }}">
                                        <span class="fa fa-asterisk"></span> {{ trans('rental.lease-option') }}
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a class="btn btn-xs btn-danger" href="{{ route('rental.backend.destroy', ['id' => $rental->id]) }}">
                                        <span class="fa fa-close"></span> {{ trans('rental.lease-delete') }}
                                    </a>
                                </div>
                            </div>
                        </td>
                        {{-- /Options --}}
                    </tr>
                @endforeach
            </tbody> 
        </table>
    </div>
    {{-- /.box-body --}}
    @if (count($rentals) > 25)
        <div class="box-footer">
            {{ $rentals->render() }}
        </div>
    @endif
    {{-- /.box-footer--}}

    {{-- Insert modal --}}
        @include('rental.backend-insert')
    {{-- /Insert modal --}}
</div>
@endsection