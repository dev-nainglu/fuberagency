@extends('layouts.app')

@section('content')
<style>
    .file-preview{
        padding: 15px;
    }
    .file-preview-frame{
        width: 24%;
        float: left;
        margin-left: 1%;
        border: 1px solid grey;
    }
    .file-caption.form-control{
        display: none;
    }
    .file-preview-frame .kv-file-content img{
        height: 250px;
    }
    .file-caption, .kv-fileinput-caption{
        border: none;
        outline: none;
    }
    .file-caption .file-caption-icon{
        display: none;
    }
    .file-caption input{
        display: none;
    }
    
</style>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Lady Image</h1>
    <a href="/ladies/new" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-form fa-sm text-white-50"></i> Register Lady</a>
</div>

<!-- Content Row -->
<div class="row">
    @foreach($images as $image)
    <div class="card col-xl-2 col-md-6 mb-4">
        <img class="card-img-top" src="{{asset($image->path.$image->name)}}" style="min-height: 250px;">
        
    </div>
    @endforeach
</div>

<div class="col-xl-12 col-lg-12">
    <div class="card mb-4" style="padding-left: 20px;">
        <div class="form-group">
            <div class="file-loading">
                <input id="image-file" type="file" name="file" accept="image/*" data-min-file-count="1" multiple>
            </div>
        </div>
    </div>
</div>

    
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $("#image-file").fileinput({
            theme: 'fa',
            uploadUrl: "{{route('image.upload')}}",
            uploadExtraData: function() {
                return {
                    _token: "{{ csrf_token() }}",
                    lady_id: "{{$lady_id}}"
                };
            },
            allowedFileExtensions: ['jpg', 'png', 'gif','jpeg'],
            overwriteInitial: false,
            maxFileSize:2048,
            maxFilesNum: 10
        });
    </script>

@stop