@extends('layouts.admin')
@section('title','Auto Pool Clubs')
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
                  <th>#</th>
                  <th>Club Name</th>
                  <th>Active</th>
                  <th>Achieved</th>
                </tr>
                </thead>
                <tbody>
                @foreach($clubs as $key=>$value )
                <tr>
                  <td>{{$key+1}}</td>
                  <td>Auto Pool - {{$value->name}}</td>
                  <td>
                    @if(count($value->activeMember))
                    <a href="/admin/achiever/auto-pool/details/{{$value->id}}/1" class="btn btn-xs btn-info">View {{count($value->activeMember)}}</a>
                    @else
                    <a class="badge badge-success">0</a>
                    @endif
                  </td>
                  <td>
                    @if(count($value->achievedMember))
                    <a href="/admin/achiever/auto-pool/details/{{$value->id}}/0" class="btn btn-xs btn-info">View      {{count($value->achievedMember)}}</a>
                   @else
                    0
                    @endif
                  </td>
                  
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
