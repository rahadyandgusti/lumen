@if(count($tags))
@foreach ($tags as $tag)
  <a class="btn-flat btn-small btn-tags-custom waves-effect waves-light
    font{{round(($tag->pages_count*10)/($sumTagCount?$sumTagCount:1))}}
    red-text text-lighten-2" 
  href="{{ route('page.tag', $tag->name) }}">
    #{{$tag->name}}
  </a>
@endforeach
@endif