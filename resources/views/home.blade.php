
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
            <div class="col m6 hide-on-small-only">
                <ul class="tabs">
                    <li class="tab col s6"><a class="active black-text waves-effect waves-green" href="#add-data">New Data Added</a></li>
                    <li class="tab col s6"><a class="black-text waves-effect waves-green" href="#view-data">Most Viewed</a></li>
                </ul>
            </div>
            <div class="col s12 m6">
              @include('partialView.search')
            </div>
            <div class="col s12 hide-on-med-and-up">
                <ul class="tabs">
                    <li class="tab col s6"><a class="active black-text waves-effect waves-green" href="#add-data">New Data Added</a></li>
                    <li class="tab col s6"><a class="black-text waves-effect waves-green" href="#view-data">Most Viewed</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="content custom-grey custom-border-top">
    <div class="container">
        <div class="row no-margin">
            <div id="add-data" class="col s12 m8">
                <div class="row">
                    <div class="col s12">
                    &nbsp;
                    </div>
                </div>
                @include('partialView.data-page',['data' => $new])
            </div>
            <div id="view-data" class="col s12 m8">
                <div class="row">
                    <div class="col s12">
                    &nbsp;
                    </div>
                </div>
                @include('partialView.data-page',['data' => $views])
            </div>
            <div class="col s12 m4">
              <div class="row">
                  <div class="col s12">
                  <h5 class="center"><strong>Tags</strong></h5>
                  </div>
              </div>
              <div class="row margin-bottom-5">
                  <div class="col s12">
                    @include('partialView.data-tag',['data' => $tags])
                  </div>
              </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
@stop
