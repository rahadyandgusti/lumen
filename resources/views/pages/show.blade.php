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
<div class="container">
    <br>
    <div class="row">
        @if(\Auth::user() && $data->created_id == \Auth::user()->id)
        <a href="{{ route('page.edit', $data->id) }}" class="btn-floating cyan pulse btn-edit">
            <i class="material-icons right">edit</i>
        </a>
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
                <i class="close material-icons">local_offer</i>
                {{$tag->tag->name}}
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')

@stop
