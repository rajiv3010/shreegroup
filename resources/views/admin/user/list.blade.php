@extends('layouts.admin')
@section('title','Users')
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
      <div class="box box-success">
        
         <div class="row">
            <div class="container box-body table-responsive">

               <div class="col-lg-3">
                <div class="col-lg-3">
                        <label>Packages</label>
                     </div>
                  <select class="form-control" name="package_id" id="package_id" onchange="window.location.href = '/admin/user?package_id='+this.value">
                     <option>Select Package</option>
                     @foreach($packages as $package)
                     <option value="{{$package->id}}">{{$package->name}}</option>
                     @endforeach
                  </select>
               </div>
                  <form  method="GET">
               <div class="col-lg-5">
                     <div class="col-lg-6">
                     <div class="col-lg-3">
                        <label>Start</label>
                     </div>
                     <div class="col-lg-9 input-group">
                           <input type="date" class="form-control" name="start"> <span class="input-group-btn">
                           </span>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="col-lg-3">
                        <label>End</label>
                     </div>
                     <div class="col-lg-9 input-group" style="margin-top: 5px;">
                           <input type="date" class="form-control" name="end"> <span class="input-group-btn">
                           </span>
                     </div>
                  </div>
                  <!-- <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                        </button> -->
                 
               </div>


               <div class="col-lg-2">
                     <div class="input-group">
                  <div class="col-lg-12">
                        <label>User Key</label>
                     </div>
                        <input type="text" class="form-control" name="user_key" placeholder="Search users by user id OR mobile number"> <span class="input-group-btn">
                        </span>
                     </div>
               </div>
               <div class="col-lg-2">
                <div class="col-lg-12">
                        <label>Search</label>
                     </div>
                        <button type="submit" class="btn btn-default"> Search 
                        <span class="glyphicon glyphicon-search"></span>
                        </button>
                      </div>
                  </form>

               
               
            </div>
         </div>
         <!-- /.box-header -->
         <div class="box-body table-responsive" >
            <table id="example1" class="table table-responsive table-bordered table-striped">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>User ID / Name</th>
                     <th>Member Name</th>
                     <th>Package</th>
                     <th>All Package</th>
                     <th>Sponser ID</th>
                     <th>Placement ID</th>
                     <th>Password</th>
                     <th>Mobile</th>
                     <th>Date of Joining</th>
                     <th>Date of Activation</th>
                     <th>Date</th>
                     <th>Action</th>
                     <th>Login</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($users as $key=>$value)
                  @if($value->banned)
                  <tr>
                     @else
                  <tr class="bg-red">
                     @endif
                     <td>{{$key+1}}</td>
                     <td>{{$value->user_key}} / {{$value->user_name}}</td>
                     <td>{{$value->name}}</td>
                     <td>
                        <span class="badge badge-info">Current Package - @if($value->package_id)

                        {{$value->package->name}}
                        @else
                        NA
                        @endif
                        </span>

                     
                     </td>
                     <td><a href="/admin/user/all-package/{{$value->user_key}}" class="btn-xs btn btn-primary">All Package List</a></td>
                     <td>{{$value->sponsor_key}}</td>
                     <td>{{$value->parent_key}}</td>
                     <td>{{$value->admin_password}}</td>
                     <td>{{$value->mobile}}</td>
                    
 
                     <td>{{ date('d-m-Y',strtotime($value->created_at))}}</td>
                     <td>@if($value->package_id >= 1)
                        {{ $value->created_at->addDays(5)->format('d-m-Y') }}</td>
                        @else
                        Activation pending
                        @endif
                    
                    
                     <td>

                        <select class="form-control" onchange="location = this.value;">
                           <option value="#">--- Select ---</option>
                           <option  value="/admin/user/edit/{{$value->id}}"> Edit Profile</option>
                              @if($value->banned)
                           <option value="/admin/user/banned/{{$value->id}}/0" class="bg-red"> Block User</option>
                              @else
                           <option value="/admin/user/banned/{{$value->id}}/1"> UnBlock User</option>
                              @endif
                        </select>
                        <a href="/admin/checkGroupWiseIncome/{{$value->user_key}}">Check </a>
                     </td>
                     <td>
                        <a href="/associate/doLogin/{{$value->user_key}}"  target="_blank" class="btn btn-xs btn-success">User Login</a>
                        </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
            {{$users->appends(['package_id' => $package_id ])->links()}}
         </div>
         <!-- /.box-body -->
      </div>
   </section>
   <!-- right col -->
</div>


<!-- Modal Manual Permission -->
<div id="ManualPermission" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Give permission for level Income</h4>
      </div>
      <div class="modal-body">
         <form role="form"  action="/admin/manualPermission" class="form-horizontal" method="post"  enctype="multipart/form-data" >
          {{ csrf_field() }}
          <input type="hidden" name="user_key" id="user_key" readonly="readonly">
  

       <div class="form-group">
    <label class="control-label col-sm-2" for="message">Permission:</label>
    <div class="col-sm-10">
      <select class="form-control" name="is_allowed_for_level_income">

         <option value="1">Yes</option>
         <option value="0">No</option>

      </select>
      
    </div>
  </div>
    
  <div class="form-group">
    <label class="control-label col-sm-2" for="message">Limit:</label>
    <div class="col-sm-10">
      <select class="form-control" name="allowed_limit">

         <option value="0">0</option>
         <option value="1">1</option>
         <option value="2">2</option>
         <option value="3">3</option>
         <option value="4">4</option>
         <option value="5">5</option>
         <option value="6">6</option>
         <option value="7">7</option>
         <option value="8">8</option>
         <option value="9">9</option>
         <option value="10">10</option>
         <option value="11">11</option>
         <option value="12">12</option>
         <option value="13">13</option>
         <option value="14">14</option>
         <option value="15">15</option>

      </select>
      
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="earning">Password:</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
    </div>
  </div>
 
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Give manual permission</button>
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