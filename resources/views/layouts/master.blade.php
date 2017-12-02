<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('plugin/materialize/css/materialize.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{!! asset('plugin/sweet-alert/sweetalert.css') !!}"/>
    <!-- Styles -->
    @yield('styles')
    <style type="text/css">
    body {
	    display: flex;
	    min-height: 100vh;
	    flex-direction: column;
	}

	main {
	    flex: 1 0 auto;
	}
    .no-margin {
    	margin: 0 !important;
    }
    .no-padding {
    	padding: 0 !important;
    }
    #topbarsearch .input-field .prefix { 
        width:0rem !important;    
    }
    #topbarsearch nav ul li:hover, nav ul li.active {
        background-color: none !important;
    }
    </style>
</head>
<body>
	<div class="navbar-fixed">
		<nav class="blue lighten-1">
			<div class="container nav-wrapper">
				<a href="{{ route('home') }}" class="brand-logo">Logo</a>

				<ul class="right">
					<li>
						<div class="center row">
                          	<div class="col s12 " >
                            	<div class="row" id="topbarsearch">
                              		<div class="input-field col s6 s12 white-text">
                                		<i class="white-text material-icons prefix">search</i>
                                		<input type="text" placeholder="search" id="autocomplete-input" class="autocomplete white-text" >
                                	</div>
                              	</div>
                            </div>
                        </div>
					</li>
				@guest
					<li><a href="{{ url('login') }}">login</a></li>
				@else
					<li><a class="dropdown-button" href="#!" data-activates="profile">
						<i class="material-icons left">face</i>
						<span class="hide-on-med-and-down">
							{{ \Auth::user()->name }}
						</span>
					</a></li>
				@endguest
				</ul>
			</div>
		</nav>
		@guest
		@else
		<ul id="profile" class="dropdown-content">
			<li><a href="#!">profile (ongoing)</a></li>
			<li><a href="#!">config (ongoing)</a></li>
			<li class="divider"></li>
			<li><a href="{{ route('logout') }}"
		            onclick="event.preventDefault();
		                     document.getElementById('logout-form').submit();">
		            Logout
		        </a>

		        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		            {{ csrf_field() }}
		        </form>
		    </li>
		</ul>
		@endguest
	</div>
	@yield('content')
	<div class="fixed-action-btn">
	    <a class="btn-floating btn-large red">
	      	<i class="large material-icons">menu</i>
	    </a>
	    <ul>
	      	<li><a class="btn-floating green tooltipped" data-position="left" data-delay="50" data-tooltip="Lets go to Home page" href="{{ route('home') }}"><i class="material-icons">home</i></a></li>
	      	<!-- <li><a class="btn-floating yellow darken-1"><i class="material-icons">list</i></a></li> -->
	      	<li><a class="btn-floating red tooltipped" data-position="left" data-delay="50" data-tooltip="Add new content" href="{{ route('page.create') }}"><i class="material-icons">add</i></a></li>
	      	<!-- <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li> -->
	    </ul>
	</div>
	<footer class="page-footer" style="bottom: 0px">
		<div class="container">
			<div class="row">
				<div class="col l6 s12">
					<h5 class="white-text">Footer Content</h5>
					<p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
				</div>
				<div class="col l4 offset-l2 s12">
					<h5 class="white-text">Links</h5>
					<ul>
					  <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
					  <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
					  <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
					  <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="footer-copyright">
			<div class="container">
				© 2014 Copyright Text
				<a class="grey-text text-lighten-4 right" href="#!">More Links</a>
			</div>
		</div>
    </footer>
</body>

<script src="{{ asset('plugin/jquery/jquery-3.2.1.min.js') }}"></script>

<script src="{{ asset('plugin/materialize/js/materialize.min.js') }}"></script>
<script src="{!! asset('plugin/sweet-alert/sweetalert.min.js') !!} "></script>

<!-- <script src="{{ asset('js/app.js') }}"></script> -->
<script type="text/javascript">
	$(document).ready(function(){
		$(".dropdown-button").dropdown();
    	$('.materialboxed').materialbox();
    	$('.select_material').material_select();

		$('input.autocomplete').autocomplete({
			data: {
			"Apple": null,
			"Microsoft": null,
			"Google": null,
			"Gargle":null
			}
		});                
	});
</script>
@yield('scripts')
</html>