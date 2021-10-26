@extends('layouts.admin')
@section('title','Payment History')
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
          <div class="box-body table-responsive" >
          <table  class="table table-responsive table-bordered table-striped">
              <thead>
                  <tr>
                  <th>#</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                @php $i = 1;$total=0 @endphp
              @foreach($data as $value)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$value->amount}}</td>
                  <td>{{$value->created_at}}</td>
                    <td>
                        <a class="btn btn-success" href="/admin/payment-release-history-data/{{$value->created_at}}">View Details</button>
                  </td>
                </tr>
                @php $i++; $total += $value->amount @endphp
                @endforeach
              </tbody>
              <thead>
                  <tr>
                  <th>&nbsp;&nbsp;</th>
                  <th>{{$total}}</th>
                  <th>&nbsp;&nbsp;</th>
                  <th>&nbsp;&nbsp;</th>
              
                  
                  </tr>
              </thead>
             
             
              </table>
          </div>
          
          </div>
        </section>
      </div>

  <!-- /.box-body -->
  @endsection