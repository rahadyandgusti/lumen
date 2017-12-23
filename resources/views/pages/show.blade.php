@extends('layouts.master')

@section('styles')
<link href="{{ asset('plugin/ckeditor/plugins/codesnippet/lib/highlight/styles/monokai_sublime.css') }}" rel="stylesheet">
<style type="text/css">
    .btn-edit {
        position: absolute;
    }
    #content, #title {
        padding: 5px;
    }
    span.cke_reset.cke_widget_drag_handler_container, img.cke_reset.cke_widget_mask{
        display: none !important;
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
        <br>
        <div class="row">
            <div class="col s12">
                <div class="row">
                    @if(\Auth::user() && $data->created_id == \Auth::user()->id)
                    <div class="col s12">
                    <a href="{{ route('page.edit', $data->id) }}" class="btn-floating cyan left pulse btn-edit">
                        <i class="material-icons">edit</i>
                    </a>
                    </div>
                    @endif
                    <div class="col s12">
                    @if ($data->image_header)
                        <div id="image-preview">
                            <img src="{!! \ImageHelper::getContentHeader($data->image_header) !!}" class="col s12 materialboxed" />
                        </div>
                    @endif
                    </div>
                </div>
            </div>
            <div class="col s12 m8">
                <div class="row">
                    <div class="col s12">
                        <div id="title">
                            <h4>
                            {{ title_case($data->title) }}
                            </h4>
                        </div>
                    </div>
                    <div class="col s12">
                        <span class="grey-text">
                            <i class="material-icons tiny">face</i> {{ $data->createduser->name }} 
                            <i class="material-icons tiny">access_time</i> 
                                {{ ($data->updateduser)?
                                    \Carbon\Carbon::parse($data->updated_at)->format('d M Y H:i'):
                                    \Carbon\Carbon::parse($data->created_at)->format('d M Y H:i') 
                                }}
                            <i class="material-icons tiny">visibility</i> {{ number_format($data->hit,'0','',',') }}
                        </span>
                    </div>
                    <div class="col s12">
                        <div id="content">{!! $data->content !!}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col m12">
                        @if (count($data->tags))
                        @foreach ($data->tags as $tag)
                        <a class="red-text text-lighten-2" 
                        href="{{ route('page.tag', $tag->tag->name) }}">
                            #{{$tag->tag->name}}
                        </a>
                        @endforeach
                        @endif
                    </div>
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

        <div class="row no-margin">
            <div class="col m12">
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('plugin/ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js') }}"></script>
<script src="{{ asset('plugin/ckeditor/plugins/syntaxhighlight/dialogs/syntaxhighlight.js') }}"></script>
@stop
