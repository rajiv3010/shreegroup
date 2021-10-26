@extends('layouts.admin')
@section('title','Pin Status')
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
          <!-- /.box-header -->
			@if(Session::has('message'))
			<div class="alert alert-success">
					<p>{{Session::get('message') }}</p>
			</div>
			@endif
      <div class="box-body" >
      <table id="example1" class="table table-responsive table-bordered table-striped">
              <thead>
                  <tr>
                  <th>#</th>
                  <th>User Name</th>
                  <th>User ID</th>
                  <th>Pin</th>
                  <th>Created Date</th>
                  </tr>
              </thead>
              <tbody>
                  @php $i = 1 @endphp
                  @foreach($pinsStatus as $pin)
                      <tr>
                      <td>{{$i}}</td>
                      <td>{{$pin->assignUser->name}}</td>
                      <td>{{$pin->assignUser->user_key}}</td>
                      <td> {{$pin->pin->pin_number}}</td>
                      <td>{{$pin->pin}}</td>
                      </tr>
                  @php $i++ @endphp
                  @endforeach
              </tbody>
              </table>
          </div>
          
          </div>
        </section>
      </div>

  <!-- /.box-body -->
  @endsection