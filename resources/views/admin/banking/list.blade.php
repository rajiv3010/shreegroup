@extends('layouts.admin')
@section('title','Banking')
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
  @if(Session::has('message'))
            <div class="alert alert-success">
            <p>{{Session::get('message') }}</p>
            </div>
            @endif
  <!-- Main content -->
  <section class="content">
      <!-- /.row 1 - small boxes -->
        
      <div class="box">
			<div class="box-header">
            <a href="/admin/banking/create" class="btn btn-xs bg-red">Add</a>
         	 </div>


          <!-- /.box-header -->
          <div class="box-body table-responsive" >
          <table id="example1" class="table table-responsive table-bordered table-striped">
              <thead>
                  <tr>
                  <th>#</th>
                  <th>Company Name</th>
                  <th>Bank Name</th>
                  <th>Account Number</th>
                  <th>Branch Name</th>
                  <th>IFSC</th>
                  <th>Action</th>
                  
                  
                  </tr>
              </thead>
              <tbody>
                @php $i = 1 @endphp
             	@foreach($bankings as $banking)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$banking->company_name}}</td>
                  <td>{{$banking->bank_name}}</td>
                  <td>{{$banking->account_number}}</td>
                  <td>{{$banking->branch_name}}</td>
                  <td>{{$banking->ifsc}}</td>
                  <td>

                  	<a href="/admin/banking/{{$banking->id}}/edit"><i class="fa fa-edit"></i></a> | 

                  	
</td>
                  
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