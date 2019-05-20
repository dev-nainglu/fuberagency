@extends('layouts.app')

@section('content')
<!-- main -->
<div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Schedules</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body" style="height: 600px;">
            <div id="gantt_here" style='width:100%; height:100%;'></div>
            <script type="text/javascript">
                gantt.config.xml_date = "%Y-%m-%d %H:%i:%s";
 
                gantt.init("gantt_here");
                
                gantt.load("/schedules/data");

            </script>
        </div>
    </div>
</div>


@stop