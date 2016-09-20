<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width-device-width, initial-scale=1">
        <meta name="description" content="Web site van scouts en gidsen Sint-joris | Turnhout">
        <meta name="author" content="Tim Joosten">
        
        <title> Scouts en Gidsen Sint-Joris Turnhout </title> 
        
        <link rel="icon" href="{{ asset('favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/app.css')}}">
        
        {{-- IE10 vieuwport hack for Surface/Desktop Windows 8 bug --}}
        <link rel="stylesheet" href="{{ asset('assets/css/ie-10-viewport-bug-workaround.css') }}">
    </head>
    <body class="background">
        {{-- Navigation bar --}}
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    
                    <a class="navbar-brand" href="#">Project name</a>
                </div>
                
                <div id="navbar" class="collapse navbar-collapse">
                    {{-- Left navbar --}}
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="">
                                <span class="fa fa-leaf"></span> Takken
                            </a>
                            
                            <ul class="dropdown-menu">
                                <li><a href=""><span class="fa fa-asterisk"></span> De kapoenen</a></li>
                                <li><a href=""><span class="fa fa-asterisk"></span> De Welpen</a></li>
                                <li><a href=""><span class="fa fa-asterisk"></span> De Jong-Givers</a></li>
                                <li><a href=""><span class="fa fa-asterisk"></span> De Givers</a></li>
                                <li><a href=""><span class="fa fa-asterisk"></span> De Jins</a></li>
                                <li><a href=""><span class="fa fa-asterisk"></span> De Leiding</a></li>
                            </ul>
                        </li>
                        
                        <li>
                            <a href="">
                                Verhuur
                            </a>
                        </li>
                        
                        <li>
                            <a href="">
                                Foto's
                            </a>
                        </li>
                        
                        <li>
                            <a href="">
                                Planning
                            </a>
                        </li>
                        
                        <li>
                            <a href="">
                                Info
                            </a>
                        </li>
                        
                        <li>
                            <a href="">
                                Contact
                            </a>
                        </li>
                    </ul>
                    
                    {{-- Right navbar. (authencation) --}}
                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::check())
                            <li><a href="">Backend</a></li>
                            <li><a href="{{ route('/logout') }}">Uitloggen</a></li>
                        @else 
                            <li><a href="{{ route('/login') }}">Login</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        
        {{-- Content --}}
        <div class="container">
            @yield('content')
        </div>
    
        {{-- Javascript --}}
        <script src=""></script>
        <script src=""></script>
    </body>
</html>
