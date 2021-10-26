@extends('layouts.admin')
@section('title','Team Add')
@section('content')     <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Teams
      </h1>
      <ol class="breadcrumb">
         <li><a href="/magma/home"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Teams</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      @if (count($errors) > 0)
      <div class="alert alert-danger">
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif
      <div class="box box-default">
         <div class="box-header with-border">
            <h3 class="box-title">Add Team</h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
               <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            <form role="form"  action="/admin/roles/AddUser"  method="post"  enctype="multipart/form-data" >
               {{ csrf_field() }}
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Name</label>
                        <input name="name" type="text" class="form-control" id="name" value="">
                     </div>
                  </div>
                  <!--  <div class="col-md-6">
                     <div class="form-group">
                        <label>Roles</label>
                        <select class="form-control" data-placeholder="Select Role" style="width: 100%;"  name="admin_type_id">
                           @foreach($adminType as $value)
                           <option  value="{{$value->id}}">{{$value->role_name}}</option>
                           @endforeach
                        </select>
                     </div>
                     </div> -->
                  <!-- /.row -->
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="email" class="form-control" id="email" value="">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Mobile</label>
                        <input name="mobile" type="number" class="form-control" id="mobile" value="">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="control-group">
                        <label class="control-label">Password :</label>
                        <div class="controls">
                           <input type="Password" name="password"  class="form-control" value="" />
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <div class="box-footer">
                           <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <!-- /.box -->
      <!-- /.row -->
   </section>
   <!-- /.content -->
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <div class="col-xs-12">
            <div class="box">
               <div class="box-header">
                  <h3 class="box-title">Teams list</h3>
                  <div class="box-tools">
                     <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                        <div class="input-group-btn">
                           <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- /.box-header -->
               <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                     <tr>
                        <th>ID</th>
                        <th>Name</th>
                     </tr>
                     @foreach ($users as $key => $value)
                     <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $value->name }}</td>
                        <td><a class="btn btn-info btn-sm AssignManualRole" href="#" data-toggle="modal" data-target="#AssignRole" data-user-key="{{$value->id}}" >Assign Role</a></td>
                     </tr>
                     @endforeach
                  </table>
               </div>
               <!-- /.box-body -->
            </div>
            <!-- /.box -->
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>
<!-- /page content -->
<!-- Modal Manual Permission -->
<div id="AssignRole" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Assign Role</h4>
         </div>
         <div class="modal-body">
            <form role="form"  action="/admin/roles/assign" class="form-horizontal" method="post"  enctype="multipart/form-data" >
               {{ csrf_field() }}
               <input type="text" name="user_id" id="user_id" readonly="readonly">
               <table class="table">
                  <thead>
                     <tr>
                        <th scope="col">Select</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($roles as $roleValue)
                     <tr>
                        <td>
                           <input type='checkbox' name="role_id[]" class='form-check-input' value="{{$roleValue->id }}"
                           @if(old($roleValue->{'role_id'},$roleValue->id)=="true") checked @endif>
                        </td>
                        <td> {{$roleValue->name }}</td>
                        @endforeach
                     </tr>
                  </tbody>
               </table>
               <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-success">Assign Role</button>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
@endsection