@extends('layouts.master')

@section('styles')
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12">
            form search
        </div>
    </div>
    <h3>New Data Added</h3>
    <div class="row">
    	@if ($new)
    	@foreach ($new as $d)
    	<div class="col l4 m6 s12">
	        <div class="card medium">
			    <div class="card-image waves-effect waves-block waves-light">
			      	<img class="activator" src="{{ $d->image_header? \ImageHelper::getContentHeaderThumb($d->image_header): 'default-image.jpg' }}">
			    </div>
			    <div class="card-content">
			      	<span class="card-title activator grey-text text-darken-4">{{ str_limit(strip_tags($d->title),45,'...') }}<i class="material-icons right">more_vert</i></span>
			      	<p><a href="{{ url('page/'.$d->id) }}">Read More</a></p>
			    </div>
			    <div class="card-reveal">
			      	<span class="card-title grey-text text-darken-4">{{ str_limit(strip_tags($d->title),45,'...') }}<i class="material-icons right">close</i></span>
			      	<p>{{ str_limit(strip_tags($d->content), 300, '...') }}</p>
			    </div>
			</div>
		</div>
        @endforeach
        @endif
    </div>
</div>
@endsection

@section('scripts')
@stop
