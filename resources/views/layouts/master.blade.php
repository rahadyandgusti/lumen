<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
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

	.custom-grey{
	    background-color: #F2F2F2;
	}

	.custom-border-top {
	    border-top: 2px solid #BFD85C;
	}

	.add-border-right {
	    border-right: 1px solid #FFFFFF;
	}

	.custom-green{
	    background-color: #BFD85C;
	}

    .margin-bottom-5 {
    	margin-bottom: 5px !important;
    }

    .no-margin {
    	margin: 0 !important;
    }
    .no-padding {
    	padding: 0 !important;
    }
    #topbarsearch .input-field input { 
	    height: 2rem;
	    margin-bottom: 0px;
	}
    </style>
</head>
<body>
	<div class="navbar-fixed">
		<nav class="white black-text">
			<div class="container nav-wrapper">
				<a href="{{ route('home') }}" class="brand-logo waves-effect waves-green teal-text text-darken-4">{{ config('app.name', 'Laravel') }}</a>

				<ul class="right">
				@guest
					<li><a href="{{ url('login') }}" class=" black-text">login</a></li>
				@else
					<li><a class="dropdown-button black-text" href="#!" data-activates="profile">
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
	<div class="content-wrap">
		@yield('content')
	</div>
	<div class="fixed-action-btn">
	    <a class="btn-floating btn-large red">
	      	<i class="large material-icons">menu</i>
	    </a>
	    <ul>
	      	<li>
	      		<a class="btn-floating green tooltipped" 
	      			data-position="left" 
	      			data-delay="50" 
	      			data-tooltip="Lets go to Home page" 
	      			href="{{ route('home') }}"
	      		>
	      			<i class="material-icons">home</i>
	      		</a>
	      	</li>
	      	@guest
	      	<li>
	      		<a class="btn-floating yellow darken-1 tooltipped" 
		      		data-position="left" 
		      		data-delay="50" 
		      		data-tooltip="Under Construction" 
		      		href="#"
	      		>
	      			<i class="material-icons">verified_user</i>
	      		</a>
	      	</li>
	      	@else
	      	<li>
	      		<a class="btn-floating yellow darken-1 tooltipped" 
		      		data-position="left" 
		      		data-delay="50" 
		      		data-tooltip="Your Draft" 
		      		href="{{ route('draft') }}"
	      		>
	      			<i class="material-icons">drafts</i>
	      		</a>
	      	</li>
	      	<li>
		      	<a class="btn-floating red tooltipped" 
			      	data-position="left" 
			      	data-delay="50" 
			      	data-tooltip="Add new content" 
			      	href="{{ route('page.create') }}"
		      	>
		      		<i class="material-icons">add</i>
		      	</a>
	      	</li>
	      	<!-- <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li> -->
	      	@endguest
	    </ul>
	</div>
	<footer class="page-footer custom-green" style="bottom: 0px">
		<div class="container">
			<div class="row">
				<div class="col l6 s12">
					<h5 class="white-text">About</h5>
					<p class="grey-text text-lighten-4">ini hanya web catatan kecil <i>coding</i>. karena <i>developer</i> adalah seorang <i>programmer</i> yang sering lupa akan hal-hal kecil yang biasanya sangat penting. daripada mencari dari awal masih mending ditulis aja. Hahahaha...</p>
				</div>
				<!-- <div class="col l4 offset-l2 s12">
					<h5 class="white-text">Links</h5>
					<ul>
					  <li><a class="grey-text text-lighten-3" href="{{route('home')}}">Home</a></li>
					  <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
					  <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
					  <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
					</ul>
				</div> -->
			</div>
		</div>
		<div class="footer-copyright">
			<div class="container">
				© 2017 Copyright
				<!-- <a class="grey-text text-lighten-4 right" href="#!">More Links</a> -->
			</div>
		</div>
    </footer>
</body>

<script
src="https://code.jquery.com/jquery-3.2.1.min.js"
integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script src="{!! asset('plugin/sweet-alert/sweetalert.min.js') !!} "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

<!-- <script src="{{ asset('js/app.js') }}"></script> -->
<script type="text/javascript">
	$(document).ready(function(){
		$(".dropdown-button").dropdown();
    	$('.materialboxed').materialbox();
    	$('.select_material').material_select();

		// $('input.autocomplete').autocomplete({
		// 	data: {
		// 	"Apple": null,
		// 	"Microsoft": null,
		// 	"Google": null,
		// 	"Gargle":null
		// 	}
		// });       
		var height = $(window).height() - ($('.navbar-fixed').outerHeight() + $('footer').outerHeight() + $('section.head').outerHeight() + 20);
		$('section.content').css('min-height', height);
	});
</script>
@yield('scripts')
</html>