@extends('layouts.myapp')

@section('content')
        <?php
        $gainedval='<i class="green"><i class="fa fa-sort-asc"></i>';
        $sameval = '<i>';
        $droppedval='<i class="red"><i class="fa fa-sort-desc"></i>';
        ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="text-center" style="margin-top: 75px;">
            <h3>Statistics <small>(Current Month)</small></h3>
          </div>
          <hr>
          <div class="row tile_count" style="margin-top: 25px; margin-bottom: 25px; ">
            <div class="col-md-3 col-sm-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
              <div class="count">{{  $userscount  }}</div>
              <span class="count_bottom"><i>0% </i> From last Month</span>
            </div>
            <div class="col-md-3 col-sm-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-table"></i> Total Records</span>
              <div class="count">{{  $expcount  }}</div>
              <span class="count_bottom">
                @if($expcount_per_diff>0)
                {!! $gainedval !!}
                @elseif($expcount_per_diff==0)
                {!! $sameval !!}
                @else
                {!! $droppedval !!}
                @endif
              {{ abs($expcount_per_diff) }}% </i> From last Month</span>
            </div>
            <div class="col-md-3 col-sm-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-table"></i> Deleted Records</span>
              <div class="count">{{  $exptrashedcount  }}</div>
              <span class="count_bottom">
                @if($exptrashedcount_per_diff>0)
                {!! $gainedval !!}
                @elseif($exptrashedcount_per_diff==0)
                {!! $sameval !!}
                @else
                {!! $droppedval !!}
                @endif
              {{ abs($exptrashedcount_per_diff) }}% </i> From last Month</span>
            </div>
            <div class="col-md-3 col-sm-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-rupee"></i> Total Expense</span>
              <div class="count">{{ $exp_total }}</div>
              <span class="count_bottom">
                @if($exp_total_per_diff>0)
                {!! $gainedval !!}
                @elseif($exp_total_per_diff==0)
                {!! $sameval !!}
                @else
                {!! $droppedval !!}
                @endif
              {{ abs($exp_total_per_diff) }}% </i> From last Month</span>
            </div>
          </div>
          <hr>
          <!-- /top tiles -->
          <div class="text-center" style="margin-top: 25px;">
            <h3>Individual User Expense <small>(Current Month)</small></h3>
          </div>
          <hr>
          <!-- top tiles -->
          <div class="row tile_count" style="padding-top: 25px; margin-bottom: 50px;">
            @foreach($exp_this as $expval)
            <div class="col-md-3 col-sm-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-rupee"></i> {{ $expval->name }}</span>
              <div class="count">{{ $expval->sum }}</div>
            </div>
            @endforeach
          </div>
          <hr>
          <!-- /top tiles -->
        </div>
        <!-- /page content -->
@endsection