@extends('layouts.admin')
@section('title',$status_name.' users of '.$users[0]->AutoPoolClub->name)
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


<div class="box">
            <div class="box-header">
              <a href="/admin/achiever/auto-pool" class="btn btn-xs btn-success"><i class="fa fa-backward"></i> Back</a>
              
            </div>
             @if(Session::has('message'))
            <div class="alert alert-success">
            <p>{{Session::get('message') }}</p>
            </div>
            @endif
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>User ID</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $key=>$value )
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$value->Users->user_key}}</td>
                  <td>{{$value->Users->name}}</td>
                  <td><a href="/admin/achiever/auto-pool/payout/{{$value->AutoPoolClub->business_area_id}}" class="btn btn-xs btn-info">Details</a></td>
                  
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
