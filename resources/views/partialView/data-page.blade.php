  <div class="row">
    <div class="col s12">
    </div>
  </div>
@if (count($data)) 
@foreach ($data as $d)
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
          <p class="truncate no-margin">
            @foreach ($d->tags as $tag)
                <a class="btn btn-flat btn-small btn-tags-custom waves-effect" href="#">
                  {{$tag->tag->name}}
                </a>
            @endforeach
          </p>
        </div>
    </div>
  </div>
@endforeach
@else
  <div class="row data-item">
    <div class="col s12">
      <p class="flow-text">No data to be shown</p>
    </div>
  </div>
@endif