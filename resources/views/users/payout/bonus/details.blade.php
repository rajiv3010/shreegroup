@extends('layouts.user')
@section('title','Income Details')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="page-title">
         <div class="title_left">
            <h3>@yield('title') </h3> <a href="{{ URL::previous() }}" class="btn btn-xs btn-success"><i class="fa fa-backward"></i> Back</a>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>@yield('title') </h2>
                  <div class="clearfix"></div>
               </div>
               <div class="x_content">
                  <div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                     <div class="row">
                        <div class="col-sm-12">
                           <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">
                              <thead>
                                 <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Income</th>
                                    <th>TDS</th>
                                    <th>Admin Charge</th>
                                    <th>Earned</th>
                                    <th>Status</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach($BonusClubIncome as $key=>$value)
                                 <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$value->created_at}}</td>
                                    <td>{{$value->earning}}</td>
                                    <td>{{$value->tds}}</td>
                                    <td>{{$value->admin_charges}}</td>
                                    <td>{{$value->amount}}</td>
                                    <td>@if($value->status == 0)
                                       Unpaid
                                       @elseif($value->status == 1)
                                       Paid
                                       @endif
                                    </td>
                                 </tr>
                                 @endforeach
                                 
                              </tbody>
                              <thead>
                                 <tr>
                                    <th>&nbsp;&nbsp;</th>
                                    <th>&nbsp;&nbsp;</th>
                                    <th>&nbsp;&nbsp;</th>
                                    <th>&nbsp;&nbsp;</th>
                                    <th>&nbsp;&nbsp;</th>
                                    <th>&nbsp;&nbsp;</th>
                                    <th>&nbsp;&nbsp;</th>
                                 </tr>
                              </thead>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
      </div>
      <div class="clearfix"></div>
   </div>
   <div class="clearfix"></div>
</div>
<!-- /page content -->
@endsection