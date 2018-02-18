@extends('layouts.myapp')

@section('header-style')
    <!-- Datatables -->
    <link href="{{ asset('swarepro/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('swarepro/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('swarepro/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('swarepro/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('swarepro/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">

    <!-- Forms -->
    <!-- bootstrap-wysiwyg -->
    <link href="{{ asset('swarepro/vendors/google-code-prettify/bin/prettify.min.css') }}" rel="stylesheet">
    <!-- Select2 -->
    <link href="{{ asset('swarepro/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <!-- Switchery -->
    <link href="{{ asset('swarepro/vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">
    <!-- starrr -->
    <link href="{{ asset('swarepro/vendors/starrr/dist/starrr.css') }}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('swarepro/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!--advanced form-->
    <!-- bootstrap-datetimepicker -->
    <link href="{{ asset('swarepro/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
    <!--Forms Close-->
<style type="text/css">
  .nk-icon-button{
    cursor: pointer;
  }
</style>
@endsection

@section('content')
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Manage Expenses</h3>
              </div>

              <!--
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
          	  -->
            </div>

            <div class="clearfix"></div>

            @if(count($expenses) > 0)
            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>All Expenses</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @if(session('dstatus') && session('dstatus')==1)
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>Expense Deleted Successfully.</p>
                        </div>
                    @endif
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Member Name</th>
                          <th>Date</th>
                          <th>Purpose</th>
                          <th>Amount</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($expenses as $expense)
                        <tr>
                          <td>{{ $expense['id'] }}</td>
                          <td>{{ $expense->user->name }}</td>
                          <td>{{ $expense['date'] }}</td>
                          <td style="max-width: 150px;">{{ $expense['purpose'] }}</td>
                          <td>{{ $expense['amount'] }}</td>
                          <td>
                          @if($expense->user->id == $currentUser->id)
                            <span onclick="nkedit({{ json_encode($expense) }});" class="fa-stack nk-icon-button" style="margin-right: 15px;">
                              <i class="fa fa-square fa-stack-2x" style="color: #ea900e;"></i>
                              <i class="fa fa-edit fa-stack-1x" style="color: white;"></i>
                            </span>
                            <span onclick="nkdelete({{ $expense['id'] }});" class="fa-stack nk-icon-button" style="margin-right: 15px;">
                              <i class="fa fa-square fa-stack-2x" style="color: red;"></i>
                              <i class="fa fa-trash fa-stack-1x" style="color: white;"></i>
                            </span>
                          @else
                            NA
                          @endif
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            @endif

            <div class="row" id="addoreditbox">
              <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add/Edit Expense</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />

                    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12" id="error_container">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissable">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session('status') && session('status')==1)
                        <div class="alert alert-success alert-dismissable">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>Expense Details Added/Updated Succesfully.</p>
                        </div>
                    @elseif(session('status') && session('status')==0)
                        <div class="alert alert-danger alert-dismissable">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ session('exception') }}</p>
                        </div>
                    @endif
                    </div>

                    <form class="form-label-left input_mask" method="POST" action="{{ route('manage-expenses.store') }}" id="manageexpensesform">

                      {{ csrf_field() }}

                      <input type="hidden" id="methodfield" name="_method" value="PATCH">

                      <input type="hidden" name="user_id" value="{{ $currentUser->id }}">

                      <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 form-group has-feedback">
                        <input type="text" name="id" class="form-control has-feedback-left" id="id" placeholder="ID" readonly="readonly" value="ID">
                        <span class="fa fa-list form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="clearfix"></div>

                      <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 form-group has-feedback">
                        <input type="text" name="name" class="form-control has-feedback-left" id="name" placeholder="Name" readonly="readonly" required="" value="{{ $currentUser->name }}">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="clearfix"></div>

                      <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 xdisplay_inputx form-group has-feedback">
                                <input type="text" name="date" class="form-control has-feedback-left" id="date" placeholder="Date" aria-describedby="inputSuccess2Status" required="">
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                <span id="inputSuccess2Status" class="sr-only">(success)</span>
                      </div>
                      
                      <div class="clearfix"></div>

                      <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 form-group has-feedback">
                        <input type="text" name="amount" class="form-control has-feedback-left" id="amount" placeholder="Amount" pattern="[1-9]{1}[0-9]{1,4}" required="">
                        <span class="fa fa-rupee form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="clearfix"></div>

                      <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 form-group has-feedback">
                        <input type="text" name="purpose" class="form-control has-feedback-left" id="purpose" placeholder="Purpose" required="">
                        <span class="fa fa-comment form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="clearfix"></div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <!--<button type="button" class="btn btn-primary">Cancel</button>-->
						              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>

                    <form method="POST" action="" id="deleteexpense">
                      {{ csrf_field() }}
                      <input type="hidden" name="_method" value="Delete">
                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
@endsection

@section('footer-script')
<!-- Datatables -->
    <script src="{{ asset('swarepro/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/pdfmake/build/vfs_fonts.js') }}"></script>

 <!--form-->
     <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('swarepro/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="{{ asset('swarepro/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/jquery.hotkeys/jquery.hotkeys.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/google-code-prettify/src/prettify.js') }}"></script>
    <!-- jQuery Tags Input -->
    <script src="{{ asset('swarepro/vendors/jquery.tagsinput/src/jquery.tagsinput.js') }}"></script>
    <!-- Switchery -->
    <<script src="{{ asset('swarepro/vendors/switchery/dist/switchery.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('swarepro/vendors/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- Parsley -->
    <script src="{{ asset('swarepro/vendors/parsleyjs/dist/parsley.min.js') }}"></script>
    <!-- Autosize -->
    <script src="{{ asset('swarepro/vendors/autosize/dist/autosize.min.js') }}"></script>
    <!-- jQuery autocomplete -->
    <script src="{{ asset('swarepro/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js') }}"></script>
    <!-- starrr -->
    <script src="{{ asset('swarepro/vendors/starrr/dist/starrr.js') }}"></script>
    <!--advanced form-->
    <!-- bootstrap-datetimepicker -->    
    <script src="{{ asset('swarepro/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
 <!--form close-->
 <!-- jquery.inputmask -->
    <script src="{{ asset('swarepro/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>
<script type="text/javascript">
    $('#date').daterangepicker({
    	      locale: {
		        format: 'DD-MM-YYYY'
		      },
        	  maxDate: new Date(),
			  singleDatePicker: true,
			  singleClasses: "picker_1"
			}, function(start, end, label) {
			  console.log(start.toISOString(), end.toISOString(), label);
	});
  function nkedit(expense){
    console.log(expense);
    $('#error_container').css('display','none');
    $('#id').val(expense.id);
    $('#date').val(expense.date);
    $('#amount').val(expense.amount);
    $('#purpose').val(expense.purpose);
    //window.location.href = '#addoreditbox';
    $('html, body').animate({
        scrollTop: $("#addoreditbox").offset().top
    }, 500);
  }
  function nkdelete(id){
    console.log(id);
    $('#error_container').css('display','none');
    if(confirm('Are you sure? Do you want to delete expense ID='+id)){
        $('#deleteexpense').attr('action','{{ url('manage-expenses') }}/'+id);
        $('#deleteexpense').submit();
    }
  }
  $(document).ready(function(){
      $("#manageexpensesform").submit(function(e){
          //e.preventDefault();
          var thisid = $('#id').val();
          if(thisid == 'ID' || thisid == ''){
            console.log('Add');
            $('#methodfield').attr('disabled','');
          }
          else{
            console.log('Edit');
            $('#methodfield').removeAttr('disabled');
            $(this).attr('action','{{ url('manage-expenses') }}/'+thisid);
          }
      });
      @if ($errors->any() || session('status') )
        $('html, body').animate({
            scrollTop: $("#addoreditbox").offset().top
        }, 100);
      @endif
  });
</script>
@endsection