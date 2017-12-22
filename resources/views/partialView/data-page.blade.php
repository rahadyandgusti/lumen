  <div class="row">
    <div class="col s12">
    </div>
  </div>
@if (count($data)) 
@foreach ($data as $d)
  <div class="row ">
    <div class="col s12">
        <div class="hide-on-med-and-down card-panel hoverable button-collapse" data-activates="preview" data-id="{{$d->id}}">
          <h5>
          <a href="{{ url('page/'.$d->slug) }}">
              <span class="card-title">{{ title_case(str_limit(strip_tags($d->title),90,'...')) }}</span>
          </a>
          </h5>
          <p class="grey-text">by {{$d->createduser?$d->createduser->name:'-'}}</p>
          <span>
            @foreach ($d->tags as $tag)
                <a class="red-text text-lighten-2" href="{{ route('page.tag', $tag->tag->name) }}">
                  #{{$tag->tag->name}}
                </a>
            @endforeach
          </span>
        </div>
        <div class="hide-on-large-only card-panel hoverable">
          <h5>
          <a href="{{ url('page/'.$d->slug) }}">
              <span class="card-title">{{ title_case(str_limit(strip_tags($d->title),90,'...')) }}</span>
          </a>
          </h5>
          <p class="grey-text">by {{$d->createduser?$d->createduser->name:'-'}}</p>
          <span>
            @foreach ($d->tags as $tag)
                <a class="red-text text-lighten-2" href="{{ route('page.tag', $tag->tag->name) }}">
                  #{{$tag->tag->name}}
                </a>
            @endforeach
          </span>
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