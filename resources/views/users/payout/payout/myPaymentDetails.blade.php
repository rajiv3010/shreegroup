@extends('layouts.user')
@section('title','Payments Details')
@section('content')



<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Payments Details - <a href="{{ URL::previous() }}" class="btn btn-xs btn-success"><i class="fa fa-backward"></i> Back</a></h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Payments<small> Details</small></h2>
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
                          <th>Earning</th>
                          <th>TDS</th>
                          <th>Admin</th>
                          <th>Payable</th>
                          <th>Status</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
                      
                      @foreach($myPaymentDetails as $key=>$value)
                      <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$value->earning}}</td>
                      <td>{{$value->tds}}</td>
                      <td>{{$value->admin_charges}}</td>
                      <td>{{$value->amount}}</td>
                      <td>@if($value->status==0)
                      <span class="label label-danger">Pending</span>
                      @elseif($value->status==1)
                      <span class="label label-info">Processed</span>
                      @elseif($value->status==3)
                      <span class="label label-success">Paid</span>
                      
                      @endif
                      </td>
                      <td>{{$value->created_at}}</td>
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