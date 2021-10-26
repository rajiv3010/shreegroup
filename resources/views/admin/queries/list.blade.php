@extends('layouts.admin')
@section('title','Queries')
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
      <!-- Small boxes (Stat box) -->
      <div class="box">
         <div class="box-header">
         </div>
         @if(Session::has('message'))
         <div class="alert alert-success">
            <p>{{Session::get('message') }}</p>
         </div>
         @endif
         <div class="col-md-12">
         <a href="/admin/queries/0" class="btn btn-warning">Unread Queries</a>
         <a href="/admin/queries/1" class="btn btn-success">Read Queries</a>
         </div>
         <!-- /.box-header -->
         <div class="box-body table-responsive" >
         <table id="example1" class="table table-responsive table-bordered table-striped">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>Message</th>
                  <th>Status</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @php $i=1; @endphp
               @foreach($WebMessage as $value)
               <tr>
                  <td>{{$i}}</td>
                  <td>{{$value->name}}</td>
                  <td>{{$value->email}}</td>
                  <td>{{$value->phone}}</td>
                  <td>{{$value->message}}</td>
                  <td>@if($value->status == 0)
                     <span class="label label-warning">Pending</span>
                     @else
                     <span class="label label-success">Read</span>
                     @endif
                  </td>
                  <td> @if($value->status) 
                     <a href="/admin/queries/status/{{$value->id}}/0" class="btn btn-xs btn-warning">Mark Unread</a> @else <a href="/admin/queries/status/{{$value->id}}/1" class="btn btn-xs btn-success">Mark Read</a> 
                  @endif
                     <a href="/admin/queries/delete/{{$value->id}}" class="btn btn-xs btn-danger">Delete</a> 
               </td> 
               </tr>
               @php $i++; @endphp      
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