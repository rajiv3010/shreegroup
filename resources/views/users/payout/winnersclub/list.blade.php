@extends('layouts.user')
@section('title','Winners Club Income')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="page-title">
         <div class="title_left">
            <h3>@yield('title') </h3>
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
                                    <th>Club</th>
                                    <th>Target</th>
                                    <th>Achieved Date</th>
                                    <th>Total Income</th>
                                    <th>Details</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 
                                 @foreach($WinnersClubPayout as $key=>$value)
                                 <tr>
                                    <td>{{$key+1}} @if($value->status == 0) <img src="https://media.giphy.com/media/3ohhwpHlr2Kei7ynJu/giphy.gif" width="50"> @else <i class="fa fa-circle" style="color:green;"></i>  @endif</td>
                                    <td>{{$value->winnersClub->name}}</td>
                                    <td>{{$value->winnersClub->count}}:{{$value->winnersClub->count}}</td>
                                    <td>{{$value->date}}</td>
                                    <td>{{$value->amount}}</td>
                                    <td>
                                       <a href="/payout/winners-club/details/{{$value->winnersClub->business_area_id}}" class="btn btn-xs btn-info">View</a>
                                       
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