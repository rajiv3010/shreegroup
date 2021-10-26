@extends('layouts.admin')
@section('title','User PAN')
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
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Sponser ID</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>PAN</th>
                  <th>City</th>
                  
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $users as $user )
                <tr>
                  <td>1</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->sponsor_key}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->mobile}}</td>
                  <td>{{$user->pan}}</td>
                  <td>{{$user->city}}</td>
               
                  <td>{{$user->created_at}}</td>
                  
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