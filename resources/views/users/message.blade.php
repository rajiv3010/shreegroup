@extends('layouts.user')
@section('title','Dashboard')
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
        Message
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->


      <!-- /.row 1 - small boxes -->
            <!-- /.row 1 - small boxes-->
      


<!-- row 2 -->
      <div class="row" >
        <div class="col-md-12" align="center">
                @if(Session::has('message'))
                    <div  class="alert alert-success">
                    <p>{{Session::get('message') }}</p>
                    </div>
                    @endif
              @include('comman.email')
                <!-- quick support -->
        </div>

      </div>
      <!-- row -2 -->




        </section>
        <!-- right col -->
      </div>
  @endsection

