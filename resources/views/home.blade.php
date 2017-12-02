
@extends('layouts.master')

@section('styles')
@stop

@section('content')
<section class="head">
    <div class="container">
        <div class="row">
            <div class="col s6">
                <ul class="tabs">
                    <li class="tab col s6"><a class="active black-text" href="#add-data">New Data Added</a></li>
                    <li class="tab col s6"><a class="black-text" href="#view-data">Most Viewed</a></li>
                </ul>
            </div>
            <div class="col s6">
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
            <div id="add-data" class="col s8">
                <div class="row">
                    <div class="col s12">
                    &nbsp;
                    </div>
                </div>
                @if ($new) 
                @foreach ($new as $d)
                  <div class="row">
                    <div class="col s12">
                        @if($d->image_header)
                        <div class="col s2 no-padding">
                            <img src="{{ \ImageHelper::getContentHeaderThumb($d->image_header) }}" alt="" class="responsive-img materialboxed" width="150px">
                        </div>
                        <div class="col s10">
                        @else
                        <div class="col s12">
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
            <div id="view-data" class="col s8">
                <div class="row">
                    <div class="col s12">
                    &nbsp;
                    </div>
                </div>
                @if ($views) 
                @foreach ($views as $d)
                  <div class="row">
                    <div class="col s12">
                        @if($d->image_header)
                        <div class="col s2 no-padding">
                            <img src="{{ \ImageHelper::getContentHeaderThumb($d->image_header) }}" alt="" class="responsive-img materialboxed" width="150px">
                        </div>
                        <div class="col s10">
                        @else
                        <div class="col s12">
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
            <div class="col s4">
              <div class="row">
                  <div class="col s12">
                  </div>
              </div>
              <div class="row">
              @if($tags)
              @foreach ($tags as $tag)
                  <div class="col s12">
                  <a href="#"> {{$tag->name}}</a>
                  </div>
              @endforeach
              @endif
              </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
@stop
