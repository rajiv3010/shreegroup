@extends('layouts.app')
@section('title','Dashboard')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Size
  <small></small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Dashboard</li>
  </ol>
</section>
  <!-- Main content -->
  <section class="content">
      <!-- /.row 1 - small boxes -->
    
          
        <!-- form -->
         <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form"  action="/admin/content-manager/gallery/video" class="form-horizontal" method="post"  enctype="multipart/form-data" >
              {{ csrf_field() }}
              <div class="box-body">
             

               
                <div class="form-group col-md-6">
                  <label  class="control-label">Name</label>
                  <input type="text" class="form-control" name="name"  placeholder="Video Name">
                </div>
                
                <div class="form-group col-md-6">
                  <label  class="control-label">Video</label>
                  <input type="file" class="form-control" name="logo">
                </div>

                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        <!-- form -->
        <div class="box">
          <div class="box-body table-responsive" >
          <table id="example1" class="table table-responsive table-bordered table-striped">
              <thead>
                  <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Video</th>
                  <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @php $i=1; @endphp
                @foreach($videos as $video)
               <tr>
               	<td>{{$video->id}}</td>
               	<td>{{$video->name}}</td>
               	<td><img src="{{env('base_url')}}videos/{{$video->video}}" height="50px" width="50px"></td>
               	<td><a href="#">Remove</a> | <a href="#">Edit</a></td>
               </tr>
                    @php $i++; @endphp      
                @endforeach
                 
              </tbody>
             
           
              </table>
          </div>
       </div>
        
        </section>
      </div>

  <!-- /.box-body -->
  @endsection