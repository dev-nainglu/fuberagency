@extends('layouts.app')

@section('content')
<style>
    .card{
        margin-left: 5px;
    }
</style>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a href="/ladies/new" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-form fa-sm text-white-50"></i>新規登録</a>
</div>

<!-- Content Row -->
<div class="row">
    @foreach($ladies as $lady)
        <div class="card col-xl-2 col-md-6 mb-4 ladies">
            <?php if(count($lady->images) > 0){ ?>
                <img class="card-img-top" src="{{asset($lady->images[0]->path.$lady->images[0]->name)}}" style="height: 250px;">
            <?php }else{ ?>
                <img class="card-img-top" src="{{asset('img/undraw_posting_photo.svg')}}" style="height: 250px;">
            <?php } ?>
            <div class="card-body">
                <h5 class="card-title">{{$lady->name}}</h5>
                    <a href="ladies/{{$lady->id}}/edit" class="btn btn-sm btn-primary">編集</a>
                    <a href="#" class="btn btn-sm btn-primary">削除</a>
            </div>
        </div>
    @endforeach
</div>
<script type="text/javascript">
    $(".ladies").draggable();
</script>
@stop