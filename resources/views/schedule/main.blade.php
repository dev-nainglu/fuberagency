@extends('layouts.app')

@section('content')
<style>
    .lady-img{
        width: 25%;
        height: 50px;
    }
    .lady-img img{
        width: 100%;
        height: 100%;
    }
    .lady-info{
        width: 55%;
        margin-left: 3%;
    }
    .left{
        float: left;
    }
    table th, table td{
        padding: 10px;
    }
    .schedules{
        padding: 10px;
    }
    .schedules-part{
        overflow-x: scroll;
    }
    #space{
        height: 44px;
    }
    .each-girl{
        height: 65px;
        padding: 10px;
        border-bottom: 1px solid #a3b5ea;
    }
    #schtable{
        width: 4850px;
    }
    .time-col{
        width: 200px;
        float: left;
        border-right: 1px solid #d6def7;
    }
    .time-col p{
        background: #a3b5ea;
        padding: 10px;
        color: white;
        margin-bottom: 0;
    }
    .schedblock{
        background: #d6d6d6;
        border-bottom: 1px solid #d6def7;
        height: 65px;
    }
    .schedblock.active{
        background: red;
    }
</style>
<!-- main -->
<div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
        <!-- Card Body -->
        <div class="card-body row" style="min-height: 600px;">
            <div class="girls-part schedules col-xl-2 col-lg-2">
                <div id="space"></div>
                @foreach($ladies as $lady)
                    <div class="each-girl">
                        <div class="lady-img left">
                            <?php if(count($lady->images) > 0){ ?>
                                <img src="{{ asset($lady->images[0]->path.$lady->images[0]->name)}}" alt="{{$lady->name}} image">
                            <?php }else{ ?>
                                <img src="#" alt="">
                            <?php } ?>
                        </div>
                        <div class="lady-info left">
                            <h5>{{$lady->name}}</h5>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="schedules-part schedules col-xl-10 col-lg-10">
                <div id="schtable">
                    @for($i=1; $i<25; $i++)
                        <div class="time-col">
                            <?php if($i < 10){ ?>
                                <p>0{{$i}}:00</p>
                            <?php }else{ ?>
                                <p>{{$i}}:00</p>
                            <?php } ?>
                            @foreach($ladies as $lady)
                                <?php 
                                    $active = [];
                                    foreach($lady->schedules as $schedule){
                                        if($schedule->at_date == $today){
                                            if($i == $schedule->time_to || $i == $schedule->time_from){
                                                array_push($active, "active");
                                            }else{
                                                array_push($active, "non");
                                            }
                                        }else{
                                            array_push($active, "non");
                                        }
                                    }
                                ?>
                                <div class="schedblock <?php print_r($active);?>" id="g{{$lady->id}}-t"></div>
                            @endforeach
                        </div>
                    @endfor
                </div>
            </div>
            
        </div>
    </div>
</div>


@stop