@if(count($tags))
@foreach ($tags as $tag)
  <a class="btn btn-flat btn-small btn-tags-custom waves-effect 
    font{{round(($tag->pages_count*10)/($sumTagCount?$sumTagCount:1))}}" 
  href="#">
    {{$tag->name}}
  </a>
@endforeach
@endif