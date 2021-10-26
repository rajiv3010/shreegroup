@extends('layouts.user')
@section('title','Dashboard')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Ads Management
  <small></small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Dashboard</li>
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
                  <th>Achived Date</th>
                  <th>Member ID</th>
                  <th>Name</th>
                  <th>Tag</th>
                  <th>Mobile</th>
                  <th>Location</th>
                  <th>Package</th>
                  </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>14/10/2017</td>
                  <td>6500</td>
                  <td>6500</td>
                  <td>6500</td>
                  <td>6500</td>
                  <td>650</td>
                  <td>650</td>
                </tr>
      

              </tbody>
             
        
              </table>
          </div>
          
          </div>
        </section>
      </div>

  <!-- /.box-body -->
  @endsection