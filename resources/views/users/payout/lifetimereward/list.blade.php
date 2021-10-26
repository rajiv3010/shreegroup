@extends('layouts.user')
@section('title','Lifetime Reward')
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
                  <h2>@yield('title') </h2>
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
                                    <th>Level</th>
                                    <th>Target</th>
                                    <th>Achieved</th>
                                    <th>Income</th>
                                    <th>Details</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @php $next=0; @endphp
                                 @foreach($Achievements as $key=>$value)
                                 <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->step_range}}</td>
                                    <td>
                                       @if(count($myAchivements))
                                       @if($myAchivements['current_pv'] >=$value->min )
                                       Achieved  
                                       @endif
                                        @if($value->id==$myAchivements['id']) 
                                             @php $next=$myAchivements['id']+1; @endphp                                     
                                        @else 
                                        @endif
                                        @if($value->id ==$next)
                                       <span class="badge badge-warning">
                                       Need to Achive: {{$value->min-$myAchivements['current_pv']}} / {{$myAchivements['current_pv']}}
                                       </span>


                                        @endif
                                        @endif

                                     </td>
                                    <td>Yet to achieve</td>

                                    <td>
                                       <a href="/payout/life-time-reward/details/{{$value->business_area_id}}" class="btn btn-xs btn-info">View</a>
                                       
                                    </td>
                                 </tr>
                                 @endforeach

                                 
                                 
                                 
                              </tbody>
                              <thead>
                                 <tr>
                                    <th>&nbsp;&nbsp;</th>
                                    <th>&nbsp;&nbsp;</th>
                                    <th>&nbsp;&nbsp;</th>
                                    <th>&nbsp;&nbsp;</th>
                                    <th>&nbsp;&nbsp;</th>
                                    <th>&nbsp;&nbsp;</th>
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