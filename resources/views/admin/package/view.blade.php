@extends('layouts.admin')
@section('title','Packages List')
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
      <!-- list start -->
      <div class="box box-body box-success table-responsive" >
         <table id="example" class="table table-responsive table-bordered table-striped">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Package Type</th>
                  <th>Name</th>
                  <th>Amount</th>
                  <th>Instant ROI</th>
                  <th>Status</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @php $i=1; @endphp
               @foreach($packages as $package)
               <tr>
                  <td>{{$i}}</td>
                  <td>{{$package->package_type->name}}</td>
                  <td>{{$package->name}}</td>
                  <td>{{$package->amount}}</td>
                  <td>{{$package->direct_income}}</td>
                  <td>@if($package->status == 1)
                     <span class="label label-success">Live</span>
                     @else
                     <span class="label label-danger">Paused</span>
                     @endif
                  </td>
                  <td> @if($package->status) 
                     <a href="/admin/package/status/{{$package->id}}/0" class="btn btn-xs btn-danger">Draft</a> @else <a href="/admin/package/status/{{$package->id}}/1" class="btn btn-xs btn-success">Publish</a> @endif  <a href="/admin/package/edit/{{$package->id}}" class="btn btn-xs btn-primary"> <i class="fa fa-edit"></i> Edit</a></td> 
               </tr>
               @php $i++; @endphp      
               @endforeach
            </tbody>
         </table>
      </div>
      </section>
      <!-- list start -->
</div>

   
   <!-- /.box-body -->
@endsection