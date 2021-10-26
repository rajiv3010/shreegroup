@extends('layouts.admin')
@section('title','Dashboard')
@section('content')
<style type="text/css">
   .db_card{
         background: #075863 !important;
         border: 1px solid #4b4b65 !important;
         color: #fff

   }
</style>
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
      <div class="row">

         <div class="col-lg-12 col-xs-12">
         <div class="col-lg-12 col-xs-12" style="background-color: #03414a; padding: 5px 0px; text-align: center; color: 
         #fff; font-weight: bolder; margin-bottom: 10px;">
            <a href="/admin/user-payment" class="label label-danger">Unpaid Amount = {{$Revenue}}</a> || <a href="/admin/payment/release" class="label label-warning">Processed = {{$processed}}</a> || <a href="/admin/payment/release/history" class="label label-info">Bank Processed = {{$under_processed}}</a> || <a href="/admin/payment/release/history" class="label label-success">Total Paid = {{$payment_received}}</a>
         </div>
         </div>
         
         <div class="col-lg-3 col-xs-6">
            <div class="small-box db_card">
               <div class="inner">
                  <h3>Users</h3>
               </div>
               <div class="icon">
                  <i class="ion ion-stats-bars"></i>
               </div>
               <a href="/admin/user" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>
         <div class="col-lg-3 col-xs-6">
            <div class="small-box db_card">
               <div class="inner">
                  <h3>Payouts</h3>
                  <!-- <p>XXXX</p> -->
               </div>
               <div class="icon">
                  <i class="ion ion-stats-bars"></i>
               </div>
               <a href="/admin/report/payouts" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>
         <div class="col-lg-3 col-xs-6">
            <div class="small-box db_card">
               <div class="inner">
                  <h3>Payments</h3>
                  <!-- <p>XXXX</p> -->
               </div>
               <div class="icon">
                  <i class="ion ion-stats-bars"></i>
               </div>
               <a href="/admin/report/payments" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>
         <div class="col-lg-3 col-xs-6">
            <div class="small-box db_card" >
               <div class="inner">
                  <h3>View Pins</h3>
                  <!-- <p>XXXX</p> -->
               </div>
               <div class="icon">
                  <i class="ion ion-stats-bars"></i>
               </div>
               <a href="/admin/pin/" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>
         <div class="col-lg-3 col-xs-6">
            <div class="small-box db_card">
               <div class="inner">
                  <h3>Pin Request</h3>
                  <!-- <p>XXXX</p> -->
               </div>
               <div class="icon">
                  <i class="ion ion-stats-bars"></i>
               </div>
               <a href="/admin/pin/request" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>
         <div class="col-lg-3 col-xs-6">
            <div class="small-box db_card">
               <div class="inner">
                  <h3>User Payment</h3>
                  <!-- <p>XXXX</p> -->
               </div>
               <div class="icon">
                  <i class="ion ion-stats-bars"></i>
               </div>
               <a href="/admin/user-payment" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>
         <div class="col-lg-3 col-xs-6">
            <div class="small-box db_card" >
               <div class="inner">
                  <h3>TDS</h3>
                  <!-- <p>XXXX</p> -->
               </div>
               <div class="icon">
                  <i class="ion ion-stats-bars"></i>
               </div>
               <a href="/admin/report/tds" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>
         
         <div class="col-lg-3 col-xs-6">
            <div class="small-box db_card" >
               <div class="inner">
                  <h3>Queries</h3>
               </div>
               <div class="icon">
                  <i class="ion ion-stats-bars"></i>
               </div>
               <a href="/admin/queries" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>



          <div class="col-lg-3 col-xs-6">
            <div class="small-box db_card">
               <div class="inner">
                  <h3>{{$totalMembers}}</h3>
                  <p>Total Users</p>
               </div>
               <div class="icon">
                  <i class="ion ion-stats-bars"></i>
               </div>
               <a href="/admin/user" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>
        
         <div class="col-lg-3 col-xs-6">
            <div class="small-box db_card">
               <div class="inner">
                  <h3>{{$nonActiveMembers}}</h3>
                  <p>Pending Users</p>
               </div>
               <div class="icon">
                  <i class="ion ion-stats-bars"></i>
               </div>
               <a href="/admin/user" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>
         <div class="col-lg-3 col-xs-6">
            <div class="small-box db_card">
               <div class="inner">
                  <h3>{{$activeMembers}}</h3>
                  <p>Active Users</p>
               </div>
               <div class="icon">
                  <i class="ion ion-stats-bars"></i>
               </div>
               <a href="/admin/user/1" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>
        

         <div class="col-lg-3 col-xs-6">
            <div class="small-box db_card">
               <div class="inner">
                  <h3>{{$Revenue}}</h3>
                  <p>Payouts</p>
               </div>
               <div class="icon">
                  <i class="ion ion-stats-bars"></i>
               </div>
               <a href="/admin/report/payouts" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>
         
         <div class="col-lg-3 col-xs-6">
            <div class="small-box db_card">
               <div class="inner">
                  <h3>Payments</h3>
                  <p>{{$payment_received}}</p>
               </div>
               <div class="icon">
                  <i class="ion ion-stats-bars"></i>
               </div>
               <a href="/admin/report/payments" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>

        
         
         <div class="col-lg-3 col-xs-6">
            <div class="small-box db_card">
               <div class="inner">
                  <h3>{{$Revenue}}</h3>
                  <p>Unpaid User Payment</p>
               </div>
               <div class="icon">
                  <i class="ion ion-stats-bars"></i>
               </div>
               <a href="/admin/user-payment" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>

       

         

         
         
         
      </div>
      <!-- /.row 1 - small boxes-->
   </section>
   <!-- right col -->
</div>
@endsection