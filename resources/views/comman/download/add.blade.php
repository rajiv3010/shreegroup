@extends('layouts.admin')
@section('title','Downloads')
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
         <form role="form"  action="/admin/download/submit" class="form-horizontal" method="post"  enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box-body">


                <div class="col-md-12">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Title</label>
                     <input type="text" class="form-control" name="name" >
                  </div>
               </div>

                           
               <div class="col-md-12">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Document</label>
                     <input type="file" class="form-control" name="file" >
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
                      <th>Title</th>
                      <th>Image</th>
                      <th>Action</th>
                      <th>Status</th>
                  </tr>
              </thead>
            <tbody>
               @php $i=1; @endphp
               @foreach($bannerImage as $value)
                  <tr>
                      <th scope="row">{{$loop->index+1}}</th>
                      <td>{{$value->name}}</td>
                      <td><img width='60' src="{{env('base_url')}}downloads/{{$value->file}}" ></td>
                      
                      <td>
                        <a href="/admin/download/delete/{{$value->id}}"><i class="fa fa-trash"></i></a>
                     </td>
                     <td>
                          @if($value->status == 1)
                          <a href="/admin/download/status/{{$value->id}}/0">Current Status <span class="bg-green">Live</span> Click to <span class="bg-red">Draft</span></a>
                          @else
                          <a href="/admin/download/status/{{$value->id}}/1">Current Status <span class="bg-red">Draft</span> Click to <span class="bg-green">Live</span></a>
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