@extends('layouts.master')

@section('styles')
<!-- <link rel="stylesheet" href="{{ asset('plugin/ckeditor/skins/moono-lisa/editor.css') }}"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropper/3.1.3/cropper.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
    #image-preview {
        /*width: 942px;
        height: 325px;*/
        overflow: hidden;
    }
    .btn-float {
        position: absolute;
    }
    #content, #title h3 {
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
            <div class="col s12">
                <button class="btn-floating scale-transition btn-float
                    {{ isset($data)?($data->image_header?'scale-out':'scale-in'):'scale-in' }} btn-header-image"
                    onclick="toggleHeader('image')"
                >
                    <i class="material-icons">image</i>
                </button>
                <button class="btn-floating scale-transition btn-float red
                    {{ isset($data)?($data->image_header?'scale-in right':'scale-out'):'scale-out' }} btn-header-close" 
                    onclick="toggleHeader('close')"
                >
                    <i class="material-icons">close</i>
                </button>
            </div>
            <div id="image-section" style="display: {{ isset($data) && $data->image_header?'':'none' }}" onmouseover="toggleBtn('#btn-upload','over')" onmouseleave="toggleBtn('#btn-upload','leave')">
            <div class="col s12">
                <div id="image-preview"></div>
            </div>
            <div class="col m6">
                <img id="image" 
                    src="{{ isset($data)?( $data->image_header? \ImageHelper::getContentHeader($data->image_header):'https://fengyuanchen.github.io/cropperjs/images/picture.jpg'):'https://fengyuanchen.github.io/cropperjs/images/picture.jpg' }}" 
                    style="max-width: 100%"
                >
                <input type="file" id="image-upload" style="display: none">
            </div>
            <div class="col m6">
                <button class="btn-floating scale-transition left scale-out" id="btn-upload"><i class="material-icons">file_upload</i></button>
            </div>
            </div>
            <div class="col s12">
                <div id="title">
                    <h3 contenteditable=true id="title-form">
                @if(isset($data))
                    {{ title_case($data->title) }}
                @else
                    This is sample title. Click Here...
                @endif
                    </h3>
                </div>
            </div>
            <div class="col s12">
                <span class="grey-text">
                    <i class="material-icons tiny">face</i> {{ isset($data)? $data->createduser->name: \Auth::user()->name }} 
                    <i class="material-icons tiny">access_time</i> 
                        {{ \Carbon\Carbon::now()->format('d M Y H:i')}}
                </span>
            </div>
            <div class="col s12">
                <div id="content" style="min-height:100px">
                @if(isset($data))
                    {!! $data->content !!}
                @else
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Click Here...</p>
                @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m4 l3">
                <div class="input-field">
                    <select id="status" class="select_material">
                        <option value="draft" 
                            {{ (isset($data))?($data->status == 'draft'?'selected':''):'' }}
                        >Draft</option>
                        <option value="publish" 
                            {{ (isset($data))?($data->status == 'publish'?'selected':''):'' }}
                        >Publish</option>
                        <option value="hidden" 
                            {{ (isset($data))?($data->status == 'hidden'?'selected':''):'' }}
                        >Hidden</option>
                    </select>
                    <label>Status</label>
                </div>
            </div>
            <div class="col s12 m8 l9">
                    <label>Tags</label>
                    <select id="tags" class="browser-default" multiple="multiple">
                    @if(isset($data))
                        @foreach($data->tags as $tag)
                        <option value="{{$tag->tag_id}}" selected="selected">{{$tag->tag->name}}</option>
                        @endforeach
                    @endif
                    </select>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6">
                <a href="{{ route('home') }}" class="btn orange accent-2"><i class="material-icons left">arrow_back</i> Back</a>
                <button class="btn btn-save hide-on-small-only">Save<i class="material-icons right">send</i></button>
                <button class="btn btn-save right hide-on-med-and-up center">Save<i class="material-icons right">send</i></button>
            </div>

            <div class="col m6 hide-on-small-only">
                <button class="btn btn-delete red right"><i class="material-icons left">delete</i> Delete</button>
            </div>
        </div>
        <div class="row">
            <div class="col s12 hide-on-med-and-up center">
                <button class="btn btn-delete red"><i class="material-icons left">delete</i> Delete</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropper/3.1.3/cropper.min.js"></script>
<script src="https://cdn.ckeditor.com/4.7.3/full/ckeditor.js"></script>
<script type="text/javascript">
    var statusHeader = false;
    var image = document.getElementById('image');
    var imagePreview = document.getElementById('image-preview');
    var option = {
                    aspectRatio: 945 / 325,
                    viewMode: 2,
                    preview: imagePreview,
                    dragMode: 'move',
                    autoCropArea: 1,
                    restore: false,
                    modal: false,
                    guides: false,
                    highlight: false,
                    // cropBoxMovable: false,
                    // cropBoxResizable: false,
                    toggleDragModeOnDblclick: false,
                };
    var cropper = $('#image');

    $(document).ready(function(){
        @if(isset($data) && $data->image_header)
        statusHeader = true;
        var tmpOption = option;
            tmpOption.setData = {"x":0,"y":0,"width":945,"height":325,"rotate":0,"scaleX":1,"scaleY":1};
        // cropper = new cropper(image, option);
        cropper = cropper.cropper(option);
        $('#image-preview')
            .css('height',($('#image-preview').width()*325)/945);
        var imageData = cropper.cropper('getImageData');
        // cropper.setCropBoxData({left:0, top:0, width:image.width, height:image.height});
        @endif
        $("#tags").select2({
            tags: true,
            tokenSeparators: [',', ' '],
            createTag: function (params) {
                var term = $.trim(params.term);

                if (term === '') {
                  return null;
                }

                return {
                  id: term,
                  text: term,
                  newTag: true // add additional parameters
                }
            },
            ajax: {
                url: '{{ route("tag.get") }}',
                delay: 250,
                data: function (params) {
                    var query = {
                        search: params.term,
                        page: params.page || 1
                    }

                    // Query parameters will be ?search=[term]&page=[page]
                    return query;
                },
                processResults: function (data) {
                    // Tranforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.data
                    };
                },
                cache: true
            },
            minimumInputLength:1,
        });
    });

    $(document).on('click', '#btn-upload', function(e){
        $('#image-upload').click();
    });

    function toggleHeader(param){
        if (param == 'image') {
            $('#image-section').show();
            statusHeader = true;
            // cropper = new Cropper(image, option);
            cropper = cropper.cropper(option);
            toggleBtn('.btn-header-image','leave');
            $('.btn-header-close').addClass('right');
            toggleBtn('.btn-header-close','over');
            $('.btn-header-image').removeClass('right');
            $('#image-preview')
            .css('height',($('#image-preview').width()*325)/945);
        } else {
            $('#image-section').hide();
            statusHeader = false;
            toggleBtn('.btn-header-close','leave');
            $('.btn-header-image').addClass('right');
            toggleBtn('.btn-header-image','over');       
            $('.btn-header-close').removeClass('right');
        }
    }
    function toggleBtn(key,param){
        if (param == 'leave') {
            $(key).removeClass('scale-in');
            $(key).addClass('scale-out');
        } else {
            $(key).removeClass('scale-out');
            $(key).addClass('scale-in');
        }
    }

    function readFile(){
        if (this.files && this.files[0]) {
    
            var FR = new FileReader();
            
            FR.addEventListener("load", function(e) {
                cropper.destroy();
                document.getElementById("image").src = e.target.result;
                // cropper = new Cropper(image, option);
                cropper = cropper.cropper(option);
            }); 
            
            FR.readAsDataURL( this.files[0] );
        }
    }

    function strip(html){
       var tmp = document.createElement("DIV");
       tmp.innerHTML = html;
       return tmp.textContent || tmp.innerText || "";
    }

    document.getElementById("image-upload").addEventListener("change", readFile);

    $(document).on('keypress', '#title', function(e){
        if(e.which == 13){
            console.log('enter');
            e.preventDefault();
            return false;
        }
    });
    
    $(document).on('click', '.btn-save', function(){
        var token = $('meta[name=csrf-token]').attr('content');
        var tags = $('#tags').val();
        var status = $('#status').val();
        var content = $('#content').html();
        var title = strip($('#title-form').html().toLowerCase());
        var image = statusHeader? cropper.cropper('getCroppedCanvas').toDataURL('image/jpeg'): '';
        var url = '{{ $urlForm }}';
        var message = 'Are you sure to save this?';
        var messageFail = "Create data failed";
        var messageSucc = "Create data success";
        var method = "POST";
        var label = "Save it!";
        @if(isset($data))
            message = 'Are you sure to edit this?';
            messageFail = "Update data failed";
            messageSucc = "Update data success";
            method = "PUT";
            label = "Update it!";
        @endif
        var id;
        swal({
            title: message,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: label,
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return new Promise(function (resolve) {
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: { _token: token, content: content, _method: method, title: title, image_header: image, status: status, tags: tags},
                        success: function (result) {
                            if(result.respond) {
                                id = result.id;
                                resolve();
                            } else {
                                if(result.message){
                                    swal.showValidationError(
                                        result.message
                                    );
                                    resolve();
                                } else {
                                    swal.showValidationError(
                                        messageFail
                                    );
                                    resolve();
                                }
                            }
                        },
                        error: function($error) {
                            swal.showValidationError(
                                messageFail
                            );
                            resolve();
                        }
                    });
                })
            },
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                swal({
                  title: 'Yeayy..',
                  text: messageSucc,
                  type: 'success',
                  confirmButtonText: 'Ok'
                }).then(function (result) {
                    window.location = "{{url('page')}}/"+id;
                })
            }
        })
    });
    $(document).on('click', '.btn-delete', function(){
    @if(isset($data))
        var token = $('meta[name=csrf-token]').attr('content');
        var url = '{{ route("page.destroy",$data->id) }}';
        var message = 'Are you sure to DELETE this?';
        var messageFail = "Delete data failed";
        var messageSucc = "Delete data success";
        var method = "DELETE";
        var label = "Delete it!";
        swal({
            title: message,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: label,
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return new Promise(function (resolve) {
                    $.ajax({
                        url: url,
                        type: 'post',
                        context: {},
                        data: { _token: token, _method: method},
                        success: function (result) {
                            console.log(result);
                            if(result.respond) {
                                resolve();
                            } else {
                                if(result.message){
                                    swal.showValidationError(
                                        result.message
                                    );
                                } else {
                                    swal.showValidationError(
                                        messageFail
                                    );
                                }
                            }
                        },
                        error: function($error) {
                            swal.showValidationError(
                                messageFail
                            );
                        }
                    });
                })
            },
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                swal({
                  title: 'Yeayy..',
                  text: messageSucc,
                  type: 'success',
                  confirmButtonText: 'Ok'
                }).then(function (result) {
                    window.location = "{{route('home')}}";
                })
            }
        })
    @endif
    });
    var title = document.getElementById( 'title' );
    var content = document.getElementById( 'content' );
        // title.setAttribute( 'contenteditable', true );
        content.setAttribute( 'contenteditable', true );

    CKEDITOR.inline( 'content', {
        // Allow some non-standard markup that we used in the introduction.
        extraAllowedContent: 'a(documentation);abbr[title];code',
        removePlugins: 'stylescombo',
        // extraPlugins: 'sourcedialog',
        // Show toolbar on startup (optional).
        // startupFocus: true
    } );
</script>
@stop
