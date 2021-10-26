@extends('layouts.admin')
@section('title','Bonus Club Achievers')
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
            <a href="/admin/achiever/bonus-club" class="btn btn-xs btn-success"><i class="fa fa-backward"></i> bonus Club</a>
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
                  <th>Date</th>
                  <th>Sales</th>
                  <th>Actual Amount</th>
                  <th>Amount Modified</th>
                  <th>Actual Turn Over (Sales X Actual Amount)</th>
                  <th>Manual Turn Over  (Sales X Amount Modified)</th>
                  <th>Achievers</th>
                  <th>Distributed</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($data as $key=> $value)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$value->date}}</td>
                    <td>{{$value->sell}}</td>
                    <td>{{$value->actual_amount}}</td>
                    <td>{{$value->modified_amount}}</td>
                    <td>{{$value->actual_amount*$value->sell}}</td>
                    <td>{{$value->modified_amount*$value->sell}}</td>
                    <td>{{$value->achievers}} <a href="/admin/achiever/bonus-club/details/{{$value->bonus_club_id}}" class="btn btn-xs btn-info">View</a></td>
                    <td>{{$value->distributed}}</td>
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