@extends('layouts.front-end')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <img src="https://placehold.it/160x160" style="height:400px; width:100%; border-top-right-radius: 6px; border-top-left-radius: 6px;" alt="Alternate Text" />
    </div>
</div>
<div style="margin-bottom: -22px;" class="row">
    <div class="col-sm-12">
        <div style="border-radius:0px; border: 0px;" class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-8">
                    <h3>Bereikbaarheid van het domein. </h3>    
                    <p>Ons domein is vlot te bereiken op de volgende manieren:</p>
                    
                </div>

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Menu:</div>

                        <div class="list-group">
                            <a href="{{route('rental.frontend.index') }}" class="list-group-item">
                                <span class="fa fa-info-circle"></span> Informatie
                            </a>
                             <a href="{{ route('rental.frontend.reachable') }}" class="list-group-item">
                                <span class="fa fa-asterisk"></span>Bereikbaarheid
                            </a>
                            <a href="{{ route('rental.frontend-calendar') }}" class="list-group-item">
                                <span class="fa fa-calendar"></span>
                                Verhuur kalender
                            </a>
                            <a href="{{ route('rental.frontend.insert') }}" class="list-group-item">
                                <span class="fa fa-asterisk"></span>
                                Verhuur aanvragen
                            </a>
                            <a href="mailto:contact@sjoris-turnhout.be" class="list-group-item">
                                <span class="fa fa-envelope"></span> Contact
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer-bs">
    <div class="row">
        <div class="col-md-7 footer-brand animated fadeInLeft">
            <h2>Over ons</h2>
            <p>
                Wij zijn een gemenge scoutsgroep die elke zondag van de maand, van 2u tot 5u vergaderingen houd.
                Buiten de laatste zondag van de maand dan is het van 101u tot 5u. voor de rest zijn wij geleden te <br>
                Sint-Jorislaan 11, 2300 Turnhout.
            </p>

            <p>&copy; 2015 - {{ date('Y') }} Scouts en Gidsen - Sint Joris, Turnhout</p>
        </div>
        <div class="col-md-2 footer-social animated fadeInDown">
            <h4>Social Media</h4>
            <ul>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">Instagram</a></li>
            </ul>
        </div>
        <div class="col-md-3 footer-ns animated fadeInRight">
            <h4>Nieuwsbrief</h4>
            <p>Wilt u op de hoogte blijven? Kunt u zich hier inschrijven op de nieuwsbrief. Zodat u op de hoogte blijft.</p>
            <p>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Email adres">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><span class="fa fa-envelope"></span></button>
                    </span>
                </div><!-- /input-group -->
            </p>
        </div>
    </div>
</footer>
@endsection