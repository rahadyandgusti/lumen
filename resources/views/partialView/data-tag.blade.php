@php
$data = \TagHelper::getTagData();
$tags = $data['tags'];
$sumTagCount = $data['total'];
@endphp
@foreach ($tags as $tag)
  <a class="btn-flat btn-small btn-tags-custom waves-effect waves-light
    font{{round(($tag->pages_count*10)/($sumTagCount?$sumTagCount:1))}}
    red-text text-lighten-2" 
  href="{{ route('page.tag', $tag->name) }}">
    #{{$tag->name.'|'.$tag->pages_count}}
  </a>
@endforeach