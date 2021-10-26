@extends('layouts.user')
@section('title','Promotional Bonus - Referrals')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="page-title">
         <div class="title_left">
            <h3>@yield('title') </h3> <a href="{{ URL::previous() }}" class="btn btn-xs btn-success"><i class="fa fa-backward"></i> Back</a>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>@yield('title')   </h2>
                  <div class="clearfix"></div>
               </div>
               <div class="x_content">
                  <div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                     <div class="row">
                        <div class="col-sm-12">
                           <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">
                              <thead>
                                 <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Location</th>
                                    <th>Occupation</th>
                                    <th>Whats App</th>
                                    <th>Gender</th>
                                    <th>Date of Birth</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 
                                 @foreach($resp as $key=>$value)
                                 <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->email}}</td>
                                    <td>{{$value->phone}}</td>
                                    <td>{{$value->location}}</td>
                                    <td>{{$value->occupation}}</td>
                                    <td>{{$value->phone1}}</td>
                                    <td>{{$value->gender}}</td>
                                    <td>{{$value->dob}}</td>
                                    <td>{{$value->date}}</td>
                                    <td>@if($value->status == 0)
                                       Initiated
                                       @elseif($value->status == 1)
                                       Paid
                                       @else
                                       Unpaid
                                       @endif
                                    </td>
                                 </tr>
                                 @endforeach

                                 
                              </tbody>
                              <thead>
                                 <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Location</th>
                                    <th>Occupation</th>
                                    <th>Whats App</th>
                                    <th>Gender</th>
                                    <th>Date of Birth</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                 </tr>
                              </thead>
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