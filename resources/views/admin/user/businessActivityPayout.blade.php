@extends('layouts.admin')
@section('title','Activity Payout')
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
                  <th>ID</th>
                  <th>Details</th>
                  <th>Name</th>
                  <th>Amount Collection</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                </tr>
                </thead>
                <tbody>
                @foreach($BusinessAreas as $areas )
                <tr>
                  <td>{{$areas->id}}</td>
                   <td> <a href="/admin/user/activity-payout/{{$user_key}}">Details</a> </td>

                  <td>{{$areas->area_name}}</td>
                  <td>{{$areas->PayoutAmount}}</td>
                  <td>{{$areas->created_at}}</td>
                  <td>{{$areas->updated_at}}</td>
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
