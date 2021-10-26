@extends('layouts.admin')
@section('title','User Support')
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
  @if(Session::has('message'))
            <div class="alert alert-success">
            <p>{{Session::get('message') }}</p>
            </div>
            @endif
  <!-- Main content -->
  <section class="content">
      <!-- /.row 1 - small boxes -->
        
      <div class="box">
			<div class="box-header">
            <a href="/admin/support/0" class="btn btn-xs bg-red">Active</a>
            <a href="/admin/support/2" class="btn btn-xs bg-green">Solved</a>
         	 </div>


          <!-- /.box-header -->
          <div class="box-body table-responsive" >
          <table id="example1" class="table table-responsive table-bordered table-striped">
              <thead>
                  <tr>
                  <th>#</th>
                  <th>User ID</th>
                  <th>Issue</th>
                  <th>Message</th>
                  <th>Document</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                  
                  </tr>
              </thead>
              <tbody>
             	@foreach($user_support as $key=>$value)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$value->user_key}}</td>
                  <td>{{$value->supportType->name}}</td>
                  <td>{{$value->message}}</td>
                  <td><a href="{{env('base_url')}}documentation/support/{{$value->document}}" target="_blank">
                                       <img src="{{env('base_url')}}documentation/support/{{$value->document}}" width="70"></a>
                                     </td>

                                     <td>@if($value->status == 0)
                    
                    <span class="label label-danger">Open</span>
                    @else($value->status == 2)
                    <span class="label label-success">Fixed</span>
                    @endif
                  </td>
                  <td>@if($value->status == 0)
                    <a href="/admin/support/{{$value->id}}/2" class="btn btn-xs btn-success">Change to Fixed</a>
                    
                    @else($value->status == 2)
                    <a href="/admin/support/{{$value->id}}/0" class="btn btn-xs btn-danger">Change to Open</a>
                    @endif
                  </td>
                </tr>
                @endforeach

              </tbody>
             
             
              </table>
          </div>
            
       </div>
        </section>
      </div>

  <!-- /.box-body -->
  @endsection