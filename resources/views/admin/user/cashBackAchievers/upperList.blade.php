@extends('layouts.admin')
@section('title','Cash Back Users - Upper List')
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
         <li class="active">@yield('title') </li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="box">
        
        
         <!-- /.box-header -->
         <div class="box-body" >
            <table id="example1" class="table table-responsive table-bordered table-striped">
              <thead>
                                 <tr role="row">
                                    <th>#</th>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Package</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach($users as $key=>$value)
                                    
                                
                                <tr>
                                   <td>{{$key+1}}</td>
                                   <td>{{$value->user_key}}</td>
                                   <td>{{$value->name}}</td>
                                   <td>{{$value->package->package_type->name}}</td>
                        
                                  
                                 
                                </tr>
                              
                                
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






