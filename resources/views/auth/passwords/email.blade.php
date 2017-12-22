<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} :: Reset Password sending Email</title>

    <link href="{{ asset('plugin/materialize/css/materialize.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
</head>
<body class="blue-grey lighten-5">
<div class="container">
    <div class="row">
        <div class="col m6 offset-m3">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Reset Password</span>
                    <div class="row">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            <label>E-Mail Address</label>
                        </div>
                    </div>

                    <div class="row">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col s12">
                            <button type="submit" class="btn btn-primary">
                                Send Password Reset Link
                            </button>
                            <a href="{{ route('login') }}" class="wave-effect btn-flat right">
                                Login
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
