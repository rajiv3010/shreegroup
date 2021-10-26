@extends('layouts.admin')
@section('title','Genealogy')
@section('content')
<style type="text/css">
   .red{
   border: 3px solid red;
   border-radius: 50%
   }
   .green{
   border: 3px solid green;
   border-radius: 50%
   }
   /*---------- bubble tooltip -----------*/
   .leftTableButton{cursor: pointer}
   .rightTableButton{cursor: pointer}
   a.tt{
   position:relative;
   z-index:24;
   color:#3CA3FF;
   font-weight:normal;
   text-decoration:none;
   }
   a.tt span{ display: none; }
   /*background:; ie hack, something must be changed in a for ie to execute it*/
   a.tt:hover{ z-index:25; color: #aaaaff; background:;}
   a.tt:hover span.tooltip{
   display:block;
   position:absolute;
   top:0px; left:0;
   padding: 15px 0 0 0;
   width:250px;
   color: #993300;
   text-align: center;
   filter: alpha(opacity:95);
   KHTMLOpacity: 0.95;
   MozOpacity: 0.95;
   opacity: 0.95;
   }
   a.tt:hover span.top{
   display: block;
   padding: 30px 8px 0;
   background: url(bubble.gif) no-repeat top;
   }
   a.tt:hover span.middle{ /* different middle bg for stretch */
   display: block;
   padding: 0 8px;
   background: url(bubble_filler.gif) repeat bottom;
   }
   .darktable{
   background-color: white;
   margin-left: 52px;
   }
   .middlelast{
   background-color: white;
   position: absolute;
   right: 238px;
   }
   a.tt:hover span.bottom{
   display: block;
   padding:3px 8px 10px;
   color: #548912;
   background: 'loading...' no-repeat bottom;
   }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <!-- Main content -->
   <section class="content">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="x_panel">
            <div class="x_content">
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_title">
                     <h2>Tree<small> <a href="/admin/user" class="btn btn-success"> <span>Back</span> </a> </small></h2>
                     <div class="clearfix"></div>
                  </div>
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
                                                                                          @else
                                             <a href="/admin/associate/tree?search={{$l['user_key']}}" class="tt">
                                             @endif
                                             @else
                                             <a href="/admin/associate/tree?search={{$l['user_key']}}" class="tt">
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
                                            
                                             @else
                                             <a href="/admin/associate/tree?search={{$r['user_key']}}" class="tt">
                                             @endif
                                             @else
                                             <a href="/admin/associate/tree?search={{$r['user_key']}}" class="tt">
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
                                             @else
                                             <a href="/admin/associate/tree?search={{$ll['user_key']}}" class="tt">
                                             @endif
                                             @else
                                             <a href="/admin/associate/tree?search={{$ll['user_key']}}" class="tt">
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
                                             
                                             @else
                                             <a href="/admin/associate/tree?search={{$lr['user_key']}}" class="tt">
                                             @endif
                                             @else
                                             <a href="/admin/associate/tree?search={{$lr['user_key']}}" class="tt">
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
                                             
                                             @else
                                             <a href="/admin/associate/tree?search={{$rl['user_key']}}" class="tt">
                                             @endif
                                             @else
                                             <a href="/admin/associate/tree?search={{$rl['user_key']}}" class="tt">
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
                                              @else
                                             <a href="/admin/associate/tree?search={{$rr['user_key']}}" class="tt">
                                             @endif
                                             @else
                                             <a href="/admin/associate/tree?search={{$rr['user_key']}}" class="tt">
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
      
</section>
</div>
@endsection