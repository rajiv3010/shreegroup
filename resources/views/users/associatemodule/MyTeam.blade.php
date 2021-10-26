@extends('layouts.user')
@section('title','Full Team')
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
                  <h2><small>
                  <a href="{{ URL::previous() }}" class="btn btn-xs btn-success"><i class="fa fa-backward"></i> Back</a>
                  <a href="/member/direct" class="btn btn-xs btn-primary"> My Direct</a>
                  <a href="/member/my-team" class="btn btn-xs btn-primary"> Full Team</a>
                  </small></h2>
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
                           <th>Date of joining</th>
                           <th >User name</th>
                           <th >Member ID</th>
                           <th >Name</th>
                           <th >Referral ID</th>
                           <th >Level</th>
                        </tr>
                       </thead>
                       <tbody>
                        @forelse($totlaDownLine as $key=>$direct)
                           
                           <tr>
                              <td>{{$key+1}}</td>
                              <td>{{$direct->created_at}}</td>
                              <td>{{$direct->user_name}}</td>
                              <td>{{$direct->user_key}}</td>
                              <td>{{$direct->name}}</td>
                              <td>{{$direct->sponsor_key}}</td>
                              
                              <td>{{$direct->level}}</td>
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