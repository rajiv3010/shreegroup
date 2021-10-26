@extends('layouts.user')
@section('title','Support History')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="page-title">
         <div class="title_left">
            <h3>@yield('title') </h3>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>@yield('title') <small> <a href="/support/" class="btn btn-xs btn-info">Create New Support</a></small> </h2>
                  <div class="clearfix"></div>
               </div>
               <div class="x_content">
                  <div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                     <div class="row">
                        <div class="col-sm-12">
                           <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">
                              <thead>
                                 <tr >
                                    <th>#</th>
                                    <th>Message</th>
                                    <th>Document</th>
                                    <th >Date</th>
                                    <th >Status</th>
                                    
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach($support_history as $key=>$value)
                                 @if(Auth::user()->user_key == $value->user_key)
                                 <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$value->message}}</td>
                                    <td><a href="{{env('base_url')}}documentation/support/{{$value->document}}" target="_blank">
                                       <img src="{{env('base_url')}}documentation/support/{{$value->document}}" width="70"></a></td>
                                    <td>{{date('d-M-Y', strtotime($value->created_at))}}</td>
                                    <td>@if($value->status == 0)
                                    	<span class="label label-info">Open</span>
                                    	@elseif($value->status == 1)
                                    	<span class="label label-success">Accepted</span>
                                    	@elseif($value->status == 2)
                                    	<span class="label label-warning">Closed & Fixed</span>
                                    	@endif
                                    </td>
                                    
                                 </tr>
                                 @else
                                 <tr>
                                    <td colspan="4">No Data Found</td>
                                 </tr>
                                 @endif
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