@extends('layouts.admin')
@section('title','Generate PIN')
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Binary
        <small></small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="/admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">@yield('title')</li>
      </ol>
    </section>
   
    <!-- Main content -->
    <section class="content">

        <div class="panel-body">
 
    <br>
      <?php
          if($rightCount['pv'] > $leftCount['pv'])
          {
              $mypv =  $rightCount['pv']- $leftCount['pv'];
              $mypv = $mypv.' rightPV';
          }
          else
          {
              $mypv =  $leftCount['pv']-$rightCount['pv'];
              $mypv = $mypv.' LeftPV';
          }

       ?>   
       <p align="center">{{$mypv}}</p>
        <div class="row">
          <div class="col-lg-12">
                <div class="col-lg-6"> <div align="left"><h3> Left Count {{$leftCount['count']}}<br> PV:{{$leftCount['pv']}}</h3></div></div>
                <div class="col-lg-6"> <div align="right"><h3> Right Count {{$rightCount['count']}} <br> PV : {{$rightCount['pv']}}</h3></div></div>
          </div>
        </div>
 <div class="row">
          <div class="col-lg-12">
           <div class="tree">
           {!! $trees !!}
            </div>
        </div>
 </div>

        </div>
    </div>
     @endsection 
