@extends('layouts.admin')
@section('title','Turnover')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         @yield('title')
      </h1>
      <ol class="breadcrumb">
         <li><a href="/admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">@yield('title')</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <!-- /.row 1 - small boxes -->
      <!-- form -->
      <div class="box box-primary">
         <!-- /.box-header -->
         <!-- form start -->
            <form role="form"  action="/admin/turnover/store" class="form-horizontal" method="post"  enctype="multipart/form-data" >
               {{ csrf_field() }}
                  
                  <div class="box-body">
               
                         <div class="col-md-6">
                           <div class="form-group col-md-12">
                              <label  class="control-label">Year</label> 
                                 <select name="year" class="form-control getTurnOver" id="year">
                                       @for($i=2017; $i<= date('Y');$i++)
                                       <option value="{{$i}}"  @if($i==date('Y')) selected="selected" @endif >{{$i}}</option>
                                       @endfor
                                 </select>                              
                           </div>
                        </div>

                        <div class="col-md-6">
                  <div class="form-group col-md-12">
                              <label  class="control-label">Month</label>
                               <select name="month" class="form-control getTurnOver" id="month">
                                       @for($j=1; $j <= date('m');$j++)
                                       <option value="{{$j}}"  @if($j==date('m')) selected="selected" @endif >{{ $j}}</option>
                                       @endfor
                                 </select>   
                           </div>
                        </div>

                        <div class="col-md-6">
                  <div class="form-group col-md-12">
                              <label  class="control-label">Current T.O</label>
                              <input type="text" class="form-control TurnOver" readonly="readonly" value="{{$TurnOver['turnovers']}}" name="currentTO">
                           </div>
                        </div>
                        <div class="col-md-6">
                              <div class="form-group col-md-12">
                              <label  class="control-label">Current Total Sell </label>
                              <input type="text" class="form-control TurnOver" readonly="readonly" value="{{$TurnOver['total_sell']}}">
                           </div>
                        </div>
                        
                        <div class="col-md-6">
                  <div class="form-group col-md-12">
                              <label  class="control-label">Set This Month T.O.</label>
                              <input type="text" class="form-control" name="manualTO">
                           </div>
                        </div>
                     </div>
                   

                  <div class="box-footer">
               <button type="submit" class="btn btn-primary">Add Turnover</button>
            </div>
            </form>
         </div>
         <!-- form -->
         <!-- list start -->
      <div class="box box-body box-success table-responsive" >
         <table id="example" class="table table-responsive table-bordered table-striped table-hover">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Actual T.O.</th>
                           <th>Manual T.O.</th>
                           <th>Month</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($turnoverHistories as $key=> $turnoverHistory)
                        <tr>
                           <td>{{$key+1}}</td>
                           <td>{{$turnoverHistory->actual_turnover}}</td>
                           <td>{{$turnoverHistory->manual_turnover}}</td>
                           <td>{{$turnoverHistory->month}}</td>
                           <td><a href="/admin/achievers/{{$turnoverHistory->month}}/{{$turnoverHistory->year}}/{{$turnoverHistory->manual_turnover}}/payout" class="btn btn-xs btn-primary">View Achievers Payout</a></td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </section>
         </div>
      <!-- end: page -->


@endsection