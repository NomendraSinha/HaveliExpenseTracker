@extends('layouts.myapp')

@section('header-style')
<style type="text/css">
  .tile_stats_count{
    padding: 20px !important;
    text-align: center !important;
  }
</style>
@endsection

@section('content')
        <?php
        $gainedval='<i class="green"><i class="fa fa-sort-asc"></i>';
        $sameval = '<i>';
        $droppedval='<i class="red"><i class="fa fa-sort-desc"></i>';
        ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <form method="POST" action="{{ route('myhomefiltered') }}" id="monthfilterform">
            {{ csrf_field() }}
            <div class="form-group col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4 col-xs-12 text-center">
              <label for="monthfilter">Select Month</label>
              <?php 
              $currentMonth = intval(date('m'));
              ?>
              <select class="form-control" id="monthfilter" name="monthfilter">
                @for($i=$currentMonth; $i>0; $i--)
                <?php
                  $dateObj   = DateTime::createFromFormat('!m', $i);
                  $monthName = $dateObj->format('M'); // March
                ?>
                  <option value="{{ $i }}" <?php if(isset($monthfilterval) && $monthfilterval==$i){ echo "selected";} ?> >{{ $monthName.date(" - Y") }}</option>
                @endfor
              </select>
            </div>
          </form>
          <!-- top tiles -->
          <div class="text-center" style="margin-top: 50px;">
            <h3>Statistics</h3>
          </div>
          <hr>
          <div class="row tile_count" style="margin-top: 25px; margin-bottom: 25px; ">
            <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
              <div class="count">{{  $userscount  }}</div>
              <span class="count_bottom"><i>0% </i> From last Month</span>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
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
            <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
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
            <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
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
          <!-- /top tiles -->
          <div class="text-center" style="margin-top: 25px;">
            <h3>Individual User Expense</h3>
          </div>
          <hr>
          <!-- top tiles -->
          <div class="row tile_count" style="padding-top: 25px; margin-bottom: 50px;">
            @foreach($exp_this as $expval)
            <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
              <span class="count_top"><i class="fa fa-rupee"></i> {{ $expval->name }}</span>
              <div class="count">{{ $expval->sum }}</div>
            </div>
            @endforeach
          </div>
          <!-- /top tiles -->
        </div>
        <!-- /page content -->
@endsection
@section('footer-script')
<script type="text/javascript">
  $(document).ready(function(){
    $('#monthfilter').on('change',function(){
      $('#monthfilterform').submit();
    });
  });
</script>
@endsection