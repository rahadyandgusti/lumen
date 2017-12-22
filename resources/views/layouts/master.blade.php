<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
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
    <!-- Styles -->
    @yield('styles')
    <link rel="stylesheet" href="{!! asset('css/style.css') !!}"/>
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
				© 2018 Copyright
				<!-- <a class="grey-text text-lighten-4 right" href="#!">More Links</a> -->
			</div>
		</div>
    </footer>
    <ul id="preview" class="side-nav">
	    <li><a href="#!" onclick="return false;"><i class="material-icons">arrow_forward</i></a></li>
	    <div class="preview-loader">
	    <li class="center-align">
	    	<div class="preloader-wrapper small">
	    	  <div class="spinner-layer spinner-blue">
		        <div class="circle-clipper left">
		          <div class="circle"></div>
		        </div><div class="gap-patch">
		          <div class="circle"></div>
		        </div><div class="circle-clipper right">
		          <div class="circle"></div>
		        </div>
		      </div>

		      <div class="spinner-layer spinner-red">
		        <div class="circle-clipper left">
		          <div class="circle"></div>
		        </div><div class="gap-patch">
		          <div class="circle"></div>
		        </div><div class="circle-clipper right">
		          <div class="circle"></div>
		        </div>
		      </div>

		      <div class="spinner-layer spinner-yellow">
		        <div class="circle-clipper left">
		          <div class="circle"></div>
		        </div><div class="gap-patch">
		          <div class="circle"></div>
		        </div><div class="circle-clipper right">
		          <div class="circle"></div>
		        </div>
		      </div>

		      <div class="spinner-layer spinner-green">
		        <div class="circle-clipper left">
		          <div class="circle"></div>
		        </div><div class="gap-patch">
		          <div class="circle"></div>
		        </div><div class="circle-clipper right">
		          <div class="circle"></div>
		        </div>
		      </div>
		    </div>
	    </li>
	    </div>
	    <div class="preview-content">
	    <li>
		    <img src="images/office.jpg" class="image-header" width="100%">
	    </li>
	    <li>
	    	<div class="row">
		    	<div class="col s12">
		    		<a href="" class="title-url">
		    			<h4 class="title">Title</h4>
		    		</a>
		    	</div>
		    	<div class="col s12">
		    		<span class="grey-text created">by Admin</span>
		    	</div>
	    	</div>
	    </li>
	    <!-- <li><div class="divider"></div></li> -->
	    <li>
	    	<div class="row">
		    	<div class="col s12">
		    		<div class="content">Content</div>
		    	</div>
		    </div>
	    </li>
	    <li>
	    	<div class="row">
		    	<div class="col s12 tags">
		    		<a class="red-text text-lighten-2" 
                        href="#">
                            #tags
                        </a>
		    	</div>
		    </div>
	    </li>
	    </div>
	</ul>
</body>

<script
src="https://code.jquery.com/jquery-3.2.1.min.js"
integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.0.6/dist/sweetalert2.all.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script> -->

<!-- <script src="{{ asset('js/app.js') }}"></script> -->
<script type="text/javascript">
	$(document).ready(function(){
		$(".dropdown-button").dropdown();
    	$('.materialboxed').materialbox();
    	$('.select_material').material_select();
    	$(".button-collapse").sideNav({
    		edge: 'right',
    		menuWidth: '50%',
    		closeOnClick: true,
    		onOpen: function(el) {
    			$('.preview-content').hide();
    			$('.preview-loader').show();
    			$('.preview-loader').find('preloader-wrapper').addClass('active');

    			var id = $(this).data('id');
    			console.log(id);
    			var url = '{{ url("page/getdata") }}/'+id;
    			$.get(url, function(data){
    				window.history.pushState("", "", "{{url('/')}}" +  "/page/"+data.slug);
    				if (data.image_header && data.image_header != '-') {
    					el.find('.image-header').closest('li').show();
    					el.find('.image-header').attr('src','{{ url("image/content/header") }}/'+data.image_header);
    				} else {
    					el.find('.image-header').closest('li').hide();
    				}
    				el.find('.title-url').attr('href','{{ url("page") }}/'+data.slug);
    				el.find('.title').html(data.title);
    				el.find('.content').html(data.content);
    				el.find('.created').html('by '+data.createduser.name);
    				var tags = '';
    				$.each(data.tags, function(i,v){
    					tags += '<a class="red-text text-lighten-2" '+
		                        'href="{{ url('tag') }}/'+v.tag.name+'">'+
		                            '#'+v.tag.name+
		                        '</a>';
    				})
    				el.find('.tags').html(tags);

	    			$('.preview-content').show();
	    			$('.preview-loader').find('preloader-wrapper').removeClass('active');
    				$('.preview-loader').hide();
    			});
    		},
    		onClose: function(el) {
    			window.history.pushState("", "", "{{\Request::url()}}");
    		}
    	});
    	// $('ul.tabs').tabs({'swipeable':true});

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