@extends('layouts.admin')
@section('title','Image Section')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         @yield('title')
         
   </section>
   <!-- Main content -->
   <section class="content">
      <!-- /.row 1 - small boxes -->
      <!-- form -->
      <div class="box box-primary">
         <!-- /.box-header -->
         <!-- form start -->
         <form role="form"  action="/admin/dashboard-images/submit" class="form-horizontal" method="post"  enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="box-body">

                           
               <div class="col-md-12">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Banner Image</label>
                     <input type="file" class="form-control" name="image" >
                  </div>
               </div>

              <!--  <div class="col-md-12">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Is Dashboard Banner</label>
                     <input type="checkbox" value="1" name="is_dashboard" >
                  </div>
               </div>

               <div class="col-md-12">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Is Gallery Image</label>
                     <input type="checkbox" value="0" name="is_dashboard" >
                  </div>
               </div>
 -->


               <div class="col-md-12">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Image Type</label>
                  </div>



               <div class="item form-group">
                  

                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <label>
                     <input type="radio"   name="is_dashboard" id="optionsRadios1" value="1"  checked="true" >
                     Dashboard
                     </label>
                     <label>
                     <input type="radio" name="is_dashboard" id="optionsRadios2" value="0">
                     Gallery
                     </label>
                  </div>
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
      <div class="box box-body box-success table-responsive" >
         <table id="example" class="table table-responsive table-bordered table-striped table-hover">
            <thead>
                  <tr>
                      <th>#</th>
                      <th>Image</th>
                      <th>Placement</th>
                      <th>Action</th>
                      <th>Status</th>
                  </tr>
              </thead>
            <tbody>
               @php $i=1; @endphp
               @foreach($bannerImage as $value)
                  <tr>
                      <th scope="row">{{$loop->index+1}}</th>
                      <td><img width='60' src="{{env('base_url')}}dashboard_image/{{$value->image}}" ></td>
                      <td>@if($value->is_dashboard == 1)
                        <span class="label label-primary">Dashboard</span>
                        @else
                        <span class="label label-warning">Gallery</span>
                        
                        @endif
                      </td>
                      <td>
                        <a href="/admin/dashboard-images/delete/{{$value->id}}"><i class="fa fa-trash"></i></a>
                     </td>
                     <td>
                          @if($value->status == 1)
                          <a href="/admin/dashboard-images/status/{{$value->id}}/0">Current Status <span class="bg-green">Live</span> Click to <span class="bg-red">Draft</span></a>
                          @else
                          <a href="/admin/dashboard-images/status/{{$value->id}}/1">Current Status <span class="bg-red">Draft</span> Click to <span class="bg-green">Live</span></a>
                          @endif
                          
                       </td>
                      
                  </tr>
               @php $i++; @endphp      
               @endforeach
            </tbody>
         </table>
      </div>
   </section>
   <!-- list start -->
</div>
<!-- /.box-body -->




@endsection