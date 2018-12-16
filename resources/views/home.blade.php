
@extends('layouts.master')

@section('styles')
@stop

@section('content')
<section class="head">
    <div class="container">
        <div class="row">
          <div class="col s12">
          </div>
        </div>
        <div class="row">
            <div class="col s12 m12">
              @include('partialView.search')
            </div>
        </div>
    </div>
</section>
<section class="content custom-grey custom-border-top">
    <div class="container">
    </div>
</section>

@endsection

@section('scripts')
@stop
