@extends('layouts.user')
@section('title','Pin')
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
       @if(Session::has('message'))
            <div class="alert alert-success">
            <p>{!!Session::get('message') !!}</p>
            </div>
            @endif
    <section class="content-header">
      <h1>
        Pin Module
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pin</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->


      <!-- /.row 1 - small boxes -->
      <div class="row">

          <div class="col-lg-3 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-red">
           
            <a href="/pin/list" class="small-box-footer">View Pins <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

          <div class="col-lg-3 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-blue">
            
          
            <a href="/pin/assign" class="small-box-footer">Recieved pins List <i class="fa fa-arrow-circle-right"></i></a>
          </div>
          </div>
        


          <!-- <div class="col-lg-2 col-xs-4">
          <div class="small-box bg-blue">
            <div class="inner">
              <h3  style="font-size: 12px;">Pin Status</h3>

              <p>Report</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="/classified" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div> -->



       
     


      </div>
      <!-- /.row 1 - small boxes-->
        
      

        </section>
        <!-- right col -->
      </div>
  @endsection