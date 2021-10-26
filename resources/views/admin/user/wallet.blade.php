@extends('layouts.admin')
@section('title','Wallet')
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
          <div class="box">
              <div class="box-header">
              </div>
              @if ($errors->any())
              <div class="alert alert-danger">
              <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
              </ul>
              </div>
              @endif
              <!-- /.box-header -->
              @if(Session::has('message'))
              <div class="alert alert-success">
              <p>{{Session::get('message') }}</p>
              </div>
              @endif
              <form action="/admin/user/update-wallet" method="POST" class="assignPinForm">
                  {{csrf_field() }}
                  <div class="box-body table-responsive" >
                      <div class="form-group col-md-3">
                          <label>User Key</label>
                          <input readonly="readonly" value="{{$user->user_key}}" class="form-control assignPinUser" name="user_key" id="assinPinAdminToUser">
                      </div>

                       <div class="form-group col-md-3">
                          <label>Add Amount</label>
                          <input class="form-control " name="add_amount" >
                      </div>

                       <div class="form-group col-md-3">
                          <label>Current Wallet</label>
                          <input readonly="readonly" disabled="disabled" class="form-control" value="{{$user->wallet}}">
                      </div>

                      <div class="row">
                        <a href="#" data-placement="bottom" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover" class="showUserDetails">
                          <i class="fa fa-info-circle" aria-hidden="true"></i>
                        </a>
                      </div>
                      <div class="row">
                        <div class="userDetailsDiv" > </div> <br>
                          <div class="col-lg-3"><button type="submit" class="btn btn-block btn-success">Add Amount</button></div>
                          <div class="col-lg-3"><button type="button" class="btn btn-block btn-danger">Reset</button></div>
                      </div>
                      
                  </div>
              </form>


          </div>
           <div class="box-body">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  
                  <th>User Key</th>
                  <th>Old Wallet</th>
                  <th>Add Amount</th>
                  <th>New Wallet</th>
                  <th>Created By name</th>
                  <th>Created By Type</th>
                  <th>Created date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($walletLogs as $walletLog )
                <tr>
                  <td>1</td>

                  <td>{{$walletLog->user_key}}</td>

                  <td>{{$walletLog->old_wallet}}</td>
                  <td>{{$walletLog->add_amount}}</td>
                  <td>{{$walletLog->new_wallet}}</td>
                  <td>{{$walletLog->admin->name}}</td>
                  <td>{{$walletLog->user_type}}</td>
                  <td>{{$user->created_at}}</td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
        </section>
</div>

<!-- /.box-body -->
@endsection
