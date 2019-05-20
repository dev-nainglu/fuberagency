@extends('layouts.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add New Lady</h1>
</div>

<div class="col-xl-6 col-lg-6">
    <div class="card shadow mb-4">
        <!-- Card Body -->
        <div class="card-body">
            <form method="post" action="{{url('/ladies')}}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="ladyname">Name</label>
                    <input type="text" name="name" class="form-control" id="ladyname" placeholder="eg: Aoi Sora" required>
                </div>
                <div class="form-group">
                    <label for="ladyage">Age</label>
                    <input type="text" name="age" class="form-control" id="ladyage" placeholder="eg: 23" required>
                </div>
                <div class="form-group">
                    <label for="ladyheight">Height</label>
                    <input type="text" name="height" class="form-control" id="ladyheight" placeholder="eg: 160 cm" required>
                </div>
                <div class="form-group">
                    <label for="ladysize">B:W:H</label>
                    <input type="text" name="bwh" class="form-control" id="ladysize" placeholder="eg: 32:24:36" required>
                </div>
                <div class="form-group">
                    <label for="ladyblogurl">Blog URL</label>
                    <input type="text" name="blogurl" class="form-control" id="ladyblogurl" placeholder="eg: https://www.dto.jp/gal/2405354/diary?diary_id=49012826" required>
                </div>
                <div class="form-group">
                    <label for="ladyprice">Price</label>
                    <input type="text" name="price" class="form-control" value="300000" id="ladyprice" placeholder="eg: 300000" required>
                </div>
                <div class="form-group">
                    <label for="ladyabout">About</label>
                    <textarea type="text" name="about" class="form-control" id="ladyaobut" placeholder="eg: I will make you happy."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>

@stop