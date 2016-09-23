@extends('layouts.back-end')

@section('content-header')
<h1>
    Activiteiten.
    <small>Activiteiten module voor ouders en leden.</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Activiteiten</li>
</ol>
@endsection

@section('content')
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab_1" data-toggle="tab">
                Opgeslagen activiteiten 
            </a>
        </li>
        <li>
            <a href="#tab_2" data-toggle="tab"
               >Klad evenementen
            </a>
        </li>
        <li>
            <a href="#tab_3" data-toggle="tab">
                Nieuwe activiteit
            </a>
        </li>
    </ul>

    <div class="tab-content">

        {{-- Published activities --}}
        <div class="tab-pane active" id="tab_1">
            
        </div>
        {{-- /.tab-pane --}}

        {{-- Draft activities --}}
        <div class="tab-pane" id="tab_2">
            
        </div>
        {{-- /.tab-pane --}}
        
        {{-- Create new activity --}}
        <div class="tab-pane" id="tab_3">
            
            <div class="row">
       
                <form action="" class="form-horizontal" method="POST">
                    {{-- CSRF Field --}}
                    {{ csrf_field() }}

                    {{-- Activity date --}}
                    <div class="form-group">
                        {{-- BUG: style="text-align: left;" --}}
                        {{-- CSS code assign the label out off the container --}}
                        <label class="control-label col-sm-1" id="date">
                            Datum: <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-2">
                            <input class="form-control" type="date" placeholder="Activiteit datum" name="date" id="date" />
                        </div>
                    </div>

                    {{-- Activity time form-group --}}
                    <div class="form-group">
                        <label class="control-label col-sm-1" id="time">
                            Uren: <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-1">
                            <input class="form-control" type="time" placeholder="Start uur" name="start_time" id="time">
                        </div>

                        <div class="col-sm-1">
                            <input class="form-control" type="time" placeholder="Eind uur" name="end_time" id="time">
                        </div>
                    </div>

                    {{-- Group form-group --}}
                    <div class="form-group">
                        <label class="control-label col-sm-1" id="group">
                            Groep: <span class="text-danger">*</span>
                        </label>   

                        <div class="col-sm-2">
                            <select name="group" class="form-control">
                                <option value="" selected>-- Selecteer groep --</option>

                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}"> {{ $group->heading }} </option>  
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Activity description form-group --}}
                    <div class="form-group">
                        <label class="control-label col-sm-1" id="description">
                            Beschrijving: <span class="text-danger">*</span>
                        </label>

                        <div class="col-md-4">
                            <textarea class="form-control" name="" rows="7" placeholder="Activiteit beschrijving" id="description" type="test"></textarea>
                        </div>
                    </div>

                    {{-- State form-group --}}


                    {{-- SUBMIT & RESET form group --}}
                    <div class="form-group">
                        <div class="col-sm-offset-1 col-sm-3">
                            <button type="submit" class="btn btn-success btn-flat">Aanmaken</button>
                            <button type="reset" class="btn btn-danger btn-flat">Reset</button>
                        </div>
                    </div>

                </form>
            </div>
            
        </div>
        {{-- /.tab-pane -->

    </div>
    {{-- /.tab-content --}}
</div>
@endsection