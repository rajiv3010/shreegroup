@extends('layouts.admin')
@section('title','Team Edit')
@section('content')     <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
            Teams
        </h1>
        <ol class="breadcrumb">
          <li><a href="/magma/home"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Teams</li>
        </ol>
      </section>
 <!-- Main content -->
    <section class="content">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

 {{ Form::model($team, array('route' => array('teams.update', $team->id), 'method' => 'PUT')) }}
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Select2</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <label>Name</label>
                <input name="name" type="text" class="form-control" id="name" value="{{$team->name}}">
                </div>
              </div> 
              <div class="col-md-6">

                <div class="form-group">
                <label>Roles</label>
                  <select class="form-control" multiple="multiple" data-placeholder="Select a State" style="width: 100%;"  name="roles[]">
                  @php $role_ids =[]@endphp
                  @foreach($rolesUser as $userHas) 
                  <?php  $role_ids[]= $userHas->role_id ;?>
                  @endforeach 
                  @foreach($roles as $role)
                  <option  @if (in_array($role->id, $role_ids)) selected  @else @endif  value="{{$role->id}}">{{$role->name}}</option>
                  @endforeach

                  </select>
                </div>
              </div>
            
              <!-- /.row -->
            </div> 
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                <label>Email</label>
                <input name="email" type="email" class="form-control" id="email" value="{{$team->email}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="control-group">
                  <label class="control-label">Password :</label>
                  <div class="controls">
                  <input type="Password" name="password"  class="form-control" value="" />
                  </div>
                </div>
              </div>
            </div> 
              {{ Form::submit('Edit the team!', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}     
        </div>
      </div>
      <!-- /.box -->

     
      <!-- /.row -->

    </section>
    <!-- /.content -->
      <!-- Main content -->
      <section class="content">
    
       
   <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Teams list</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table">
                <tr>
                    <th>ID</th>
                    <th>No</th>
                    <th>Name</th>
                    <th>Display Name</th>
                </tr>
                @php $i =1 @endphp
                                @foreach ($roles as $key => $role)

                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $role->code }}</td>
                                        <td>{{ $role->name }}</td>                                      
                                    </tr>
                                @php $i++ @endphp
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
