@extends('layouts.front-end')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <img src="{{ asset('assets/img/front.jpg') }}" style="height:400px; width:100%; border-top-right-radius: 6px; border-top-left-radius: 6px;" alt="Alternate Text" />
        </div>
    </div>

    <div class="content-margin row">
        <div class="col-sm-12">
            <div style="border-radius:0px; border: 0px;" class="panel panel-default">
                <div class="panel-body">

                    <div class="col-sm-12">
                        <div class="alert alert-info">
                            <h4>Lid worden van Scouts en Gidsen, Sint-Joris.</h4>
                            <p>Word jij ons nieuwste lid? Vul dan onderstaand formulier in om een aanvraag te verzenden.</p>
                        </div>
                    </div>

                    <form style="padding-top: 15px;" class="form-horizontal" action="" method="POST">
                        {{-- CSRF Implementation --}}
                        {{ csrf_field() }}


                            {{-- First row with inputs --}}
                            <div class="col-md-6">

                                {{-- Firstname form-group --}}
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="firstname">
                                        Voornaam: <span class="text-danger">*</span>
                                    </label>

                                    <div class="col-sm-8">
                                        <input type="text" name="firstname" id="firstname" placeholder="Voornaam" value="{!! old('firstname') !!}" class="form-control">
                                    </div>
                                </div>

                                {{-- Lastname form-group --}}
                                <div class="form-group">
                                    <label for="lastname" class="control-label col-sm-4">
                                        Achternaam: <span class="text-danger">*</span>
                                    </label>

                                    <div class="col-sm-8">
                                        <input type="text" id="lastname" value="{{ old('lastname') }}" name="lastname" placeholder="Achternaam" class="form-control">
                                    </div>
                                </div>

                                {{-- Gender form-group --}}
                                <div class="form-group">
                                    <label for="gender" class="control-label col-sm-4">
                                        Geslacht: <span class="text-danger">*</span>
                                    </label>

                                    <div class="col-sm-8">
                                        <select id="gender" class="form-control" name="gender">
                                            <option value="" selected>-- Geslacht --</option>
                                            <option value="Mannelijk">Mannelijk</option>
                                            <option value="Vrouwelijk">Vrouwelijk</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Email form-group --}}
                                <div class="form-group">
                                    <label for="edmail" class="control-label col-sm-4">
                                        E-mail: <span class="text-danger">*</span>
                                    </label>

                                    <div class="col-sm-8">
                                        <input type="text" id="email" value="{{ old('email') }}" name="email" placeholder="E-mail adres" class="form-control">
                                    </div>
                                </div>

                                {{-- Birth date form-group --}}
                                <div class="form-group">
                                    <label for="birth_date" class="control-label col-sm-4">
                                        Geboortedatum: <span class="text-danger">*</span>
                                    </label>

                                    <div class="col-sm-8">
                                        <input type="text" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" placeholder="Geboortedatum: 00/00/0000" class="form-control">
                                    </div>
                                </div>

                                {{-- GSM nummer form-group --}}
                                <div class="form-group">
                                    <label for="mobile_number" class="control-label col-sm-4">
                                        GSM nummer: <span class="text-danger">*</span>
                                    </label>

                                    <div class="col-sm-8">
                                        <input type="text" value="{{ old('mobile_number') }}" id="mobile_number" name="mobile_number" placeholder="GSM nummer." class="form-control">
                                    </div>
                                </div>

                                {{-- Rekening nummer form-group --}}
                                <div class="form-group">
                                    <label for="rek_nr" class="control-label col-sm-4">
                                        Rekening nummer: {{-- <span class="text-danger">*</span> --}}
                                    </label>

                                    <div class="col-sm-8">
                                        <input type="text" id="rek_nr"  value="{{ old('rekening_nr') }}" name="rekening_nr" placeholder="Rekening nummmer" class="form-control">
                                    </div>
                                </div>

                            </div> {{-- /First row --}}

                            {{-- Second row with inputs --}}
                            <div class="col-md-6">

                                {{-- Country form-group --}}
                                <div class="form-group">
                                    <label for="firstname" class="control-label col-sm-4">
                                        Land: <span class="text-danger">*</span>
                                    </label>

                                    <div class="col-sm-8">
                                        <select class="form-control" name="city">
                                            <option value="" selected>-- Selecteer land --</option>

                                            {{-- TODO: Implement countries.  --}}
                                        </select>
                                    </div>
                                </div>

                                {{-- Postal code and city form-group --}}
                                <div class="form-group">
                                    <label for="city" class="control-label col-sm-4">
                                        Gemeente: <span class="text-danger">*</span>
                                    </label>

                                    <div class="col-sm-8">
                                        <input type="text" value="{{ old('coty') }}" id="city" name="city" placeholder="bv. 2300, Turnhout" class="form-control">
                                    </div>
                                </div>

                                {{-- Street form-group --}}
                                <div class="form-group has-feedback {{ $errors->has('street') ? 'has-error' : '' }}">
                                    <label for="street" class="control-label col-sm-4">
                                        Straat: <span class="text-danger">*</span>
                                    </label>

                                    <div class="col-sm-8">
                                        <input type="text" id="street" value="{{ old('street') }}" name="street" placeholder="Straat" class="form-control">
                                    </div>
                                </div>

                                {{-- Houde number form-group --}}
                                <div class="form-group has-feedback {{ $errors->has('number') ? 'has-error' : '' }}">
                                    <label for="number" class="control-label col-sm-4">
                                        Huisnummer: <span class="text-danger">*</span>
                                    </label>

                                    <div class="col-sm-4">
                                        <input type="text" id="number" value="{{ old('number') }}" name="number" class="form-control" placeholder="Huisnummer">
                                    </div>
                                </div>

                                {{-- Appertment bus number form-group --}}
                                <div class="form-group">
                                    <label for="bus_number" class="control-label col-sm-4">
                                        Bus nummer: {{-- <span class="text-danger">*</span> --}}
                                    </label>

                                    <div class="col-sm-4">
                                        <input type="text" id="bus" value="{{ old('bus')}}" name="bus" class="form-control" placeholder="Bus nummer">
                                    </div>
                                </div>

                                {{-- Telephone number form-group --}}
                                <div class="form-group">
                                    <label for="tel_num" class="control-label col-sm-4">
                                        Vaste nummer: {{-- <span class="text-danger">*</span> --}}
                                    </label>

                                    <div class="col-sm-8">
                                        <input type="text" id="tel_num" value="{{ old('telephone_number') }}" name="telephone_number" class="form-control" placeholder="Vaste telefoon nummer">
                                    </div>
                                </div>

                            </div> {{-- /Second row --}}

                            <div class="col-sm-12">
                                {{-- Note form-group --}}
                                <div class="form-group">
                                    <label for="notes" class="control-label col-sm-2">
                                        Opmerkingen: {{-- <span class="text-danger">*</span> --}}
                                    </label>

                                    <div class="col-sm-10">
                                        <textarea name="notes" id="note" value="{{ old('notes') }}" class="form-control" rows="8" placeholder="Opmerkingen"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success">Registreren</button>
                                        <button type="reset" class="btn btn-danger">Reset</button>
                                    </div>
                                </div>
                            </div>

                    </form>
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
                <form action="{{ route('newsletter.register') }}" method="POST">
                    <div class="input-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                        {{-- CSRF FIELD --}}
                        {{ csrf_field() }}

                        <input style="border-top-left-radius: 4px; border-bottom-left-radius: 4px;" type="text" name="email" class="form-control" placeholder="Email adres">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-danger" type="button">
                                <span class="fa fa-envelope"></span>
                            </button>
                        </span>
                    </div>{{-- /input-group --}}
                </form>
            </p>
        </div>
    </div>
</footer>
@endsection
