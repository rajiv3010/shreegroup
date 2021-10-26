@extends('layouts.user')
@section('title','Dashboard')
@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Payout
        <small>Report</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Payout</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->


      <!-- /.row 1 - small boxes -->
      <div class="row">
       @foreach($payouts as $payout)
         <div class="col-lg-2 col-xs-4">
          <!-- small box -->
          <div class="small-box {{$payout->businessarea->bg_color}}">
            <div class="inner">
              <h3 style="font-size: 12px;">{{$payout->businessarea->lable}}</h3>

          <i class="fa fa-inr"> </i>  {{$payout->total}}
            </div>
            
            <a href="/payout/{{$payout->businessarea->url}}" class="small-box-footer" style="font-size: 12px;">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        @endforeach
        <div class="col-lg-2 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3 style="font-size: 12px;">My Payout</h3>

              <p>Report</p>
            </div>
            
            <a href="/payout/all_payout" class="small-box-footer" style="font-size: 12px;">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-2 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3 style="font-size: 12px;">Passbook</h3>
              <p>Report</p>

              <p></p>
            </div>
            
            <a href="/payout/passbook" class="small-box-footer" style="font-size: 12px;">Details <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      


          </div>
          <!-- /.row 1 - small boxes-->

        </section>
        <!-- right col -->
      </div>
  @endsection