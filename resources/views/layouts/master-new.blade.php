<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! SEO::generate(true) !!}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.0.6/dist/sweetalert2.min.css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <!-- <link href="{{ asset('plugin/ckeditor/plugins/prism/lib/prism/prism_patched.min.js') }}" rel="stylesheet"> -->
    <!-- Styles -->
    @yield('styles')
    <link rel="stylesheet" href="{!! asset('css/style.css') !!}"/>

<style type="text/css">
	@font-face {
	  font-family: "Share Tech Mono";
	  src: local(Share Tech Mono), url("../fonts/terminal/share-tech-mono-v7-latin-regular.woff2") format("woff2"), url("../fonts/terminal/share-tech-mono-v7-latin-regular.woff") format("woff");
	  font-weight: 700;
	}

	html {
	  line-height: 1.5;
	  font-family: "Share Tech Mono", monospace;
	  font-weight: normal;
	  color: rgba(0, 0, 0, 0.87);
	}
</style>
	<title>home</title>
</head>
<body>
	<div class="content-wrap">
		@yield('content')
	</div>
</body>
<script
src="https://code.jquery.com/jquery-3.2.1.min.js"
integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.0.6/dist/sweetalert2.all.min.js"></script>
</html>