@extends('layouts.admin')
@section('title','Binary Status')
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
          <a href="/admin/Binary Status/add" class="small-box-footer">
            <span class="pull-left-container">
                  <small class="label pull-left bg-green"><i class="fa fa-plus"></i> new</small>
            </span>
            </a>
          <a href="/admin/Binary Status/asign" class="small-box-footer">
            <span class="pull-right-container">
                  <small class="label pull-right bg-blue"><i class="fa fa-plus"></i> Asign Point</small>
            </span>
            </a>
          </div>
          <!-- /.box-header -->
			@if(Session::has('message'))
			<div class="alert alert-success">
					<p>{{Session::get('message') }}</p>
			</div>
			@endif
      <div class="box-body table-responsive" >
      <table id="example" class="display" cellspacing="0" width="100%">
              <thead>
                  <tr>
                  <th>Date</th>
                  <th>LL Count</th>
                  <th>LPV</th>
                  <th>RL Count</th>
                  <th>LPV Count</th>
                  <th>RPV Count</th>
                  <th>Balance PV</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($lefts as $key => $left)
                      <tr>
                      <td>{{$key}}</td>
                      @foreach($left as $l)
                          @if(isset($l->L_count))
                       <td>{{$l->L_count}} </td>
                       <td>{{$l->lpv}} </td>
                       @else
                       <td>0</td>
                       <td>0</td>
                       @endif

                       @if(isset($l->r_count))
                       <td>{{$l->r_count}}
                       </td>
                       <td>   {{$l->rpv}}
                       </td>
                       @else
                       <td>0</td>
                       <td>0</td>
                       @endif
                      @endforeach
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