@extends('layouts.admin')
@section('title','ROI Users')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>

         <!-- /admin/user/ROI-user-list-save -->
         @yield('title') <a href="#" target="_blank" class="btn btn-success">Pay - ye auto rahega har month 19 date ko 19:19:19</a>
      </h1>
      <ol class="breadcrumb">
         <li><a href="/admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">@yield('title') </li>
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
         <!-- /.box-header -->
         <div class="box-body table-responsive" >
            <table id="example1" class="table table-responsive table-bordered table-striped">
              <thead>
                                 <tr role="row">
                                    <th>#</th>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Name</th>
                                    <th>Package Name</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                 </tr>
                              </thead>
                              <tbody>
                                @foreach($packages as $key=>$value)
                                 @foreach($value->genUsers as $key=>$user)
                                    
                                 
                                <tr>
                                   <td>{{$key+1}}</td>
                                   <td>{{$user->user_key}} </td>
                                   <td>{{$user->user_name}} </td>
                                   <td>{{$user->user->name}}</td>
                                   <td>{{$value->package_type->name}} -- {{$value->name}} / ₹{{$value->amount}}</td>
                                   <td><a href="/admin/user/ROI-user-list/details" class="btn btn-primary btn-xs">View Details</a></td>
                                  
                                   <td>{{$user->created_at}}</td>
                                </tr>
                              
                                
                                @endforeach
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