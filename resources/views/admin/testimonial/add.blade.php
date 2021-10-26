@extends('layouts.admin')
@section('title','Testimonial')
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
      <!-- /.row 1 - small boxes -->
      <!-- form -->
      <div class="box box-primary">
         <!-- /.box-header -->
         <!-- form start -->
         <form role="form"  action="/admin/testimonials/save" class="form-horizontal" method="post"  enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="box-body">
               <div class="col-md-6">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Name</label>
                     <input type="text" class="form-control" name="name"  placeholder="Name">
                  </div>
               </div>
            
               <div class="col-md-6">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Designation</label>
                     <input type="text" class="form-control" name="designation"  placeholder="Designation">
                  </div>
               </div>
           
               <div class="col-md-6">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Message</label>
                     <textarea class="form-control" name="message"></textarea>
                  </div>
               </div>

               <div class="col-md-6" style="display:none;">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Testimonial For</label>
                     <select name="placement" class="form-control">
                        <option value="1">Home Page</option>
                     </select>
                  </div>
               </div>
               

               
            </div>
            <div class="box-footer">
               <button type="submit" class="btn btn-primary">Add</button>
            </div>
            <!-- /.box-body -->
         </form>
      </div>
      <!-- form -->
     
</div>
<!-- /.box-body -->
@endsection