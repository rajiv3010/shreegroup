@extends('layouts.admin')
@section('title','Testimonials')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         @yield('title') <a href="/admin/testimonials/add" class="btn btn-success btn-xs">Add New</a>
      </h1>
      <ol class="breadcrumb">
         <li><a href="/admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">@yield('title')</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <!-- /.row 1 - small boxes -->
      <!-- list start -->
      <div class="box box-body box-success table-responsive" >
         <table id="example" class="table table-responsive table-bordered table-striped">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Designation</th>
                  <th>Message</th>
                  <th>Status</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @foreach($Testimonials as $key=>$value)
               <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$value->name}}</td>
                  <td>{{$value->designation}}</td>
                  <td>{{$value->message}}</td>
                  
                  <td>@if($value->status == 1)
                     <span class="label label-success">Published</span>
                     @else
                     <span class="label label-danger">Drafted</span>
                     @endif
                  </td>
                  
                  <td> @if($value->status) 
                     <a href="/admin/testimonials/status/{{$value->id}}/0" class="btn btn-xs btn-danger">Draft</a> @else <a href="/admin/testimonials/status/{{$value->id}}/1" class="btn btn-xs btn-success">Publish</a> @endif  <a href="/admin/testimonials/edit/{{$value->id}}" class="btn btn-xs btn-primary"> <i class="fa fa-edit"></i> Edit</a></td> 
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
      </section>
      <!-- list start -->
</div>

   
   <!-- /.box-body -->
@endsection