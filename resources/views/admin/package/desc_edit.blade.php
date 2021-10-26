@extends('layouts.admin')
@section('title','Edit Package Description')
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
      <div class="box box-body box-primary">
         <!-- /.box-header -->
          <a href="/admin/p/description" class="btn btn-info btn-sm" style="margin-bottom: 5px;">Back</a>
         <!-- form start -->
         <form role="form"  action="/admin/p/description/update" class="form-horizontal" method="post"  enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="box-body">


                <input type="hidden" class="form-control" name="id" value="{{$package_descs->id}}" >
               
               <div class="col-md-6" >
                  <div class="form-group col-md-12">
                     <label  class="control-label">Package Name</label>
                     <select class="form-control" name="package_id" required="required" >
                        @foreach($package_names as $package_name)
                        <option value="{{$package_name->id}}">{{$package_name->name}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Description</label>
<textarea name="description" id="editor1" rows="10" cols="80">{!!$package_descs->description!!}</textarea>

                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Quantity</label>
                     <input type="number" class="form-control" name="qty"  value="{{$package_descs->qty}}" placeholder="Quantity">
                  </div>
               </div>

                
               
            </div>
            <div class="box-footer">
               <button type="submit" class="btn btn-primary">Update</button>
            </div>
            <!-- /.box-body -->
         </form>
      </div>

      <!-- form -->
      <!-- list start -->
      
      </section>
      <!-- list start -->
</div>

   
   <!-- /.box-body -->
@endsection