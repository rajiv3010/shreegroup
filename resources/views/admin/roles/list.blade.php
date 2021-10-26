@extends('layouts.admin')
@section('title','Team list')
@section('content')
     <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
            Teams
        </h1>
        <ol class="breadcrumb">
          <li><a href="/admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Teams</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
    
       @if(Session::has('message'))
        <div class="alert alert-success alert-block"><a class="close" data-dismiss="alert" href="#">×</a>
          <h4 class="alert-heading">Done!</h4>
          {{Session::get('message') }}
        </div>
        @endif
   <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Teams list</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <div class="input-group-btn">
                    <a href="/admin/teams/create" class="btn btn-default">Add</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Roles</th>
                </tr>
                @php $i=1; @endphp
                @foreach($teams as $team)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$team->name}}</td>
                        <td>{{$team->user_key}}</td>
                        <td>{{$team->email}}</td>
                        <td>
                          <ul class="select2-selection__rendered">
                        @foreach($team->hasRoles as $userRoles)
                         <li> {{$userRoles->name}}</li>
                        @endforeach
                        </ul>
                        </td>
                        <td> 
                          @if(havePermission::check(Auth::guard('admin')->user()->id, "role-edit")) 
                       <a class="btn btn-primary"  href="{{ route('teams.edit',$team->id) }}">Edit</a>
                          @endif
                        </td>
                    </tr>
                @php $i++; @endphp      
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

       
      </section>
      <!-- /.content -->
    </div>
    <!-- /page content -->
  @endsection  
