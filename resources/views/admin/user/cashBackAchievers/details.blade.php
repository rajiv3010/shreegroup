@extends('layouts.admin')
@section('title','ROI Users Details')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         @yield('title') -> data from roi_user_achievements
      </h1>
      <ol class="breadcrumb">
         <li><a href="/admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">@yield('title')  </li>
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
                                    <th>Package</th>
                                    <th>%</th>
                                    <th>Month</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                 </tr>
                              </thead>
                              <tbody>
                               <tr>
                                 <td>XXXX</td>
                                 <td>XXXX</td>
                                 <td>XXXX</td>
                                 <td>XXXX</td>
                                 <td>XXXX</td>
                                 <td>XXXX</td>
                                 <td>XXXX</td>
                                 <td>Status</td>
                                 <td>XXXX</td>
                              </tr>
                                    
                                 
                               
                              
                           
                              </tbody>
            </table>
         </div>
         <!-- /.box-body -->
      </div>
   </section>
   <!-- right col -->
</div>
@endsection