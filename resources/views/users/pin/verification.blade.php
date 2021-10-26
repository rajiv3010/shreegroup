@extends('layouts.user')
@section('title','Verification')
@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Verification
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
   
    <!-- Main content -->
    <section class="content">
     @if(Session::has('message'))
    <div class="alert alert-danger">
        <p>{{Session::get('message') }}</p>
    </div>
    @endif
            <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Pin Verification   {{session::get('pinAuthenticate')}}</h3>
            </div>
            <!-- /.box-header -->
          <div class="box-body">
          {!! Form::open(['url' => '/pin','enctype'=>'multipart/form-data']) !!}
            <div class="row">
                <div class="form-group col-lg-6">
                  <label>Password</label>
                   <input type="text" name="password"  class="form-control" placeholder="Enter Pin Verification password">
                  </select>
                </div>
              </div>
            
                <div class="row" align="center">
                <div class="col-lg-3"><button type="submit" class="btn btn-block btn-success">Verify</button></div>
              </div>
      {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
          </div>














  </section>
        <!-- right col -->
      </div>
  @endsection