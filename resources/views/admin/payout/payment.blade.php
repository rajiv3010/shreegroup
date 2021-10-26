@extends('layouts.admin')
@section('title','Payment')
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
        
          <!-- /.box-header -->
          <div class="box-body table-responsive" >
          <table id="example1" class="table table-responsive table-bordered table-striped">
              <thead>
                  <tr>
                  <th>#</th>
                  <th>Payment Type</th>
                  <th>Payee IFSC Code</th>
                  <th>Debit Account Number</th>
                  <th>Receiver IFSC Code</th>
                  <th>Beneficiary Account Number</th>
                  <th>Transaction Currency </th>
                  <th>Transaction Amount</th>
                  <th>Transaction Remarks </th>
                  <th>Beneficiary Customer Name</th>
                  <th>User Email Id </th>
                  <th>User Mobile Number</th>
                  
                  </tr>
              </thead>
              <tbody>
             
               	<tr>
                  <td>1</td>
                  <td>NEFT</td>
                  <td>SBIN0011779</td>
                  <td>30334225762</td>
                  <td>SBIN0011045</td>
                  <td>30585128089</td>
                  <td>INR</td>
                  <td>14152.5</td>
                  <td>Weekly Payout</td>
                  <td>Rajiv Mishra</td>
                  <td>rajiv_mishra32@yahoo.com</td>
                  <td>9425440005</td>
                  
              	</tr>

              </tbody>
             
             
              </table>
          </div>
          
          </div>
        </section>
      </div>

  <!-- /.box-body -->
  @endsection