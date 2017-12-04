@extends('layouts.master')

@section('styles')
<style type="text/css">
    .btn-edit {
        position: absolute;
    }
    #content, #title {
        padding: 5px;
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
            <div class="col s12">
                <div id="title">
                    <h3>
                    {{ title_case($data->title) }}
                    </h3>
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
                <div class="chip">
                    {{$tag->tag->name}}
                    <i class="material-icons tiny">local_offer</i>
                </div>
                @endforeach
                @endif
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

@stop
