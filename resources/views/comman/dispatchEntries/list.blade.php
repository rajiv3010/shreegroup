@extends('layouts.admin')
@section('title','DispatchEntries')
@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Dispatch Entries
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">DispatchEntries</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     @if(Session::has('message'))
            <div  class="alert alert-success">
            <p>{{Session::get('message') }}</p>
            </div>
            @endif

      <!-- Small boxes (Stat box) -->
       @if(Auth::guard('admin')->user()->id)
       
       
       <div class="box box-warning">
       <div class="box-body">
       
          {!! Form::open(['url' => '/admin/content-manager/dispatchStore','enctype'=>'multipart/form-data']) !!}
            <div class="row">
                <div class="form-group col-lg-3">
                  <label>User Key</label>
                  <input placeholder="Enter user sponser id" type="text" value="{{$user_key}}"  name="user_key" id="sponser_id" class="form-control" @if($user_key)  readonly="true" @endif required="required">    
                </div>
               
                <div class="form-group col-lg-3">
                  <label>Title</label>
                  <input placeholder="Enter your title" type="text" name="title" class="form-control" required="required">
                </div>
                <div class="form-group col-lg-3">
                  <label>Courier Company</label>
                  <input placeholder="Enter courier company name" type="text" name="courier_company" class="form-control" required="required">
                </div>
                <div class="form-group col-lg-3">
                  <label>Tracking URL</label>
                  <input placeholder="Enter your tracking url" type="text" name="url" class="form-control" required="required">
                </div>
                <div class="form-group col-lg-3">
                  <label>Tracking id</label>
                  <input placeholder="Enter your tracking id" type="text" name="tracking_id" class="form-control" required="required">
                </div>
                <div class="form-group col-lg-3">
                  <label>Dispatch date</label>
                  <input  type="date" name="dispatch_date" class="form-control" required="required">
                </div>
            </div>
                <div class="row" align="center">
                <div class="col-lg-3"><button type="submit" class="btn btn-block btn-success">Submit</button></div>
                 <span class="col-lg-3" id="sponser_name"></span>
                </div>
      {!! Form::close() !!}
            </div>
            </div>
       @else

       @endif
                
             

      <div class="box">
            <div class="box-header">
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>User Name</th>
                  <th>Title</th>
                  <th>Courier Company</th>
                  <th>Tracking URL</th>
                  <th>Tracking Number</th>
                  <th>Dispatch Date</th>
                  <th>Created at</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($DispatchEntries as $dispatchentry)
                  <tr>
                    <td>{{$dispatchentry->user->name}}</td>
                    <td>{{$dispatchentry->title}}</td>
                    <td>{{$dispatchentry->courier_company}}</td>
                    <td>{{$dispatchentry->url}}</td>
                    <td>{{$dispatchentry->tracking_id}}</td>
                    <td>{{ date('d ,M Y',strtotime($dispatchentry->dispatch_date))}}</td>
                    <td>{{ date('d ,M Y',strtotime($dispatchentry->created_at))}}</td>
                    <td> <a href="/admin/content-manager/dispatch-remove/{{$dispatchentry->id}}"> <i class="fa fa-trash"></i></a></td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

          </section>
        <!-- right col -->
      </div>
  @endsection