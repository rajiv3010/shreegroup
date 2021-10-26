@extends('layouts.user')
@section('title','TDS')
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
                  <h2>@yield('title')<small> Details</small></h2>
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
                                <th>Date</th>
                                <th>TDS</th>
                                </tr>
                              </thead>
                              <tbody>
                                 @php $i=1;$sum=0 @endphp
                                  @foreach($tdsreport as $tdsr)
                                  <tr>
                                    <td>{{$i}}</td>
                                    <td>{{ date('Y-m-d',strtotime($tdsr->created_at))}}</td>
                                    <td>{{$tdsr->tds}}</td>
                                    @php $sum +=$tdsr->tds @endphp 
                                    @php $i++; @endphp
                                 </tr>
                                  @endforeach
                              </tbody>
                              <tr>
                                <td></td>
                                <td>Total TDS</td>
                                <td><i class="fa fa-inr" aria-hidden="true"></i>{{$sum}}</td>
                              </tr>
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