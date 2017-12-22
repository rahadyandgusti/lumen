
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
                <!-- <div class="row no-margin">
                    <div class="col s12">
                    &nbsp;
                    </div>
                </div> -->
                <div class="row no-margin">
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
            <div class="col s12 m4">
              <div class="row">
                  <div class="col s12">
                  <h5 class="center"><strong>Tags</strong></h5>
                  </div>
              </div>
              <div class="row">
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
