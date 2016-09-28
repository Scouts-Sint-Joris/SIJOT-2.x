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
        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Start datum:</th>
                    <th>Eind datum:</th>
                    <th>Status:</th>
                    <th>Groep:</th>
                    <th>Email:</th>
                    <th>GSM-nummer:</th>
                    <th>Aanvraag datum:</th>
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
                                        <span class="fa fa-check"></span> Bevestig
                                    </a>

                                    <a class="btn btn-xs btn-warning @if($rental->status->name === 'Optie') disabled @endif" href="{{ route('rental.backend.option', ['id' => $rental->id]) }}">
                                        <span class="fa fa-asterisk"></span>Optie
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a class="btn btn-xs btn-danger" href="{{ route('rental.backend.destroy', ['id' => $rental->id]) }}">
                                        <span class="fa fa-close"></span> Verwijder
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
</div>
@endsection