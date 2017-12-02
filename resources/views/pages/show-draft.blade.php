
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

  .font1, .font0 {font-size: 10px;}
  .font2 {font-size: 12px;}
  .font3 {font-size: 14px;}
  .font4 {font-size: 16px;}
  .font5 {font-size: 18px;}
  .font6 {font-size: 20px;}
  .font7 {font-size: 22px;}
  .font8 {font-size: 24px;}
  .font9 {font-size: 28px;}
  .font10 {font-size: 30px;}
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
            <div class="col m6 hide-on-small-only">
            </div>
            <div class="col s12 m6">
              <div class="row no-margin">
                  <div class="col s12 " >
                    <div class="row no-margin" id="topbarsearch">
                        <div class="input-field col s6 s12 black-text">
                          <i class="black-text material-icons prefix">search</i>
                          <input type="text" placeholder="search" 
                            id="autocomplete-input" 
                            class="autocomplete black-text search-input"
                          >
                        </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</section>
<section class="head custom-grey custom-border-top">
    <div class="container">
        <div class="row">
            <div id="add-data" class="col s9">
                <div class="row">
                    <div class="col s12">
                    &nbsp;
                    </div>
                </div>
                @if ($draft) 
                @foreach ($draft as $d)
                  <div class="row">
                    <div class="col s12">
                    </div>
                  </div>
                  <div class="row data-item">
                    <div class="col s12">
                        @if($d->image_header)
                        <div class="figure">
                            <img src="{{ \ImageHelper::getContentHeaderThumb($d->image_header) }}" alt="" class="responsive-img materialboxed">
                        </div>
                        <div class="content with-figure">
                        @else
                        <div class="content">
                        @endif
                          <a href="{{ url('page/'.$d->slug) }}">
                            <strong class="title no-margin">{{ title_case(str_limit(strip_tags($d->title),100,'...')) }}</strong>
                          </a>
                          <p class="no-margin">{{ str_limit(strip_tags($d->content), 200, '...') }}</p>
                        </div>
                    </div>
                  </div>
                @endforeach
                @endif
            </div>
            <div class="col s3">
              <div class="row">
                  <div class="col s12">
                  <h5 class="center"><strong>Tags</strong></h5>
                  </div>
              </div>
              <div class="row margin-bottom-5">
                  <div class="col s12">
              @if($tags)
              @foreach ($tags as $tag)
                  <a class="btn btn-flat btn-small btn-tags-custom waves-effect font{{($tag->pages_count*10)/($sumTagCount?$sumTagCount:1)}}" href="#">{{$tag->name}}</a>
              @endforeach
              @endif
                  </div>
              </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
@stop
