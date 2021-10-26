@extends('layouts.user')
@section('title','Downline')
@section('content')



<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Associates</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">


                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Team A</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Team B</a>
                        </li>
                        
                      </ul>
          <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>A Team<small> Members</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
          
                    <div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                     <div class="row">
                       <div class="col-sm-12">
                           <table class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">

                      <thead>
                        <tr role="row">
                          <th>#</th>
                          <th>Date of joining</th>
                          <th>Member ID</th>
                          <th>Name</th>
                          <th>Referral ID</th>
                          <th>Placement ID</th>
                          <th>Position</th>
                          <th>Mobile No.</th>
                          <th>Package</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($myLeftLegUsers as $key=>$myLeftLegUser)
                        <tr role="row" class="even">
                           <td>{{$key+1}}</td>
                          <td>{{$myLeftLegUser['created_at']}}</td>
                          <td>{{$myLeftLegUser['user_key']}}</td>
                          <td>{{$myLeftLegUser['name']}}</td>
                          <td>{{$myLeftLegUser['sponsor_key']}}</td>
                          <td>{{$myLeftLegUser['parent_key']}}</td>
                          <td>@if($myLeftLegUser['leg']) B @else A @endif</td>

                          @php $sumOfLeftLeftpv=0 @endphp
                          @php $sumOfLeftRightpv=0 @endphp
                          <!--          <td>{{$sumOfLeftLeftpv}} </td>
                          <td>{{$sumOfLeftRightpv}}</td>
                          -->         
                          <td>{{$myLeftLegUser['mobile']}}</td>
                          <td>{{$myLeftLegUser['package_name']}}</td>
                        </tr>
                        @empty
                        <tr> 
                        <td colspan="10">No Data Found</td>
                        </tr>
                        @endforelse

                      </tbody>
                    </table>
                  </div>
                 </div>
               </div>
              </div>
             </div>
            </div>
           </div>

                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>B Team<small> Members</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
          
                    <div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                     <div class="row">
                        <div class="col-sm-12">
                           <table  class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">
                        <thead>
                        <tr role="row">
                          <th>#</th>
                          <th>Date of joining</th>
                          <th>Member ID</th>
                          <th>Name</th>
                          <th>Referral ID</th>
                          <th>Placement ID</th>
                          <th>Position</th>
                          <th>Mobile No.</th>
                          <th>Package</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($myRightLegUsers as $key=>$myRightLegUser)
                        <tr role="row" class="even">
                          <td>{{$key+1}}</td>
                          <td>{{$myRightLegUser['created_at']}}</td>
                          <td>{{$myRightLegUser['user_key']}}</td>
                          <td>{{$myRightLegUser['name']}}</td>
                          <td>{{$myRightLegUser['sponsor_key']}}</td>
                          <td>{{$myRightLegUser['parent_key']}}</td>
                          <td>@if($myRightLegUser['leg']) B @else A @endif</td>

                          @php $sumOfLeftLeftpv=0 @endphp
                          @php $sumOfLeftRightpv=0 @endphp
                          <!--          <td>{{$sumOfLeftLeftpv}} </td>
                          <td>{{$sumOfLeftRightpv}}</td>
                          -->         
                          <td>{{$myRightLegUser['mobile']}}</td>
                          <td>{{$myRightLegUser['package_name']}}</td>
                        </tr>
                        @empty
                        <tr> 
                        <td colspan="10">No Data Found</td>
                        </tr>
                        @endforelse

                      </tbody>
                    </table>
                  </div>
                 </div>
               </div>
              </div>
             </div>
            </div>


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