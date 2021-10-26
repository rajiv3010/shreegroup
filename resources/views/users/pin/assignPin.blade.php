@extends('layouts.user')
@section('title','Pin Transfer')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="page-title">
         <div class="title_left">
            <h3>Pin </h3>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="">
         <div class="col-md-12 col-sm-12 col-xs-12">
            @if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif   
@if(Session::has('message'))
<div class="alert alert-danger">
<p>{{Session::get('message') }}</p>
</div>
@endif

            <div class="x_panel">
               <div class="x_title">
                  <h2>Pin<small> Transfer</small></h2>
                  <a href="/pin/list" class="pull-right btn btn-success">Pin List</a>
                  <div class="clearfix"></div>
               </div>
               <div class="x_content">

              <form action="/pin/assignPost" method="POST">
              {{csrf_field() }}
              <div class="row">
              <div class="form-group col-md-3">
              <label>Enter user Key</label>
              <input class="form-control assignPinUser" name="user_key" id="assinPinAdminToUser">
              </div>
              <div class="form-group col-md-3">
              <span class="userDetailsDiv"></span>
              </div> 

              <div class="col-lg-3"><button type="submit" class="btn btn-block btn-success">Assign</button></div>
              </div>
            
                  <div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                     <div class="row">
                        <div class="col-sm-12">
                           <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">
                              <thead>
                                 <tr role="row">
                                    <th>Select</th>
                                    <th>#</th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Pin: activate to sort column descending">Pin</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1"  aria-label="Assign By User: activate to sort column ascending">Assign By User</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 0px;" aria-label="Package name: activate to sort column ascending">Package name</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 0px;" aria-label="Status: activate to sort column ascending">Status</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 0px;" aria-label="Created Date: activate to sort column ascending">Created Date</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @php $i = 1 @endphp
                                 @foreach($pins as $pin)
                                 <tr>
                                  <td> 
                                    @if($pin->status==1)
                                        <input type="checkbox" name="pin_id[]" value="{{$pin->pin_id}}">
                                    @else
                                    @endif
                                  </td>
                                    <td>{{$i}}</td>
                                    <td>@if(isset($pin->pin->pin_number))
                                          {{$pin->pin->pin_number}}
                                          @else
                                          NA
                                          @endif
                                        </td>
                                    <td>
                                      @if(isset($pin->pinAssignBy->name))
                                        {{$pin->pinAssignBy->name}}
                                        @else
                                          System
                                      @endif

                                    </td>
                                    <td>
                                      @if(isset($pin->pin->package->name))
                                      {{$pin->pin->package->name}}
                                      @else
                                      System
                                      @endif

                                    </td>
                                    <td>
                                      @if($pin->status==0)
                                       Used
                                       @elseif($pin->status==1)
                                        Active
                                       @elseif($pin->status==2)
                                       Sent
                                          
                                       @else
                                       
                                       @endif
                                    </td>
                                    <td>{{date('d M,Y H:s',strtotime($pin->created_at))}}</td>
                                 </tr>
                                 @php $i++ @endphp
                                 @endforeach
                              </tbody>
                           </table>
                        </div>
                      </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
      </div>
      <div class="clearfix"></div>
   </div>
   <div class="clearfix"></div>
</div>
<!-- /page content -->
@endsection