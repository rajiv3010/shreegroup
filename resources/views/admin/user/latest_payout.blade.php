@extends('layouts.admin')
@section('title','Latest Payouts')
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
             @if(Session::has('message'))
            <div class="alert alert-success">
            <p>{{Session::get('message') }}</p>
            </div>
            @endif
            <!-- /.box-header -->
            <div class="row">
              <div class="col-lg-6">  
                  <div class="box-body">
              <table  class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>View</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user )
                <tr>
                  <td>1</td>
                  <td>{{$user->user_key}}</td>
                  <td><a href="/admin/user/businessActivityPayout/{{$user->user_key}}">View</a></td>
                  <td>{{$user->created_at}}</td>
                  <td>{{$user->updated_at}}</td>
                </tr>
                @endforeach
                </tbody>
              </table>
                  </div>
              </div>
              
            </div>
            <!-- /.box-body -->
          </div>

          </section>
        <!-- right col -->
      </div>
  @endsection
