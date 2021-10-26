@extends('layouts.admin')
@section('title','Add Package Description')
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

         <a href="/admin/p/description" class="btn btn-info btn-sm" style="margin-bottom: 5px;">Back</a>
         <!-- /.box-header -->
         <!-- form start -->
         <form role="form"  action="/admin/p/description/store" class="form-horizontal" method="post"  enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="box-body">
               
               <div class="col-md-12" >
                  <div class="form-group col-md-12">
                     <label  class="control-label">Package Name</label>
                     <select class="form-control" name="package_id">
                        @foreach($package_names as $package_name)
                        <option value="{{$package_name->id}}">{{$package_name->name}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Description</label>
 <textarea name="editor1" id="editor1" rows="10" cols="80">
      <table class="table">
                          <thead>
                              <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Description</th>
                                <th>Qty</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>1</td>
                                <td>Holiday</td>
                                <td>3D/2N  - 3 date 3 destination</td>
                                <td>1</td>
                              </tr>
                              <tr>
                                <td>2</td>
                                <td>Movie voucher</td>
                                <td>Single / Couple</td>
                                <td>6/3</td>
                              </tr>
                              <tr>
                                <td>3</td>
                                <td>Food Voucher</td>
                                <td>Single / Couple</td>
                                <td>6/3</td>
                              </tr>
                              <tr>
                                <td>4</td>
                                <td>Health Checkup</td>
                                <td>64 Health Checkups</td>
                                <td>1</td>
                              </tr>
                              
                              
                              
                            </tbody>
                          </table>
    
 </textarea>
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
      <!-- list start -->
      
      </section>
      <!-- list start -->
</div>

   
   <!-- /.box-body -->
@endsection