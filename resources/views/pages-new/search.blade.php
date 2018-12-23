
@extends('layouts.master-new')

@section('styles')
@stop

@section('content')

    <section class="content">
    	<div class="row no-margin">
            <div class="col s12">
      			@include('partialView.search')
      		</div>
      	</div>
    </section>

    <section class="content ">
    	<div class="row">
            <div id="add-data" class="col s12 m8">
                <div class="row">
                    <div class="col s12">
                      <p class="text-flow no-margin-bottom grey-text">Search for keyword '{{\Request::get('keyword')}}' in title and/or content and/or tags.</p> 
                      <p class="text-flow no-margin grey-text">{{$data->count()}} data found</p>
                    </div>
                </div>
                @include('partialView.data-page',['data' => $data])

                <div class="row">
                    <div class="col s12">
                    {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
	</section>

@endsection

@section('scripts')
@stop
