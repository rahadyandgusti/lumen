
@extends('layouts.master')

@section('styles')
<style type="text/css">
  .data-item .content {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    padding: 0 .75rem;
    min-height: 1px;
  }
  .data-item .content.with-figure {
    margin-left: 150px;
  }
  .data-item .figure{
    float: left;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    min-height: 1px;
    width: 150px;
  }
  .data-item .figure img{
    width: 150px;
  }

  .btn-tags-custom {
      padding: 0 .5rem;
      text-transform:none;
  }
</style>
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
            <div id="add-data" class="col s9">
                <div class="row no-margin">
                    <div class="col s12">
                    &nbsp;
                    </div>
                </div>
                <div class="row no-margin">
                    <div class="col s12">
                      <p class="text-flow">Search for keyword '{{\Request::get('keyword')}}' in Title, Content and Tags.</p>
                    </div>
                </div>
                @include('partialView.data-page',['data' => $data])
            </div>
            <div class="col s3">
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
