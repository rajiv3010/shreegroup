<!DOCTYPE html>
<html lang="en">
  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
      <meta name="_token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        @php $invoice_name  = Auth::user()->name.'| invoice'; @endphp

        @section('title',$invoice_name)
    <title>moneymaker| @yield('title') </title>

<link rel="icon" type="image/png" href="{{env('base_url')}}assets/favicon.png">
  <!-- Bootstrap -->
    <link href="{{env('base_url')}}assets01/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{env('base_url')}}assets01/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{env('base_url')}}assets01/vendors/nprogress/nprogress.css" rel="stylesheet">
  
    <!-- Custom Theme Style -->
    <link href="{{env('base_url')}}assets01/build/css/custom.min.css" rel="stylesheet">

   

    <!-- Datatables -->
    <link href="{{env('base_url')}}assets01/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{env('base_url')}}assets01/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="{{env('base_url')}}assets01/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="{{env('base_url')}}assets01/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="{{env('base_url')}}assets01/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
      <link href="{{env('base_url')}}css/bootstrap-datepicker.min.css" rel="stylesheet">
      <link href="{{env('base_url')}}css/tree.css" rel="stylesheet">
   
<style type="text/css">
  #overlay{
    background-color: rgba(0, 0, 0, 0.8);
    z-index: 999;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    display: none;
}
</style>
    
  </head>

  <body>
    <div class="container body">
      <div class="main_container">

@section('content')
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            
            <div class="clearfix"></div>

            <div class="row">
              <div>
                <div class="x_panel">
                  
                  <div class="x_content">

                    <section class="content invoice" id="prinInvoice">
                      <!-- title row -->
                      <div class="row">
                     
                        <div class="col-xs-12 invoice-header">
                          <h1>
                                          <i class="fa fa-globe"></i> Invoice.
                                          <small class="pull-right">Date: {{date('d-M-Y',strtotime(Auth::user()->created_at))}}</small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div style="width: 33.33%; float: left;">
                          From
                          <address>
                                          <strong>{{env('company_name')}}</strong>
                                          <br>Phone: +91 0000000000
                                          <br>Email: help@moneymaker.co.in
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div style="width: 33.33%; float: left;">
                          To
                          <address>
                                          <strong class="text-capitalize">{{Auth::user()->name}}</strong>
                                          <br><span class="text-capitalize">{{Auth::user()->address1}}</span>
                                          <br><span class="text-capitalize">@if(isset(Auth::user()->city_name->name)) {{Auth::user()->city_name->name}},{{Auth::user()->state_name->name}}</span>
                                          @endif
                                          <br>Phone: +91 {{Auth::user()->mobile}}
                                          <br>Email: {{Auth::user()->email}}
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div style="width: 33.33%; float: left;">
                          <b>Tracking ID:</b> {{Auth::user()->user_key}}
                          <br>
                          <br>
                          
                          <b>Package:</b> ₹ {{Auth::user()->package->amount}}/-
                          <br>
                          <b>Sponsor ID:</b> {{Auth::user()->sponsor_key}}
                          <br>
                          <b>Sponsor Name:</b>
                            @if(isset(Auth::user()->SponsorDetails(Auth::user()->sponsor_key)->name))
                           {{Auth::user()->SponsorDetails(Auth::user()->sponsor_key)->name}}
                            @else
                            NA
                           @endif
                          <br>
                          <b>PAN:</b> {{Auth::user()->pan}}
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                      <!-- Table row -->
                      <div class="row">
                        <div class="table" style="width: 100%">

                                  {!! $PackageDescription->description !!}
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                      <div class="row">
                        <!-- accepted payments column -->
                        <div style="width: 50%; float: left;">
                          <p class="lead">PAYMENT TERMS AND POLICIES:</p>
                          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; font-size: 10px; overflow: hidden;">
                            Certified that I am atleast 18 years of age and have completed atleast 10th grade of schooling. I have received complete {{env('company_name')}}  Advanced Full Package online immediately after registration. I have carefully read terms & conditions as given on website help@moneymaker.co.in and agree to them. Currently I am not working with any other similar Business Operation. I am signing this DECLARATION with complete understanding and with my own WILL, without any PRESSURE / UNDUE INFLUENCE and INDUCEMENT. I am aware that any dispute arising out of this purchase would first be solved as per Terms and Conditions of the company, failing which could be addressed exclusively in competent courts in Ahmedabad only.
                          </p>
                        </div>
                        <!-- /.col -->
                        <div style="width: 50%; float: left;">
                          <p class="lead">Amount </p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Subtotal:</th>
                                  <td>₹ {{Auth::user()->package->amount}}/-</td>
                                </tr>
                                
                                <tr>
                                  <th>Shipping:</th>
                                  <td>₹ 0.00</td>
                                </tr>
                                <tr>
                                  <th>Total:</th>
                                  <td>₹ {{Auth::user()->package->amount}}/-</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row" style="border:2px solid #dddddd;">
                         <div style="border-right: 1px solid #dddddd; width: 50%; float: left;padding-left: 10px;" >
                            <p style="height:50px;">
                               Verified that the above information provided and the DECLARATION made by me is correct in all respects.
                            </p>
                            <p>
                              Signatures of Purchasing Associate
                            </p>
                         </div>
                         <div class="text-right" style="width: 50%; float: left; padding-right: 10px;">
                            <p style="height:50px;">
                               Verified that the signatures of the Purchasing Associate are authentic. 
                            </p>
                            <p>
                              Signatures of Selling Associate(Sponsor)
                            </p>
                         </div>
                         
                      </div>
                      <div class="row">
                         <div style="width: 100%; padding-left: 10px;">
                           <h5>Note:</h5>
                              <p>Purchasing and Selling Associates must keep a photo copy of this invoice for their own records. <br>
                              It is the responsibility of the Selling Associate to verify the age of Purchasing Associate and to provide us authentic signatures of the Purchasing Associate.<br>
                             Company will not be responsible if received invoice contains forged signatures of the Purchasing Associate. <br>
                             Please note that signing on behalf of somebody else is a serious offence.<br>
                             FOR PURCHASER: Write the given line below in your own hand-writing.<br>
                             <b>"I have read & understood all the terms & conditions & I accept it."</b><br>
                             Copyright © {{env('company_name')}} Group</p>
                           
                         </div>
                      </div>

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


      </div>
    </div>

    <!-- jQuery -->
    <script src="{{env('base_url')}}assets01/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{env('base_url')}}assets01/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="{{env('base_url')}}assets01/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="{{env('base_url')}}assets01/vendors/nprogress/nprogress.js"></script>
    
    <!-- jQuery Sparklines -->
    <script src="{{env('base_url')}}assets01/vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    
    
    <!-- DateJS -->
    <script src="{{env('base_url')}}assets01/vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{env('base_url')}}assets01/vendors/moment/min/moment.min.js"></script>
     <script src="{{env('base_url')}}js/bootstrap-datepicker.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{env('base_url')}}assets01/build/js/custom.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.21.1/dist/sweetalert2.all.js"></script>
    <script src="{{env('base_url')}}js/style.js"></script>
    <script src="{{env('base_url')}}js/jsform.js"></script>

   
    
    
    <!-- validator -->
    <script src="{{env('base_url')}}assets01/vendors/validator/validator.js"></script>

    <!-- Datatables -->
    <script src="{{env('base_url')}}assets01/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{env('base_url')}}assets01/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{env('base_url')}}assets01/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{env('base_url')}}assets01/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="{{env('base_url')}}assets01/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{env('base_url')}}assets01/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{env('base_url')}}assets01/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{env('base_url')}}assets01/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{env('base_url')}}assets01/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{env('base_url')}}assets01/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{env('base_url')}}assets01/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="{{env('base_url')}}assets01/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="{{env('base_url')}}assets01/vendors/jszip/dist/jszip.min.js"></script>
    <script src="{{env('base_url')}}assets01/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{env('base_url')}}assets01/vendors/pdfmake/build/vfs_fonts.js"></script>
      <script type="text/javascript">
    $('.dob').datepicker({
    format: 'yyyy-mm-dd',
    endDate: '-18y',
    autoclose: true,
    });
    $("form").submit(function(e){
        $("#overlay").show();
            swal({
            title: 'Please wait while processing your request',
            text: "Please don't refresh or back your page",
            allowOutsideClick: () => !swal.isLoading(),
            onOpen: () => {
            swal.showLoading()
            }
        }).then((result) => {
        if (
        // Read more about handling dismissals
        result.dismiss === swal.DismissReason.timer
        ) {
        console.log('I was closed by the timer')
        }
        })

    });
    </script>


  </body>
</html>