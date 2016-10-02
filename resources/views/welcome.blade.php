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
                        <h3>Alice in Wonderland, part dos</h3>
                        <p>
                            'You ought to be ashamed of yourself for asking such a simple question,' added the Gryphon; and then they both sat silent and looked at poor Alice, who felt ready to sink into the earth. At last the Gryphon said to the Mock Turtle, 'Drive on, old fellow! Don't be all day about it!' and he went on in these words:
                            'Yes, we went to school in the sea, though you mayn't believe it—'
                            'I never said I didn't!' interrupted Alice.
                            'You did,' said the Mock Turtle.
                        </p>
                        <div>
                            <span class="badge">Posted 2012-08-02 20:47:04</span><div class="pull-right">
                                <span class="label label-default">alice</span> <span class="label label-primary">story</span> <span class="label label-success">blog</span> <span class="label label-info">personal</span> <span class="label label-warning">Warning</span>
                                <span class="label label-danger">Danger</span>
                            </div>
                        </div>
                        <hr>
                        <h3>Revolution has begun!</h3>
                        <p>
                            'I am bound to Tahiti for more men.'
                            'Very good. Let me board you a moment—I come in peace.' With that he leaped from the canoe, swam to the boat; and climbing the gunwale, stood face to face with the captain.
                            'Cross your arms, sir; throw back your head. Now, repeat after me. As soon as Steelkilt leaves me, I swear to beach this boat on yonder island, and remain there six days. If I do not, may lightning strike me!'A pretty scholar,' laughed the Lakeman. 'Adios, Senor!' and leaping into the sea, he swam back to his comrades.
                        </p>
                        <div>
                            <span class="badge">Posted 2012-08-02 20:47:04</span><div class="pull-right">
                                <span class="label label-default">alice</span> <span class="label label-primary">story</span> <span class="label label-success">blog</span> <span class="label label-info">personal</span> <span class="label label-warning">Warning</span>
                                <span class="label label-danger">Danger</span>
                            </div>
                        </div>
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
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Email adres">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><span class="fa fa-envelope"></span></button>
                    </span>
                </div>{{-- /input-group --}}
            </p>
        </div>
    </div>
</footer>
@endsection
