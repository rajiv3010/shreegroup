@extends('layouts.user')
@php $invoice_name  = Auth::user()->name.'| Welcome Letter'; @endphp
@section('title',$invoice_name)
@section('content')

<style type="text/css">
   p {
      color: #000;
   }

   h2 {
      color: #000;
   }
   h3 {
      color: #000;
   }
   h4 {
      color: #000;
   }
   
   
   
</style>
<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="page-title">
         <div class="title_left">
            <h3>Welcome Letter<small></small></h3>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="row">
         <div class="col-md-12">
            <div class="x_panel">
               <div class="x_content">
                  <section class="content invoice" id="prinInvoice">
                     <!-- title row -->
                     <!-- info row -->
                     <div class="row invoice-info" style="margin-top: 30px;">
                        <!-- /.col -->
                        <div class="col-sm-2 col-md-2 col-xl-2 col-lg-2" align="center" style="width: 30%">
                           <img src="{{env('company_logo')}}" width="70%">
                        </div>
                        <div class="col-sm-10 col-md-10 col-xl-10 col-lg-10 text-left" style="float: right; width: 70%">
                           <address>
                              <h3 style="color: #24580e"><b>{{env('company_name')}}</b></h3>
                              <b></b>
                              <br><b>Help Line No. : 18005722025, Email: {{env('company_email_support')}}, Web : {{env('company_website')}}</b>
                           </address>
                        </div>
                       
                        <!-- /.col -->
                     </div>
                     <hr style="border-bottom: 3px double black;">
                     <!-- /.row -->
                     <!-- Table row -->
                     <div class="row">
                        <div class="col-xs-12 table">

                           <h2>Dear, <b><span style="text-transform: uppercase;">{{ Auth::user()->name}}</span></b></h2>
                           <h2>Congratulation on your decision to join {{env('company_name')}}</h2>

                           <p>We are taking this honor and privilege to give you warm welcome from the core of the heart to be associated with the organization. We would like to take this opportunity to invite you to work with our organization by spreading its mission & vision across the world.</p>

                           <p>We are genuinely interested in recruiting candidates from diverse ethnic and cultural backgrounds to develop your network in this organization. We would appreciate it if you would promote & publish our Business system by informing any persons who might be interested in a new opportunity.</p>

                           <p>I trust that you mutually excited about your new opportunity with {{env('company_name')}}. Our organization includes seminars, conferences, professional development, social gatherings which will develop your personality, skills, attitude, vision, etc...</p>

                           <p>{{env('company_name')}} will be taking initiative for those people of society who are helpless and needy for development of the nation. Our main motto is to provide you such an environment that makes you economically, socially & spiritually active.</p>

                           <p>We hope that you will get joy, peace & happiness with your involvement in the {{env('company_name')}} Family</p>

                           <b style="color: #000; text-decoration: underline;">"The journey of a thousand miles starts with a single step. Everything you want also wants you. But you have to take action to get it. So, successful people keep moving. They make mistakes, but they don't quit. Though no one can go back and make a brand new start, anyone can start from now and make a brand new ending." </b>

                           <br>


                           <br>
                           <h4>Regards,</h4>
                           <h4><b>{{env('company_name')}} Family</b></h4>
                        </div>
                        <!-- /.col -->
                     </div>
                     <!-- /.row -->
                     
                     <!-- /.row -->
                    
                    
                     <!-- div for ivoice -->
                     <!-- this row will not appear when printing -->
                  </section>
                  <div class="row no-print">
                     <div class="col-xs-6">
                        <button class="btn btn-default" onclick="printDiv('prinInvoice')">
                        <i class="fa fa-print"></i> Print</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   function printDiv(divName) {
   var printContents = document.getElementById(divName).innerHTML;
   var originalContents = document.body.innerHTML;
   document.body.innerHTML = printContents;
   window.print();
   document.body.innerHTML = originalContents;
   }
</script>
@endsection