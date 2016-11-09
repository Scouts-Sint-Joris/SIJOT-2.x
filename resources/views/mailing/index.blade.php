@extends('layouts.back-end')

@section('content-header')
    <h1>
        Mailing.
        <small>Massa mailings module voor de website.</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mailing</li>
    </ol>
@endsection

@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Mailinglists</a></li>
            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Newsletter</a></li>
            <li class=""><a href="#tab_3" data-toggle="" aria-expanded="false">Verstuur mailing</a></li>
            <li class=""><a href="#tab_4" data-toggle="" aria-expanded="false">Verstuur nieuwsbrief</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab_1">
                <div style="margin-bottom: 10px;">
                    <a href="" class="btn btn-sm btn-success">Toevoegen contact</a>
                    <a href="" class="btn btn-sm btn-info">Exporteer</a>
                </div>

                @if(count($mailing) === 0)
                    <div class="alert alert-info">
                        <p>There are no mailing addresses in the system.</p>
                    </div>
                @else 
                    <table>
                        <thead>
                            <th>#</th>
                            <th>Naam:</th>
                            <th>Email:</th>
                            <th></th> {{-- Functions --}}
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                @endif
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane fade in" id="tab_2">
                The European languages are members of the same family. Their separate existence is a myth.
                For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                in their grammar, their pronunciation and their most common words. Everyone realizes why a
                new common language would be desirable: one could refuse to pay expensive translators. To
                achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                words. If several languages coalesce, the grammar of the resulting language is more simple
                and regular than that of the individual languages.
            </div>
            <!-- /.tab-pane -->
            
            </div>
        <!-- /.tab-content -->
    </div>
@endsection
