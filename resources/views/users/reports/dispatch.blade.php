@extends('layouts.user')
@section('title','Dispatch')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="page-title">
         <div class="title_left">
            <h3>Dispatch</h3>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>Dispatch<small> Details</small></h2>
                  <div class="clearfix"></div>
               </div>
               <div class="x_content">
                  <div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                     <div class="row">
                        <div class="col-sm-12">
                           <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">
                              <thead>
                                 <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Consignment Name</th>
                                    <th>Courier Company</th>
                                    <th>Tracking URL</th>
                                    <th>Tracking id</th>
                                    <th>Dispatch Date</th>
                                  </tr>
                              </thead>
                              <tbody>
                                 @php $i=1 @endphp
                                 @foreach($dispatchreport as $dispatchentry)
                                    <tr>
                                      <td>{{$i}}</td>
                                      <td>{{$dispatchentry->user->name}}</td>
                                      <td>{{$dispatchentry->title}}</td>
                                      <td>{{$dispatchentry->courier_company}}</td>
                                      <td><a href="{{$dispatchentry->url}}" target="_blank"><u>{{$dispatchentry->url}}</u></a></td>
                                      <td>{{$dispatchentry->tracking_id}}</td>
                                      <td>{{ date('d ,M Y',strtotime($dispatchentry->dispatch_date))}}</td>
                                    </tr>
                                    @php $i++; @endphp
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