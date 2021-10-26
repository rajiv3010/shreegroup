@extends('layouts.user')
@section('title','Pin List')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="page-title">
         <div class="title_left">
            <h3>My Pin </h3>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>Pin<small> List</small></h2>
                  <a href="/pin/assign" class="pull-right btn btn-success">Transfer Pin</a>
                  <div class="clearfix"></div>
               </div>
               <div class="x_content">
                  <div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                     <div class="row">
                        <div class="col-sm-12">
                           <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">
                              <thead>
                                 <tr role="row">
                                    <th>#</th>
                                    
                                    <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Pin: activate to sort column descending">Pin</th>
                                    
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1"  aria-label="Assign By User: activate to sort column ascending">Assign By User</th>
                                    
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1"  aria-label="Used By User: activate to sort column ascending">Used By User</th>
                                    
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 0px;" aria-label="Package name: activate to sort column ascending">Package name</th>
                                    
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 0px;" aria-label="Status: activate to sort column ascending">Status</th>
                                    
                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 0px;" aria-label="Created Date: activate to sort column ascending">Used at</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @php $i = 1 @endphp
                                 @foreach($pins as $assign_pin)
                              @if(isset($assign_pin->pin->pin_number))
                                 <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$assign_pin->pin->pin_number}}</td>
                                    <td>
                                    Assign By
                                    @if(isset($assign_pin->pinAssignBy->name))
                                    {{$assign_pin->pinAssignBy->name}}
                                    @else
                                    System
                                    @endif
                                    </td>
                                    <td> 

                                    @if(isset($assign_pin->pin->usedBy->name))
                                    Used By  
                                          {{$assign_pin->pin->usedBy->name}}
                                    @endif


                                    </td>
                                    <td>{{$assign_pin->pin->package->name}} / {{$assign_pin->pin->package->id}}</td>
                                    <td>
                                       @if(isset($assign_pin->pin->usedBy->name))
                                                @if($assign_pin->pin->status==0)
                                                Used
                                                @elseif($assign_pin->pin->status==1)
                                                Active
                                                @elseif($assign_pin->pin->status==2)
                                                Sent to  {{$assign_pin->pin->pin_owner}}
                                                @endif
                                       @else
                                              @if($assign_pin->status==0)
                                                Used
                                                @elseif($assign_pin->status==1)
                                                Active
                                                @elseif($assign_pin->status==2)
                                                Sent to  {{$assign_pin->pin->pin_owner}}
                                                @endif
                                       @endif
                                 
                                    </td>
                                    <td>{{date('d M,Y H:s',strtotime($assign_pin->created_at))}}</td>
                                 </tr>
                                
                                 @endif
                                 @php $i++ @endphp
                                 @endforeach
                              </tbody>
                           </table>
                        </div>
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