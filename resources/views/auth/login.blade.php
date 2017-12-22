<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} :: Login</title>

    <link href="{{ asset('plugin/materialize/css/materialize.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
</head>
<body class="blue-grey lighten-5">
<div class="container">
    <div class="row">
        <div class="col m6 offset-m3">
            <div class="card">
                <!-- <div class="card-image">
                    <img src="http://materializecss.com/images/sample-1.jpg">
                </div> -->
                <div class="card-content">
                    <span class="card-title">Login</span>
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="username" type="text" class="validate" name="username" value="{{ old('email') }}" required autofocus>
                            <label>Username</label>
                        </div>
                    </div>

                    <div class="row">
                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password" type="password" class="validate" name="password" required>
                            <label>Password</label>
                        </div>
                    </div>

                    <div class="row">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col s12">
                            <p>
                                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}/>
                                <label for="remember">Remember Me</label>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>

                            <a class="" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<script src="{{ asset('plugin/jquery/jquery-3.2.1.min.js') }}"></script>
<!-- <script src="{{ asset('plugin/ckeditor/adapters/jquery.js') }}"></script> -->
<script src="{{ asset('plugin/materialize/js/materialize.min.js') }}"></script>

</html>
