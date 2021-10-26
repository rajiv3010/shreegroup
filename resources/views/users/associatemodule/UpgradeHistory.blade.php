@extends('layouts.user')
@section('title','Upgrade History')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="page-title">
         <div class="title_left">
            <h3>@yield('title')</h3>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>@yield('title')</h2>
                  <div class="clearfix"></div>
               </div>
               <div class="x_content">
                  <div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                     <div class="row">
                        <div class="col-sm-12">
                           <table id="datatable-responsive" class="table table-striped table-bordered  nowrap dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">
                              <thead>
                                 <tr >
                                    <th>#</th>
                                    <th>Package</th>
                                    <th>Date of upgrade</th>
                                    <th>Date of Activation</th>
                                 </tr>
                              </thead>
                              <tbody>
                                @foreach($UpgradeHistory as $key=>$value)
                                 <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$value->package->name}}</td>
                                    <td>{{ date('d-m-Y',strtotime($value->created_at))}}</td>
                                    <td>{{ $value->created_at->addDays(5)->format('d-m-Y') }}</td>
                                 </tr>
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