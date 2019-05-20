@extends('layouts.app')

@section('content')
<style>
    .card{
        margin-left: 5px;
    }
</style>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ladies</h1>
    <a href="/ladies/new" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-form fa-sm text-white-50"></i> Register Lady</a>
</div>

<!-- Content Row -->
<div class="row">
    @foreach($ladies as $lady)
        <div class="card col-xl-2 col-md-6 mb-4">
            <?php if(count($lady->images) > 0){ ?>
                <img class="card-img-top" src="{{asset($lady->images[0]->path.$lady->images[0]->name)}}" style="height: 250px;">
            <?php }else{ ?>
                <img class="card-img-top" src="{{asset('img/undraw_posting_photo.svg')}}" style="height: 250px;">
            <?php } ?>
            <div class="card-body">
                <h5 class="card-title">{{$lady->name}}</h5>
                    <a href="#" class="btn btn-sm btn-primary">編集</a>
                    <a href="#" class="btn btn-sm btn-primary">削除</a>
            </div>
        </div>
    @endforeach
</div>

@stop