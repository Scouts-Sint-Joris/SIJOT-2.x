<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />

        <title>Scouts en Gidsen Sint-Joris</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" />
        <link rel="stylesheet" href="{{ asset('assets/css/AdminLTE.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/icheck-blue.css') }}" />

        {{-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --}}
        {{-- WARNING: Respond.js doesn't work if you view the page via file:// --}}
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-box-body">
                <p class="login-box-msg">Login om een sessie te starten.</p>

                <form action="{{ url('login') }}" role="form" method="post">
                    {{-- CSRF token --}}
                    {{ csrf_field() }}

                    <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                        <input type="email" value="{{ old('email') }}"  name="email" class="form-control" placeholder="Email" />
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{$errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password" class="form-control" placeholder="Wachtwoord" />
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="remember" /> &nbsp; Onthoud mij
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Inloggen</button>
                        </div>
                    </div>
                </form>

                <a href="#" data-toggle="modal" data-target="#forgot">Wachtwoord vergeten?</a>

            </div>
        </div>

        {{-- Forgot modal --}}
        <div class="modal fade" id="forgot" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Wachtwoord vergeten?</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('password/email') }}" method="POST">
                            {{-- CSRF Token --}}
                            {{ csrf_field() }}

                            <input type="email" class="form-control" placeholder="Uw email adres" name="email" />
</div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-flat" data-dismiss="modal">Reset</button>
                        </form>
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- /Forgot modal --}}

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="{{ asset('assets/js/icheck.min.js') }}"></script>

        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>
