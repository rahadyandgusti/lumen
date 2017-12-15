
@extends('layouts.master')

@section('styles')
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
        <div class="row no-margin data-item">
                @if (count($data)) 
                @foreach ($data as $d)
                        @if($d->image_header)
                  <div class="col s12 m6 l3">
                    <a href="#modal1" class="modal-trigger" data-id="{{$d->id}}">
                    <div class="col s12">
                        <div class="col s12">
                            <img src="{{ \ImageHelper::getContentHeaderThumb($d->image_header) }}" alt="" class="responsive-img ">
                        </div>
                    </div>
                    </a>
                  </div>
                        @endif
                @endforeach
                @endif
        </div>
    </div>
</section>

<!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4 id="title"></h4>
      <div id="image"></div>
      <p id="description"></p>
    </div>
    <div class="modal-footer">
      <a href="#!" id="prev" class=" waves-effect waves-green btn-flat left">prev</a>
      <a href="#!" id="next" class=" waves-effect waves-green btn-flat right">next</a>
    </div>
  </div>

@endsection

@section('scripts')
<script type="text/javascript">
  var index = 0;
  $(document).ready(function(){
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
    $('.modal').modal({
      ready: function(modal, trigger) { 
        getDataShow($(trigger).data('id'));
      },
      complete: function() { 
        window.history.pushState("", "", "{{\Request::url()}}");
      }
    });
  });
  $(document).on('click','#next', function(e){
      e.preventDefault();
      var newIndex = parseInt(index) + 1;
      if($('.data-item').children().eq(newIndex)){
        var data = $('.data-item').children().eq(newIndex);
        console.log(data);
        getDataShow($('.data-item').children().eq(newIndex).find('a.modal-trigger').data('id')); 
      }
      return false;
  })
  $(document).on('click','#prev', function(e){
      e.preventDefault();
      if(parseInt(index) != 0){
        var newIndex = index - 1;
        getDataShow($('.data-item').children().eq(newIndex).find('a.modal-trigger').data('id')); 
      }
      return false;
  })

  function getDataShow(id){
    $.ajax({
          url:'{{url("getdata")}}/'+id,
          method:'get',
          success: function(data){
            window.history.pushState("", "", "{{url('/')}}" +  "/page/"+data.slug);
            $('#modal1').find('#title').html(data.title);
            $('#modal1').find('#image').html('<img src="{{url("image/content/header")}}/'+data.image_header+'"/>');
            $('#modal1').find('#description').html(data.content);
          }
        })
  }
</script>
@stop
