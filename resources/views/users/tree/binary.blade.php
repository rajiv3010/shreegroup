@extends('layouts.user')
@section('title','Genealogy')
@section('content')

<style type="text/css">
   .green{
   border: 3px solid green;
   border-radius: 50%
   }
   .red{
   border: 3px solid red;
   border-radius: 50%
   }
   .grey{
   border: 3px solid grey;
   border-radius: 50%
   }
</style>
<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="page-title">
         <div class="title_left">
            <h3>Genealogy</h3>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-6">
               <form action="/referal/tree" method="GET">
                  <div class="input-group">
                     <input type="text" class="form-control" placeholder="Search for..." name="search">
                     <span class="input-group-btn">
                     <button class="btn btn-default" type="submit">Go!</button>
                     </span>
                  </div>
                  <!-- /input-group -->
               </form>
            </div>

            <div class="x_panel">
               <div class="x_content">
                  <!--  -->
                  <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                     <div class="col-md-6">
                        <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="background-color: black">
                           <h4 class="panel-title" style="color: #fff !important">A Team</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" style="">
                           <div class="panel-body">
                              <table class="table table-bordered">
                                 <tr>
                                    <th>Package Name</th>
                                    <th>Total Team</th>
                                    <th>Total BV</th>
                                 </tr>
                                 @php $total=0;$total1=0;$i=1 @endphp
                                 @foreach($packages as $packageLeft)
                                 <tr>
                                    <td>{{$packageLeft->name}}</td>
                                    <td> {{$packageLeft->left['count']}}</td>
                                    <td> {{$packageLeft->left['point_value']}}</td>
                                 </tr>
                                 @php $i++;  $total += $packageLeft->left['point_value'];$total1 += $packageLeft->left['count'] @endphp
                                 @endforeach
                                 <tr>
                                    <th>&nbsp;&nbsp;</th>
                                    <th>{{$total1}}</th>
                                    <th>{{$total}}</th>
                                 </tr>
                              </table>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <a class="panel-heading collapsed" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="background-color: black">
                           <h4 class="panel-title" style="color: #fff !important">B Team</h4>
                        </a>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" style="">
                           <div class="panel-body">
                              <table class="table table-bordered">
                                 <tr>
                                    <th>Package Name</th>
                                    <th>Total Team</th>
                                    <th>Total BV</th>
                                 </tr>
                                 @php $total=0;$total1=0;$i=1 @endphp
                                 @foreach($packages as $packageRight)
                                 <tr>
                                    <td>{{$packageRight->name}}</td>
                                    <td> {{$packageRight->right['count']}}</td>
                                    <td> {{$packageRight->right['point_value']}}</td>
                                 </tr>
                                 @php $i++;  $total += $packageRight->right['point_value'];$total1 += $packageRight->right['count'] @endphp
                                 @endforeach
                                 <tr>
                                    <th>&nbsp;&nbsp;</th>
                                    <th>{{$total1}}</th>
                                    <th>{{$total}}</th>
                                 </tr>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--  -->
               </div>
            </div>
            <!-- /.col-lg-6 -->
            <div class="x_panel">
               <div class="x_content">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <!-- tree -->
                     <table width="100%" border="0" cellpadding="0" cellspacing="0" class="sub_black">
                        <tr>
                           <td colspan="8" align="center" valign="top" class="viewtd">
                              <br />
                              <table width="100%" border="0" cellpadding="0" cellspacing="0" >
                                 <tr>
                                    <td colspan="2" align="center" valign="top" class="message">
                                       <a href="#" class="tt">
                                       <img width="50" class="@if(isset($cc->package_id)) @if($cc->package_id) green @else  red @endif  @else red  @endif" src="{{$cc['image']}}"> 
                                       <span class="tooltip">
                                       <span class="top"></span>
                                       <span class="bottom"></span>
                                       </span>
                                       </a> <br />
                                       {{$cc['user_key']}}<br>{{$cc['name']}}
                                    </td>
                                 </tr>
                                 <!-- row 1 -->
                                 <tr>
                                    <td colspan="4" align="center">
                                       <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" class="sl_text">
                                          <tr>
                                             <td valign="top" style="border-left:#000000 1px solid;border-right:#000000 1px solid;border-top:#000000 1px solid;">&nbsp;</td>
                                          </tr>
                                       </table>
                                    </td>
                                 </tr>
                                 <!-- row 1 -->
                                 <!-- row 2 -->
                                 <tr>
                                    <td colspan="4">
                                       <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr valign="top">
                                             <td width="50%" align="center" >
                                                @if($l['name']=="Empty")
                                                @if(isset($l['parent_key']))
                                                <a href="/member/add-new?key={{$cc['user_key']}}&position=0" class="tt">
                                                @else
                                                <a href="/referal/tree?search={{$l['user_key']}}" class="tt">
                                                @endif
                                                @else
                                                <a href="/referal/tree?search={{$l['user_key']}}" class="tt">
                                                   @endif
                                                   <img width="50" class="@if(isset($l->package_id)) @if($l->package_id) green @else  red @endif  @else red  @endif" src="{{$l['image']}}">          
                                                   <span class="tooltip">
                                                      <span class="top"></span>
                                                      @if($l['name']=="Empty")
                                                      @else
                                                      <span class="middle ">
                                                         <!-- hover -->
                                                         <table width="100%" border="0" cellpadding="5" cellspacing="1" class="darktable">
                                                            <tr align="left" class="containtd">
                                                               <td width="50" class="seprator"><strong>Name</strong></td>
                                                               <td width="51">{{$l['name']}}</td>
                                                            </tr>
                                                            <tr align="left" class="containtd">
                                                               <td class="seprator"><strong>Join Date</strong></td>
                                                               <td>{{$l['dob']}}</td>
                                                            </tr>
                                                            <tr align=left class=containtd>
                                                               <td class=seprator><strong>Package</strong></td>
                                                               <td>{!!$l['package']!!}</td>
                                                            </tr>
                                                            <tr align="left" class="containtd">
                                                               <td class="seprator"><strong>Sponser</strong></td>
                                                               <td> {{$l['sponsor_key']}}<br></td>
                                                            </tr>
                                                            <tr align="left" class="containtd">
                                                               <td class="seprator"><strong>City</strong></td>
                                                               <td>Indore</td>
                                                            </tr>
                                                         </table>
                                                         <!-- hover -->
                                                      </span>
                                                      @endif
                                                      <span class="bottom"></span>
                                                   </span>
                                                </a>
                                                <br />
                                                <span data-user-key="{{$l['user_key']}}">{{$l['user_key']}}<br>{{$l['name']}}                                             
                                                </span>
                                             </td>
                                             <td width="50%" align="center">
                                                @if($r['name']=="Empty")
                                                @if(isset($r['parent_key']))
                                                <a href="/member/add-new?key={{$cc['user_key']}}&position=1" class="tt">
                                                @else
                                                <a href="/referal/tree?search={{$r['user_key']}}" class="tt">
                                                @endif
                                                @else
                                                <a href="/referal/tree?search={{$r['user_key']}}" class="tt">
                                                   @endif
                                                   <img width="50" class="@if(isset($r->package_id)) @if($r->package_id) green @else  red @endif  @else red  @endif" src="{{$r['image']}}" > 
                                                   <span class="tooltip">
                                                      <span class="top"></span>
                                                      @if($r['name']=="Empty")
                                                      @else
                                                      <span class="middle">
                                                         <!-- hover -->
                                                         <table width="100%" border="0" cellpadding="5" cellspacing="1" class="darktable">
                                                            <tr align="left" class="containtd">
                                                               <td width="50" class="seprator"><strong>Name</strong></td>
                                                               <td width="51">{{$r['name']}}</td>
                                                            </tr>
                                                            <tr align="left" class="containtd">
                                                               <td class="seprator"><strong>Join Date</strong></td>
                                                               <td>{{$r['dob']}}</td>
                                                            </tr>
                                                            <tr align=left class=containtd>
                                                               <td class=seprator><strong>Package</strong></td>
                                                               <td>{!!$r['package']!!}</td>
                                                            </tr>
                                                            <tr align="left" class="containtd">
                                                               <td class="seprator"><strong>Sponser</strong></td>
                                                               <td> {{$r['sponsor_key']}}<br></td>
                                                            </tr>
                                                            <tr align="left" class="containtd">
                                                               <td class="seprator"><strong>City</strong></td>
                                                               <td>Indore</td>
                                                            </tr>
                                                         </table>
                                                         <!-- hover -->
                                                      </span>
                                                      @endif
                                                      <span class="bottom"></span>
                                                   </span>
                                                </a>
                                                <br />
                                                {{$r['user_key']}}<br>{{$r['name']}}                              
                                             </td>
                                          </tr>
                                          <tr>
                                             <td width="50%" height="28" align="center">
                                                <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" class="sl_text">
                                                   <tr>
                                                      <td valign="top" style="border-left:#000000 1px solid;border-right:#000000 1px solid;border-top:#000000 1px solid;">&nbsp;</td>
                                                   </tr>
                                                </table>
                                             </td>
                                             <td width="50%" height="26" align="center">
                                                <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" class="sl_text">
                                                   <tr>
                                                      <td valign="top" style="border-left:#000000 1px solid;border-right:#000000 1px solid;border-top:#000000 1px solid;">&nbsp;</td>
                                                   </tr>
                                                </table>
                                             </td>
                                          </tr>
                                       </table>
                                    </td>
                                 </tr>
                                 <!-- row 2 -->
                                 <!-- row 3 -->
                                 <tr>
                                    <td colspan="4">
                                       <table width="100%" height="0%" border="0" cellpadding="0" cellspacing="0">
                                          <tr align="center">
                                             <td width="25%" height="85%" valign="top">
                                                @if($ll['name']=="Empty")
                                                @if(isset($l['user_key']) && $l['user_key'])
                                                <a href="/member/add-new?key={{$l['user_key']}}&position=0" class="tt">
                                                @else
                                                <a href="/referal/tree?search={{$ll['user_key']}}" class="tt">
                                                @endif
                                                @else
                                                <a href="/referal/tree?search={{$ll['user_key']}}" class="tt">
                                                   @endif
                                                   <img width="50" class="@if(isset($ll->package_id)) @if($ll->package_id) green @else  red @endif  @else red  @endif" src="{{$ll['image']}}"    border="0" />
                                                   <span class="tooltip">
                                                      <span class="top"></span>
                                                      @if($ll['name']=="Empty")
                                                      @else
                                                      <span class="middle">
                                                         <!-- hover -->
                                                         <table width="100%" border="0" cellpadding="5" cellspacing="1" class="darktable">
                                                            <tr align="left" class="containtd">
                                                               <td width="50" class="seprator"><strong>Name</strong></td>
                                                               <td width="51">{{$ll['name']}}</td>
                                                            </tr>
                                                            <tr align="left" class="containtd">
                                                               <td class="seprator"><strong>Join Date</strong></td>
                                                               <td>{{$ll['dob']}}</td>
                                                            </tr>
                                                            <tr align=left class=containtd>
                                                               <td class=seprator><strong>Package</strong></td>
                                                               <td>{!!$ll['package']!!}</td>
                                                            </tr>
                                                            <tr align="left" class="containtd">
                                                               <td class="seprator"><strong>Sponser</strong></td>
                                                               <td> {{$ll['sponsor_key']}}<br></td>
                                                            </tr>
                                                            <tr align="left" class="containtd">
                                                               <td class="seprator"><strong>City</strong></td>
                                                               <td>Indore</td>
                                                            </tr>
                                                         </table>
                                                         <!-- hover -->
                                                      </span>
                                                      @endif
                                                      <span class="bottom"></span>
                                                   </span>
                                                </a>
                                                <br />
                                                {{$ll['user_key']}}<br>{{$ll['name']}}                        
                                             </td>
                                             <td width="25%" valign="top" >
                                                @if($lr['name']=="Empty")
                                                @if(isset($lr['parent_key']) && $lr['parent_key'])
                                                <a href="/member/add-new?key={{$lr['parent_key']}}&position=1" class="tt">
                                                @else
                                                <a href="/referal/tree?search={{$lr['user_key']}}" class="tt">
                                                @endif
                                                @else
                                                <a href="/referal/tree?search={{$lr['user_key']}}" class="tt">
                                                   @endif
                                                   <img width="50" class="@if(isset($lr->package_id)) @if($lr->package_id) green @else  red @endif  @else red  @endif" src="{{$lr['image']}}"    border="0" />
                                                   <span class="tooltip">
                                                      <span class="top"></span>
                                                      @if($lr['name']=="Empty")
                                                      @else
                                                      <span class="middle">
                                                         <!-- hover -->
                                                         <table width="100%" border="0" cellpadding="5" cellspacing="1" class="darktable">
                                                            <tr align="left" class="containtd">
                                                               <td width="50" class="seprator"><strong>Name</strong></td>
                                                               <td width="51">{{$lr['name']}}</td>
                                                            </tr>
                                                            <tr align="left" class="containtd">
                                                               <td class="seprator"><strong>Join Date</strong></td>
                                                               <td>{{$lr['dob']}}</td>
                                                            </tr>
                                                            <tr align=left class=containtd>
                                                               <td class=seprator><strong>Package</strong></td>
                                                               <td>{!!$lr['package']!!}</td>
                                                            </tr>
                                                            <tr align="left" class="containtd">
                                                               <td class="seprator"><strong>Sponser</strong></td>
                                                               <td> {{$lr['sponsor_key']}}<br></td>
                                                            </tr>
                                                            <tr align="left" class="containtd">
                                                               <td class="seprator"><strong>City</strong></td>
                                                               <td>Indore</td>
                                                            </tr>
                                                         </table>
                                                         <!-- hover -->
                                                      </span>
                                                      @endif
                                                      <span class="bottom"></span>
                                                   </span>
                                                </a>
                                                <br />
                                                {{$lr['user_key']}}<br>{{$lr['name']}}                              
                                             </td>
                                             <td width="25%" valign="top" >
                                                @if($rl['name']=="Empty")
                                                @if(isset($rl['parent_key']) && $rl['parent_key'])
                                                <a href="/member/add-new?key={{$rl['parent_key']}}&position=0" class="tt">
                                                @else
                                                <a href="/referal/tree?search={{$rl['user_key']}}" class="tt">
                                                @endif
                                                @else
                                                <a href="/referal/tree?search={{$rl['user_key']}}" class="tt">
                                                   @endif
                                                   <img width="50" class="@if(isset($rl->package_id)) @if($rl->package_id) green @else  red @endif  @else red  @endif" src="{{$rl['image']}}"    border="0" />
                                                   <span class="tooltip">
                                                      <span class="top"></span>
                                                      @if($rl['name']=="Empty")
                                                      @else
                                                      <span class="middle">
                                                         <!-- hover -->
                                                         <table width="100%" border="0" cellpadding="5" cellspacing="1" class="darktable">
                                                            <tr align="left" class="containtd">
                                                               <td width="50" class="seprator"><strong>Name</strong></td>
                                                               <td width="51">{{$rl['name']}}</td>
                                                            </tr>
                                                            <tr align="left" class="containtd">
                                                               <td class="seprator"><strong>Join Date</strong></td>
                                                               <td>{{$rl['dob']}}</td>
                                                            </tr>
                                                            <tr align=left class=containtd>
                                                               <td class=seprator><strong>Package</strong></td>
                                                               <td>{!!$rl['package']!!}</td>
                                                            </tr>
                                                            <tr align="left" class="containtd">
                                                               <td class="seprator"><strong>Sponser</strong></td>
                                                               <td> {{$rl['sponsor_key']}}<br></td>
                                                            </tr>
                                                            <tr align="left" class="containtd">
                                                               <td class="seprator"><strong>City</strong></td>
                                                               <td>Indore</td>
                                                            </tr>
                                                         </table>
                                                         <!-- hover -->
                                                      </span>
                                                      @endif
                                                      <span class="bottom"></span>
                                                   </span>
                                                </a>
                                                <br />
                                                {{$rl['user_key']}}<br>{{$rl['name']}}                            
                                             </td>
                                             <td width="25%" valign="top" >
                                                @if($rr['name']=="Empty")
                                                @if(isset($r['parent_key']) && $r['parent_key'])
                                                <a href="/member/add-new?key={{$r['user_key']}}&position=1" class="tt">
                                                @else
                                                <a href="/referal/tree?search={{$rr['user_key']}}" class="tt">
                                                @endif
                                                @else
                                                <a href="/referal/tree?search={{$rr['user_key']}}" class="tt">
                                                   @endif
                                                   <img width="50" class="@if(isset($rr->package_id)) @if($rr->package_id) green @else  red @endif  @else red  @endif" src="{{$rr['image']}}"    border="0" />
                                                   <span class="tooltip">
                                                      <span class="top"></span>
                                                      @if($rr['name']=="Empty")
                                                      @else
                                                      <span class="middle ">
                                                         <!-- hover -->
                                                         <table width="100%" border="0" cellpadding="5" cellspacing="1" class=" middlelast">
                                                            <tr align="left" class="containtd">
                                                               <td width="50" class="seprator"><strong>Name</strong></td>
                                                               <td width="51">{{$rr['name']}}</td>
                                                            </tr>
                                                            <tr align="left" class="containtd">
                                                               <td class="seprator"><strong>Join Date</strong></td>
                                                               <td>{{$rr['dob']}}</td>
                                                            </tr>
                                                            <tr align=left class=containtd>
                                                               <td class=seprator><strong>Package</strong></td>
                                                               <td>{!!$rr['package']!!}</td>
                                                            </tr>
                                                            <tr align="left" class="containtd">
                                                               <td class="seprator"><strong>Sponser</strong></td>
                                                               <td> {{$rr['sponsor_key']}}<br></td>
                                                            </tr>
                                                            <tr align="left" class="containtd">
                                                               <td class="seprator"><strong>City</strong></td>
                                                               <td>Indore</td>
                                                            </tr>
                                                         </table>
                                                         <!-- hover -->
                                                      </span>
                                                      @endif
                                                      <span class="bottom"></span>
                                                   </span>
                                                </a>
                                                <br />
                                                {{$rr['user_key']}}<br>{{$rr['name']}}                          
                                             </td>
                                          </tr>
                                       </table>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td colspan="4">
                                       <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                       </table>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td colspan="8" align="center" valign="top">&nbsp;</td>
                        </tr>
                        <tr>
                           <td colspan="8" align="center" valign="top">&nbsp;</td>
                        </tr>
                        <tr>
                           <td colspan="8" align="center" valign="top">&nbsp;</td>
                        </tr>
                     </table>
                     <!-- tree -->
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