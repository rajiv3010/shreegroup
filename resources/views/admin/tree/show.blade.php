@extends('layouts.admin')
@section('title','Generate PIN')
@section('content')
<style type="text/css">
/*---------- bubble tooltip -----------*/
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
</style>
<script language="javascript">
  function showMember(ID)
   {
    document.getElementById("member_id").value=ID;
    document.getElementById("form1").submit();
   }



  function gofunc(MEMBER_ID,LOGIN_ID,LEG)
   {
    document.form1.member_id.value=MEMBER_ID;
    document.form1.login_id.value=LOGIN_ID;
    document.form1.leg.value=LEG;
    //document.form1.action="sign_up.php";
    if(MEMBER_ID!="" && LOGIN_ID!="")
    {
      //var url='registration.php?upline_id='+ LOGIN_ID + '&adjust_to=' + LOGIN_ID + '&leg=' + LEG;
      var url='../join_now.php?introducer_username=priya_obo &tracking_id=618957';
        var win=window.open(url,'win');
      //document.form1.submit();
    }
   }

</script>
    <?php print_r($myLeft); ?>
    <br>
             <?php print_r($myRight); ?>

<div style="display: none;" class="page_spinner">
  <div></div>
</div>
<div class="over">
  <div style="padding-top: 30px;" class="centre">
    <div class="main">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="sub_black">
   <input type="hidden" name="login_id" id="login_id" />
   <input type="hidden" name="member_id" id="member_id" />
   <input type="hidden" name="leg" id="leg" />
   <tr>
      <td colspan="8" align="center" valign="top" class="viewtd">
         <br />
         <table width="100%" border="0" cellpadding="0" cellspacing="0" >
            <tr>
               <td colspan="4" align="center" class="red2"><strong>
                  </strong><strong>Welcome to your Binary Tree : Priya Bholanath Mishra(618957) </strong> 
               </td>
            </tr>
            <tr align="center">
               <td colspan="2" align="right"><strong>Search OBO ( Tracking ID ) :</strong></td>
               <td colspan="2" align="left"><input name="search_id" type="text" id="search_id" />
                  <input name="VIEW" type="submit" class="button" id="VIEW" value="View Tree" onClick="javascript:if(document.getElementById('search_id').value==''){alert('Please enter login Id to search'); return false;}" />
               </td>
            </tr>
            <tr align="center">
               <td colspan="4">
                  <br>
                  <table border="0" cellpadding="2" cellspacing="1">
                     <tr align="center" >
                        <td width="65"></td>
                        <td width="65"></td>
                        <td width="65"></td>
                     </tr>
                     <tr align="center" >
                        <td><strong>Empty</strong></td>
                        <td><strong>Inactive </strong></td>
                        <td><strong>Active</strong></td>
                     </tr>
                  </table>
                  <br />
               </td>
            </tr>
            <tr>
               <td width="224" align="center" valign="top" class="message">
                  <span style="background:url();height:140px;width:178px;color:#FF6600;background-position:left;font-size:18px;padding-top:26px;background-repeat:no-repeat;">LEFT : {{$leftCount}}<br>LPV : 0.0000</span>
               </td>
               <td colspan="2" align="center" valign="top" class="message"><a href="javascript://" class="tt"><span class="tooltip"><span class="top"></span><span class="middle">
                  </span><span class="bottom"></span></span></a> <br />
                  {{Auth::user()->user_key}}<br>{{Auth::user()->name}} 
               </td>
               <td width="214" align="center" valign="top" class="message">
                  <span style="height:140px;width:178px;color:#FF6600;background-position:left;font-size:18px;padding-top:26px;background-repeat:no-repeat;">
                  RIGHT : {{$rightCount}}<br>RPV : 18663.7201
                  </span>
               </td>
            </tr>
            <tr>
               <td colspan="4" align="center">
                  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" class="sl_text">
                     <tr>
                        <td valign="top" style="border-left:#000000 1px solid;border-right:#000000 1px solid;border-top:#000000 1px solid;">&nbsp;</td>
                     </tr>
                  </table>
               </td>
            </tr>
            <tr>
               <td colspan="4">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                     <tr valign="top">
                        <td width="50%" align="center">                          <a href="javascript:showMember('1170')" class="tt"><span class="tooltip"><span class="top"></span><span class="middle">
                           </span><span class="bottom"></span></span></a> <br />
                           591138<br>RAJENDRA V JADAV                                                     
                        </td>
                        <td width="50%" align="center">                                <a href="javascript:showMember('1149')" class="tt"><span class="tooltip"><span class="top"></span><span class="middle">
                           </span><span class="bottom"></span></span></a> <br />
                           196980<br>JADAV HEMANT VINUBHAI                                 
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
            <tr>
               <td colspan="4">
                  <table width="100%" height="0%" border="0" cellpadding="0" cellspacing="0">
                     <tr align="center">
                        <td width="25%" height="85%" valign="top">                          <a href="javascript:showMember('2104')" class="tt"><span class="tooltip"><span class="top"></span><span class="middle">
                           </span><span class="bottom"></span></span></a> <br />
                           279644<br>JADAV FALGUN CHANDUBHAI                           
                        </td>
                        <td width="25%" valign="top" >                                <a href="javascript:showMember('2099')" class="tt"><span class="tooltip"><span class="top"></span><span class="middle">
                           </span><span class="bottom"></span></span></a> <br />
                           682287<br>PARMAR DHARMESH SHANTILAL                                 
                        </td>
                        <td width="25%" valign="top" >                                <a href="javascript:showMember('1156')" class="tt"><span class="tooltip"><span class="top"></span><span class="middle">
                           </span><span class="bottom"></span></span></a> <br />
                           976933<br>NIL MUKESHBHAI PATEL                                 
                        </td>
                        <td width="25%" valign="top" >                                <a href="javascript:showMember('2089')" class="tt"><span class="tooltip"><span class="top"></span><span class="middle">
                           </span><span class="bottom"></span></span></a> <br />
                           460648<br>JADAV RUDRAPRATAPSINH RAMESHBHAI                                 
                        </td>
                     </tr>
                     <tr align="center">
                        <td height="5" colspan="4"></td>
                     </tr>
                     <tr align="center">
                        <td width="25%" height="15%">
                           <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" class="sl_text">
                              <tr>
                                 <td valign="top" style="border-left:#000000 1px solid;border-right:#000000 1px solid;border-top:#000000 1px solid;">&nbsp;</td>
                              </tr>
                           </table>
                        </td>
                        <td width="25%" height="15%">
                           <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" class="sl_text">
                              <tr>
                                 <td valign="top" style="border-left:#000000 1px solid;border-right:#000000 1px solid;border-top:#000000 1px solid;">&nbsp;</td>
                              </tr>
                           </table>
                        </td>
                        <td width="25%" height="15%">
                           <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" class="sl_text">
                              <tr>
                                 <td valign="top" style="border-left:#000000 1px solid;border-right:#000000 1px solid;border-top:#000000 1px solid;">&nbsp;</td>
                              </tr>
                           </table>
                        </td>
                        <td width="25%" height="15%">
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
            <tr>
               <td colspan="4">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                     <tr>
                        <td width="50%" align="center" valign="top">
                           <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                              <tr align="center" valign="top">
                                 <td width="25%"  >     <a href="javascript:gofunc('2104','279644','L')"></a>
                                 </td>
                                 <td width="25%" >                                      <a href="javascript:gofunc('2104','279644','R')"></a>
                                 </td>
                                 <td width="25%" >                                      <a href="javascript:gofunc('2099','682287','L')"></a>
                                 </td>
                                 <td width="25%" >                                      <a href="javascript:gofunc('2099','682287','R')"></a>
                                 </td>
                              </tr>
                           </table>
                        </td>
                        <td width="50%" align="center" valign="top">
                           <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                              <tr align="center" valign="top">
                                 <td width="25%"  >                                    <a href="javascript:showMember('1199')" class="tt"><span class="tooltip"><span class="top"></span><span class="middle">
                                    </span><span class="bottom"></span></span></a> <br />
                                    123456<br>RENUKABEN MUKESHBHAI PATEL                                     
                                 </td>
                                 <td width="25%" >                                      <a href="javascript:showMember('1194')" class="tt"><span class="tooltip"><span class="top"></span><span class="middle">
                                    </span><span class="bottom"></span></span></a> <br />
                                    229697<br>MUKESHBHAI ISHWARLAL PATEL                                       
                                 </td>
                                 <td width="25%" >                                      <a href="javascript:gofunc('2089','460648','L')">R</a>
                                 </td>
                                 <td width="25%" >                                      <a href="javascript:gofunc('2089','460648','R')">L</a>
                                 </td>
                              </tr>
                           </table>
                        </td>
                     </tr>
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
   <tr>
      <td colspan="8" align="center" valign="top">&nbsp;</td>
   </tr>
   <tr>
      <td colspan="8" align="center" valign="top">
         </p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
      </td>
   </tr>
</table>
</form></td>
</tr>
</table></td>
</tr>
</table>

    </div>
  </div>
