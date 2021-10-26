@extends('layouts.user')
@section('title','Dashboard')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  
  
   <div class="">
      <div class="row">
         <div class="col-md-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>General Information</h2>
                  <div class="clearfix"></div>
               </div>
               <div class="x_content" style="font-weight: bolder;">
                  <div class="row" style="border-bottom: 1px solid #084d67; padding-bottom: 5px; margin-bottom: 5px;">
                     <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="x_panel">
                           <div class="x_content">
                              <p>Member ID: <span class="pull-right">{{Auth::user()->user_key}}</span></p>
                              <p>User Name: <span class="pull-right">{{Auth::user()->user_name}}</span></p>
                              <p>Name: <span class="pull-right">{{Auth::user()->name}}</span></p>
                              <p>Activation Date: <span class="pull-right">
                                 {{date('d-m-Y',strtotime(Auth::user()->package_activate_date))}}</span></p>
                           </div>
                        </div>
                     </div><div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="x_panel">
                           <div class="x_content">
                              <p>Member ID: <span class="pull-right">{{Auth::user()->user_key}}</span></p>
                              <p>User Name: <span class="pull-right">{{Auth::user()->user_name}}</span></p>
                              <p>Name: <span class="pull-right">{{Auth::user()->name}}</span></p>
                              <p>Activation Date: <span class="pull-right">
                                 {{date('d-m-Y',strtotime(Auth::user()->package_activate_date))}}</span></p>
                           </div>
                        </div>
                     </div><div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="x_panel">
                           <div class="x_content">
                              <p>Member ID: <span class="pull-right">{{Auth::user()->user_key}}</span></p>
                              <p>User Name: <span class="pull-right">{{Auth::user()->user_name}}</span></p>
                              <p>Name: <span class="pull-right">{{Auth::user()->name}}</span></p>
                              <p>Activation Date: <span class="pull-right">
                                 {{date('d-m-Y',strtotime(Auth::user()->package_activate_date))}}</span></p>
                           </div>
                        </div>
                     </div><div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="x_panel">
                           <div class="x_content">
                              <p>Member ID: <span class="pull-right">{{Auth::user()->user_key}}</span></p>
                              <p>User Name: <span class="pull-right">{{Auth::user()->user_name}}</span></p>
                              <p>Name: <span class="pull-right">{{Auth::user()->name}}</span></p>
                              <p>Activation Date: <span class="pull-right">
                                 {{date('d-m-Y',strtotime(Auth::user()->package_activate_date))}}</span></p>
                           </div>
                        </div>
                     </div>

                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a href="/member/direct">
               <div class="tile-stats">
                  <!-- <div class="icon" style="color: #FFF">
                     <i class="fa fa-user"></i>
                     </div> -->
                  <div class="count">{{$directs}}</div>
                  <h3>Team</h3>
               </div>
            </a>
         </div>
         <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a href="/payout/direct">
               <div class="tile-stats">
                  <!-- <div class="icon" style="color: #FFF">
                     <i class="fa fa-user"></i>
                     </div> -->
                  <div class="count">{{$Sponsor}}</div>
                  <h3>Incentive</h3>
               </div>
            </a>
         </div>
         <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <a href="" data-toggle="modal" data-target="#topUppackage">
                     <div class="tile-stats" style="background-color:purple;">
                        <div class="icon" style="color: #FFF">
                           <i class="fa fa-user"></i>
                        </div>
                        <div class="count">{{$ActivePin}} Pins</div>
                        <h3>Upgrade package</h3>
                     </div>
                  </a>
               </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <a href="" >
                     <div class="tile-stats" style="background-color:purple;">
                        <div class="icon" style="color: #FFF">
                           <i class="fa fa-user"></i>
                        </div>
                        <div class="count">10000</div>
                        <h3>Shree Miles</h3>
                     </div>
                  </a>
               </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <a href="" >
                     <div class="tile-stats" style="background-color:purple;">
                        <div class="icon" style="color: #FFF">
                           <i class="fa fa-user"></i>
                        </div>
                        <div class="count">XXX</div>
                        <h3>KP Miles (M ROI)</h3>
                     </div>
                  </a>
               </div>

                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <a href="" >
                     <div class="tile-stats" style="background-color:purple;">
                        <div class="icon" style="color: #FFF">
                           <i class="fa fa-user"></i>
                        </div>
                        <div class="count">XXX</div>
                        <h3>CS Miles (Level)</h3>
                     </div>
                  </a>
               </div>

               <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <a href="" >
                     <div class="tile-stats" style="background-color:purple;">
                        <div class="icon" style="color: #FFF">
                           <i class="fa fa-user"></i>
                        </div>
                        <div class="count">XXX</div>
                        <h3>MR Miles (Binary)</h3>
                     </div>
                  </a>
               </div>
               <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <a href="" >
                     <div class="tile-stats" style="background-color:purple;">
                        <div class="icon" style="color: #FFF">
                           <i class="fa fa-user"></i>
                        </div>
                        <div class="count">XXX</div>
                        <h3>DR Miles (Dholera)</h3>
                     </div>
                  </a>
               </div>
               <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <a href="" >
                     <div class="tile-stats" style="background-color:purple;">
                        <div class="icon" style="color: #FFF">
                           <i class="fa fa-user"></i>
                        </div>
                        <div class="count">XXX</div>
                        <h3>My Rewards</h3>
                     </div>
                  </a>
               </div>
               
         
                   
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row top_tiles">
         <div class="col-md-12">
        @if($DashboardImage)
    <img src="{{env('base_url')}}dashboard_image/{{$DashboardImage->image}}" width="100%">
    @endif
    </div>
         
      </div>
   </div>
</div>
<!-- /page content -->


<!-- Modal -->
<div id="topUppackage" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Top Up Package</h4>
         </div>
         <div class="modal-body">
            <form role="form"  action="/topUp" class="form-horizontal" method="post"  enctype="multipart/form-data" >
               {{ csrf_field() }}
               
               <span id="sponser_name"></span>
               <div class="form-group">
                  <label class="control-label col-sm-2" for="user_key">User Key:</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" id="sponsor_key" name="user_key" placeholder="Enter User Key">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-sm-2" for="earning">Package:</label>
                  <div class="col-sm-10">
                     <select name="package_id" id="addNew_package" class="form-control">
                        <option value="0">Select Package</option>
                        @foreach($packages as $package)
                        <option value="{{$package->id}}">{{$package->name}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-sm-2" for="message">Pin:</label>
                  <div class="col-sm-10">
                     <select class="form-control addNewUserPin" id="id"  name="pin"></select>
                  </div>
               </div>

               <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-success">Upgrade</button>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>


@endsection