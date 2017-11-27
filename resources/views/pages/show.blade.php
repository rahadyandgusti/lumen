@extends('layouts.master')

@section('styles')
@stop

@section('content')
<div class="container">
    <br>
    <div class="row">
        <div class="col s12">
        @if ($data->image_header)
            <img src="{!! \ImageHelper::getContentHeader($data->image_header) !!}"/>
            @if(\Auth::user() && $data->created_id == \Auth::user()->id)
            <a href="{{ route('page.edit', $data->id) }}" class="btn-floating red accent-2 right">
                <i class="material-icons right">edit</i>
            </a>
            @endif
        @endif
        </div>
        <div class="col s12">
            <div id="title">{!! $data->title !!}</div>
        </div>
        <div class="col s12">
            <span class="grey-text">
                Created by {{ $data->createduser->name }} at {{ \Carbon\Carbon::parse($data->created_at)->format('d M Y H:i') }}
                    @if (
                        $data->updateduser && 
                        ($data->updateduser->id != $data->createduser->id || $data->created_at != $data->updated_at)
                    )
                    and updated
                    @if ($data->updateduser->id != $data->createduser->id)
                    by {{ $data->updateduser->name }} 
                    @endif
                    @if ($data->created_at != $data->updated_at)
                    at {{  \Carbon\Carbon::parse($data->updated_at)->format('d M Y H:i') }}
                    @endif
                @endif
            </span>
        </div>
        <div class="col s12">
            <div id="content">{!! $data->content !!}</div>
        </div>
    </div>
    <div class="row">
        <div class="col m12">
            
        </div>
    </div>
</div>
@endsection

@section('scripts')

@stop
