@extends('layouts.admin')
@section('title',$club->name.' Achievers')
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
            <a href="{{ URL::previous() }}" class="btn btn-xs btn-success"><i class="fa fa-backward"></i> Back</a>
         </div>
          <!-- /.box-header -->
			@if(Session::has('message'))
			<div class="alert alert-success">
					<p>{{Session::get('message') }}</p>
			</div>
			@endif
            <div class="box-body dataRow">
                  
              <table id="example1" class="table table-bordered table-striped">
              <thead>
                  <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>ID</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($club->UserWinners($date) as $key=> $UserWinner)
                  <tr>
                    <td>{{$key}}</td>
                    <td>{{$UserWinner->user->name}}</td>
                    <td>{{$UserWinner->user_key}}</td>
                  </tr>
                  @endforeach

              
                  

                 
      
              </tbody>
              </table>
          </div>
          
          </div>
        </section>
      </div>

  <!-- /.box-body -->
  @endsection