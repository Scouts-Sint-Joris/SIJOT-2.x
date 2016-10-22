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
                    <div class="col-md-8" id="news">
                        @foreach($news as $article)
                            <article>
                                <h3>{{ $article->heading }}</h3>
                                <p>{{ $article->content }}</p>
                                <div>
                                    <span class="badge">Posted {{ $article->created_at->format('Y-m-d H:i:s') }}</span>
                                    <div class="pull-right">
                                        @foreach($article->tags as $tag)
                                            <span class="{{ $tag->class }}">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </article>
                        @endforeach
                        <hr>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Activiteiten:</div>

                            <div class="list-group">
                                @foreach($activities as $activity)
                                    <a href="" class="list-group-item">02/02/2002: Ik ben een activiteit</a>
                                @endforeach
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
