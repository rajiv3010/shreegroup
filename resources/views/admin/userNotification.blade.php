@extends('layouts.admin')
@section('title','Notification')
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
      <!-- Small boxes (Stat box) -->

<div class="col-lg-5">
    <div class="box">
      <div class="box-header">
        
      </div>
       <form role="form" action="/admin/user/notifications-push" method="post">
                    {{csrf_field() }}
                    <div class="box-body">
                  <div class="form-group col-sm-12">
                    <label for="user_id" class="col-sm-3 control-label">User Id</label>

                    <div class="col-sm-9">
                      <input type="text" name="user_key"  class="form-control SearchMember" id="user_id" placeholder="Enter User Id Or if Broadcast enter all">
                    </div>
                  </div>
                  <div class="form-group col-sm-12">
                    <label for="user_id" class="col-sm-3 control-label">Type</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="type">
                          <option value="notice">Notice</option>
                          <option value="Alert">Alert</option>
                          <option value="Payment">Payment</option>
                          <option value="General">General </option>
                      </select>

                    </div>
                  </div>
                  <div class="form-group col-sm-12">
                    <label for="title" class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-9">
                      <input type="text" name="title"  class="form-control" id="title" placeholder="Enter Title">
                    </div>
                  </div>
                  <div class="form-group col-sm-12">
                    <label for="inputName" class="col-sm-3 control-label">Message</label>
                    <div class="col-sm-9">
                          <textarea class="form-control" name="message"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                      <button type="submit" class="btn btn-danger">Send</button>
                    </div>
                  </div>
                </div>
                </form>
    </div>
</div>
<div class="col-lg-7">
   <div class="box">
  <div class="box-header">

  </div>
  <!-- /.box-header -->
  <div class="box-body">
  <table id="example1" class="table table-bordered table-striped">
  <thead>
  <tr>
  <th>#</th>
  <th>User</th>
  <th>Message</th>
  <th>Created at</th>
  <th>Action</th>
  </tr>
  </thead>
  <tbody>
  @foreach( $notifications as $notification )
  <tr>
  <td>1</td>

  <td>
  @if($notification->user_key =='all')
  BroadCast
  @else
    @if(is_null($notification->user))
      Not a valid id ({{$notification->user_key}})
    @else
      {{$notification->user->name}} / {{$notification->user->user_key}}
    @endif
  @endif

  </td>
  <td>{{$notification->message}}</td>
  <td>{{$notification->created_at}}</td>                 
  <td><a href="/admin/user/notification/remove/{{$notification->id}}"> Remove </a></td>                 
  </tr>
  @endforeach
  </tbody>
  </table>
  </div>
  <!-- /.box-body -->
  </div>
</div>
 

          </section>
        <!-- right col -->
      </div>
  @endsection