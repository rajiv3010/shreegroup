@extends('layouts.admin')
@section('title','Change Password')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         @yield('title')
         <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#binaryPercentage">
  Change Charges%
</button> 
<span class="label label-info">Current Binary %</span> -->
      </h1>
      <ol class="breadcrumb">
         <li><a href="/admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">@yield('title')</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="box box-primary">
         <form role="form"  action="/admin/update-password" class="form-horizontal" method="post"  enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="box-body">
               <!-- <div class="col-md-6">
                  <div class="form-group col-md-12">
                    <label  class="control-label">Old Password</label>
                     <input type="text" class="form-control" required="required" name="password"  placeholder="Old Password">
                  </div>
               </div> -->
               <div class="col-md-6">
                  <div class="form-group col-md-12">
                    <label  class="control-label">Create New Password</label>
                     <input type="password" class="form-control" required="required" name="npassword"  placeholder="New Password">
                  </div>
               </div>
            </div>
            <div class="box-footer">
               <button type="submit" class="btn btn-primary">Update</button>
            </div>
         </form>
      </div>
   </section>


   <section class="content">
      <div class="box box-primary">
         <form role="form"  action="/admin/update-transaction-password" class="form-horizontal" method="post"  enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="box-body">
               <div class="col-md-6">
                  <div class="form-group col-md-12">
                    <label  class="control-label">Old TXN Password</label>
                     <input type="password" class="form-control" required="required" name="password"  placeholder="Old Password">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group col-md-12">
                    <label  class="control-label">Create New TXN Password</label>
                     <input type="password" class="form-control" required="required" name="system_password"  placeholder="New Password">
                  </div>
               </div>
            </div>
            <div class="box-footer">
               <button type="submit" class="btn btn-primary">Update</button>
            </div>
         </form>
      </div>
   </section>




   

   

   
</div>
<!-- /.box-body -->


@endsection