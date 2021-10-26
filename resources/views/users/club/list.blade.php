@extends('layouts.user')
@section('title','Club')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Club Income
  <small></small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Club</li>
  </ol>
</section>
  <!-- Main content -->
  <section class="content">
      <!-- /.row 1 - small boxes -->
      <div class="box">
        
          <!-- /.box-header -->
          <div class="box-body table-responsive" >
             <table id="" class="table table-responsive table-bordered table-striped">
              <thead>
                  <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Achieved Date</th>
                  <th>Earned</th>
                  <th>Due</th>
                  <th>Paid</th>
                  <th>Action</th>
                  </tr>
              </thead>
              <tbody>
               @foreach($clubs as $club)
                <tr>
                  <td>1</td>
                  <td>{{$club->name}}</td>
                  <td>@if(isset($club->haveClub->id)) Achieved  @else Yet to Achieve @endif</td>
                  <td>@if(isset($club->haveClub->id)) {{$club->haveClub->created_at}}  @else - @endif</td>
                  <td>@if(isset($club->haveClub->id)) {{$club->haveClub->earned}}  @else - @endif</td>
                  <td>@if(isset($club->haveClub->id)) {{$club->haveClub->due}}  @else {{$club->prize}} @endif</td>
                  <td>@if(isset($club->haveClub->id)) {{$club->haveClub->paid}}  @else - @endif</td>
                  <td><a href="/payout/club/details/{{$club->id}}">Details</a></td>
                </tr>
                @endforeach


                
              </tbody>
             
               <thead>
                  <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  </tr>
              </thead>
              </table>
          </div>
          
          </div>
        </section>
      </div>

  <!-- /.box-body -->
  @endsection