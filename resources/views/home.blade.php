
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
            <div class="col s12 m7 push-m5">
              @include('partialView.search')
            </div>
            <div class="col s12 m5 pull-m7">
                <ul class="tabs">
                    <li class="tab col s6"><a class="active black-text waves-effect waves-green" href="#view-data">Most Viewed</a></li>
                    <li class="tab col s6"><a class="black-text waves-effect waves-green" href="#add-data">New Data</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="content custom-grey custom-border-top">
    <div class="container">
        <div class="row no-margin">
            <div class="col s12 m8">
              <div id="view-data">
                  <div class="row">
                      <div class="col s12">
                      &nbsp;
                      </div>
                  </div>
                  @include('partialView.data-page',['data' => $views])
              </div>
              <div id="add-data">
                  <div class="row">
                      <div class="col s12">
                      &nbsp;
                      </div>
                  </div>
                  @include('partialView.data-page',['data' => $new])
              </div>
            </div>
            <div class="col s12 m4">
              <div class="row">
                  <div class="col s12">
                  <h5 class="center"><strong>Tags</strong></h5>
                  </div>
              </div>
              <div class="row margin-bottom-5">
                  <div class="col s12">
                    @include('partialView.data-tag')
                  </div>
              </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
@stop
