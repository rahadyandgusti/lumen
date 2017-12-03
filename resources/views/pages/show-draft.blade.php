
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
            <div class="col s12">
              @include('partialView.search')
            </div>
        </div>
    </div>
</section>
<section class="content custom-grey custom-border-top">
    <div class="container">
        <div class="row no-margin">
            <div id="add-data" class="col s12 m8">
                <div class="row no-margin">
                    <div class="col s12">
                    &nbsp;
                    </div>
                </div>
                @include('partialView.data-page',['data' => $draft])
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
