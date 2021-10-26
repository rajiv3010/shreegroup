@extends('layouts.admin')
@section('title','Package')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         @yield('title')
         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#binaryPercentage">
  Change Charges%
</button> 

<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#LevelPercentage">
  Update Level %
</button>  -->
      </h1>
      <ol class="breadcrumb">
         <li><a href="/admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">@yield('title')</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <!-- /.row 1 - small boxes -->
      <!-- form -->
      <div class="box box-primary">
         <!-- /.box-header -->
         <!-- form start -->
         <form role="form"  action="/admin/package" class="form-horizontal" method="post"  enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="box-body">

               <div class="col-md-6" >
                  <div class="form-group col-md-12">
                     <label  class="control-label">Package Type</label>
                     <select class="form-control" name="package_type_id">
                        @foreach($PackageType as $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>


               <div class="col-md-6">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Package Name</label>
                     <input type="text" class="form-control" name="name"  placeholder="Package Name">
                  </div>
               </div>
               <div class="col-md-6" style="display: none;" >
                  <div class="form-group col-md-12">
                     <label  class="control-label">Business Area</label>
                     <select class="form-control" name="business_area_id">
                        @foreach($business_areas as $business_area)
                        <option value="{{$business_area->id}}">{{$business_area->area_name}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Package Amount</label>
                     <input type="text" class="form-control" name="amount"  placeholder="Amount">
                  </div>
               </div>
           
               <div class="col-md-6" style="display: none;">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Instant ROI (%)</label>
                     <input type="text" class="form-control" name="direct_income" value="5"  placeholder="Direct Income in %">
                  </div>
               </div>
              
               <!-- Level Select -->
               <div class="col-md-6">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Upto Level</label>
                     <input type="number" class="form-control" name="level_limit" max="20"  value="20" placeholder="Must be set according to package">
                  </div>
               </div>
               
           

               

               

               
            </div>
            <div class="box-footer">
               <button type="submit" class="btn btn-primary">Add</button>
            </div>
            <!-- /.box-body -->
         </form>
      </div>
      <!-- form -->
      <!-- list start -->
      <div class="box box-body box-success table-responsive" >
         <table id="example" class="table table-responsive table-bordered table-striped table-hover">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Package Type</th>
                  <th>Name</th>
                  <th>Amount</th>
                  <th>Level Limit</th>
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
                  <td>{{$package->level_limit}}
                    <a class=" btn btn-xs btn-success levelpercentagelimit"  data-limit-percentage="{{$package->level_limit}}" data-package-id="{{$package->id}}"  data-toggle="modal"  href="#">Change Level Distribution</a>
                  </td>

                  <td>@if($package->status == 1)
                     <span class="label label-success">Live</span>
                     @else
                     <span class="label label-danger">Paused</span>
                     @endif
                  </td>
                  <td> @if($package->status) 
                     <a href="/admin/package/status/{{$package->id}}/0" class="btn btn-xs btn-danger">Draft</a> @else <a href="/admin/package/status/{{$package->id}}/1" class="btn btn-xs btn-success">Publish</a> @endif  <a href="/admin/package/edit/{{$package->id}}" class="btn btn-xs btn-primary"> <i class="fa fa-edit"></i> Edit</a>
                  </td>
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



<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="binaryPercentage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Charges %</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form role="form"  action="/admin/charges/update" method="post"  enctype="multipart/form-data" >
         {{ csrf_field() }}
      <div class="modal-body">

           @foreach($charges as $value)
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Set {{$value->name}} %:</label>
            <input type="number" name="{{$value->id}}" class="form-control" id="recipient-name" value="{{$value->percentage}}">
          </div>
          @endforeach
          
         
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
        </form>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="LevelPercentage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Level %</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form role="form"  action="/admin/levelPercentage/update" method="post"  enctype="multipart/form-data" >
         {{ csrf_field() }}
      <div class="modal-body">

           @foreach($binaryLevel as $value)
          <div class="form-group">
            <div class="row">
            <div class="col-md-3">
            <label for="recipient-name" class="col-form-label">Level {{$value->level}} %:</label>
            </div>
            <div class="col-md-8">
            <input type="number" name="{{$value->id}}" class="form-control" id="recipient-name" value="{{$value->percentage}}">
            </div>
            </div>
          </div>
          @endforeach
          
         
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
        </form>
    </div>
  </div>
</div>



<!-- Level Limit -->
<div class="modal fade" id="LevelLimitPercentage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update %:</h4>
      </div>
      <div class="modal-body">
         <form role="form"  action="/admin/levelLimitPercentage/update"  class="form-horizontal" method="post"  enctype="multipart/form-data" >
          {{ csrf_field() }}
          <input type="hidden" name="levelLimit" id="levelLimit" readonly="readonly">
          <input type="hidden" name="packageID" id="packageID" readonly="readonly">
          <div class="level_list col-md-6"></div>
          <div class="level_list_condition col-md-6"></div>
    
  
 
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-success">Update Level %</button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


@endsection