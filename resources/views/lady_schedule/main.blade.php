@extends('layouts.app')

@section('content')
<style>
    .lady-img{
        width: 100px;
        height: 130px;
    }
    select{
        margin-left: 25px;
    }
    table thead tr{
        height: 50px;
        text-align: center;
    }
    table thead th:not(:first-child):not(:nth-child(2)){
        border: 1px solid #e6e4e4;
    }
    table tr {
        border-bottom: 1px solid #e6e4e4;
    }
    table td {
        padding: 10px;
        border-left: 1px solid #e6e4e4;

    }
    table thead th.today{
        background: #4e73df;
        color: white;
    }
    table tbody td:last-child{
        border-right: 1px solid #e6e4e4;
    }
    .save{
        display: block;
        width: 70px;
        height: 70px;
        border-radius: 35px;
        position: fixed;
        bottom: 50px;
        right: 50px;
    }
</style>
<div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
        <div class="card-body">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        @foreach($dates as $date)
                            <?php 
                                $darr = explode("-", $date);
                                $m = $darr[1];
                                $d = $darr[2];
                            ?>
                            <th scope="col" class="<?php if($date == $today){ echo "today";} ?>">{{$m}}月 {{$d}}日</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($ladies as $lady)
                        <tr>
                            <td>{{$lady->name}}</td>
                            <?php if(count($lady->images) > 0){ ?>
                                <td><img src="{{ asset($lady->images[0]->path.$lady->images[0]->name)}}" alt="{{$lady->name}} image" class="lady-img"></td>
                            <?php }else{ ?>
                                <td><img src="#" alt="" class="lady-img"></td>
                            <?php } ?>
                            @foreach($dates as $date)
                                <?php 
                                    foreach($lady->schedules as $schedule){
                                        if($schedule->at_date == $date){
                                            $active = 'checked';
                                        }else{
                                            $active = "";
                                        }
                                    }
                                ?>
                                <td>
                                    <select name="from_{{$lady->id}}_{{$date}}" id="from_{{$lady->id}}_{{$date}}">
                                        <option value="1">01:00</option>
                                        <option value="2">02:00</option>
                                        <option value="3">03:00</option>
                                        <option value="4">04:00</option>
                                        <option value="5">05:00</option>
                                        <option value="6">06:00</option>
                                        <option value="7">07:00</option>
                                        <option value="8">08:00</option>
                                        <option value="9">09:00</option>
                                        <option value="10">10:00</option>
                                        <option value="11">11:00</option>
                                        <option value="12">12:00</option>
                                        <option value="13">13:00</option>
                                        <option value="14">14:00</option>
                                        <option value="15">15:00</option>
                                        <option value="16">16:00</option>
                                        <option value="17">17:00</option>
                                        <option value="18">18:00</option>
                                        <option value="19">19:00</option>
                                        <option value="20">20:00</option>
                                        <option value="21">21:00</option>
                                        <option value="22">22:00</option>
                                        <option value="23">23:00</option>
                                        <option value="24">24:00</option>
                                    </select> <br/>
                                    <input type="checkbox" name="check_{{$lady->id}}_{{$date}}" value="{{$lady->id}}_{{$date}}" <?php if(isset($active)){echo $active;} ?>>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;~ <br/>
                                    <select name="to_{{$lady->id}}_{{$date}}" id="to_{{$lady->id}}_{{$date}}">
                                        <option value="1">01:00</option>
                                        <option value="2">02:00</option>
                                        <option value="3">03:00</option>
                                        <option value="4">04:00</option>
                                        <option value="5">05:00</option>
                                        <option value="6">06:00</option>
                                        <option value="7">07:00</option>
                                        <option value="8">08:00</option>
                                        <option value="9">09:00</option>
                                        <option value="10">10:00</option>
                                        <option value="11">11:00</option>
                                        <option value="12">12:00</option>
                                        <option value="13">13:00</option>
                                        <option value="14">14:00</option>
                                        <option value="15">15:00</option>
                                        <option value="16">16:00</option>
                                        <option value="17">17:00</option>
                                        <option value="18">18:00</option>
                                        <option value="19">19:00</option>
                                        <option value="20">20:00</option>
                                        <option value="21">21:00</option>
                                        <option value="22">22:00</option>
                                        <option value="23">23:00</option>
                                        <option value="24">24:00</option>
                                    </select>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <button class="btn btn-primary save" id="schedsavebutt">Save</button>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $("button").click(function(){
                var to = [];
                var from = [];
                $("input:checkbox:checked").each(function(){
                    var checkval = $(this).val();
                    var t = $("#to_"+checkval).val();
                    var f = $("#from_"+checkval).val();
                    to.push(checkval+"_"+t);
                    from.push(checkval+"_"+f);
                });
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "ladyschedules/save",
                    method: 'post',
                    data: {
                        to: to,
                        from: from
                    },
                    success: function(data){
                        if(data == "success"){
                            location.reload();
                        }
                    }
                });
            });
        });
    </script>
</div>

@stop