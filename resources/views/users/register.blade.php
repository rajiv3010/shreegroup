@extends('layouts.website')
@section('title','Home')
@section('content')
<!-- Slider
   ============================================= -->
<section id="slider" class="slider-element full-screen clearfix" style="background: url('{{env('company_bg')}}') center no-repeat; background-size: cover;" data-height-md="700">
   <img src="{{env('company_bg')}}" class="d-block d-md-none">
</section>
<!-- #slider end -->
<!-- Content
   ============================================= -->
<section id="content">
   <div class="content-wrap">
      <div class="container clearfix">
         <div class="col_one_third">
            <div class="feature-box fbox-plain">
               <div class="fbox-icon">
                  <a href="#"><i class="icon-realestate-my-house"></i></a>
               </div>
               <h3 class="t400">24x7 Water Smart meters</h3>
            </div>
         </div>
         <div class="col_one_third">
            <div class="feature-box fbox-plain">
               <div class="fbox-icon">
                  <a href="#"><i class="icon-realestate-hammer"></i></a>
               </div>
               <h3 class="t400">24x7 Electricity</h3>
            </div>
         </div>
         <div class="col_one_third col_last">
            <div class="feature-box fbox-plain">
               <div class="fbox-icon">
                  <a href="#"><i class="icon-realestate-garage"></i></a>
               </div>
               <h3 class="t400">100% rain water collection</h3>
            </div>
         </div>
         <div class="clear"></div>
         <div class="col_one_third">
            <div class="feature-box fbox-plain">
               <div class="fbox-icon">
                  <a href="#"><i class="icon-realestate-rent"></i></a>
               </div>
               <h3 class="t400">100% Recycle and reuse of waste water</h3>
            </div>
         </div>
         <div class="col_one_third">
            <div class="feature-box fbox-plain">
               <div class="fbox-icon">
                  <a href="#"><i class="icon-realestate-credit"></i></a>
               </div>
               <h3 class="t400">100% Domestic Waste Collection</h3>
            </div>
         </div>
         <div class="col_one_third col_last">
            <div class="feature-box fbox-plain">
               <div class="fbox-icon">
                  <a href="#"><i class="icon-realestate-doc"></i></a>
               </div>
               <h3 class="t400">100% waste collection, Maxium Recycling and Reuse</h3>
            </div>
         </div>
         <div class="clear"></div>
         <div class="line topmargin-sm bottommargin-lg"></div>
         <div style="position: relative;">
            <div class="heading-block nobottomborder">
               <h3>Featured Projects</h3>
            </div>
            <div>
               <p>{{env('company_name')}} offers an unique platform, a stable and ever evolving opportunity.Our objective is to evolve Real estate entrepreneurs. We serve a wide range of real estate through Sales Representatives & Distributors and expecting in return the smiling faces of our Valuable satisfied Customers. {{env('company_name')}} will always strive to meet customer satisfaction through providing wide range of products at lowest price, quality property. We do understand the requirements & needs of a customer and wish to go along with our valuable customers to serve the best.</p>
            </div>
            <!-- <a href="#" class="button button-small button-rounded button-border button-border-thin t500 nomargin" style="position: absolute; top: 7px; right: 0;">Check All</a> -->
            <div class="real-estate owl-carousel image-carousel carousel-widget bottommargin-lg" data-margin="10" data-nav="true" data-loop="true" data-pagi="false" data-items-xs="1" data-items-sm="1" data-items-md="2" data-items-lg="3" data-items-xl="3">
               <div class="oc-item">
                  <div class="real-estate-item">
                     <div class="real-estate-item-image">
                        <div class="badge badge-danger bgcolor-2">Smart Roads</div>
                        <a href="#">
                        <img src="{{env('base_url')}}front/theme/images/items/1.jpg" alt="Image 1">
                        </a>
                        <!-- <div class="real-estate-item-price">
                           $1.2m<span>Leasehold</span>
                           </div>
                           <div class="real-estate-item-info clearfix">
                           <a href="#"><i class="icon-line-stack-2"></i></a>
                           <a href="#"><i class="icon-line-heart"></i></a>
                           </div> -->
                     </div>
                  </div>
               </div>
               <div class="oc-item">
                  <div class="real-estate-item">
                     <div class="real-estate-item-image">
                        <div class="badge badge-success">Hi-Tech Buildings</div>
                        <a href="#">
                        <img src="{{env('base_url')}}front/theme/images/items/2.jpg" alt="Image 2">
                        </a>
                        <!-- <div class="real-estate-item-price">
                           $200,000<span>bi-annually</span>
                           </div>
                           <div class="real-estate-item-info clearfix">
                           <a href="#"><i class="icon-line-stack-2"></i></a>
                           <a href="#"><i class="icon-line-heart"></i></a>
                           </div> -->
                     </div>
                  </div>
               </div>
               <div class="oc-item">
                  <div class="real-estate-item">
                     <div class="real-estate-item-image">
                        <div class="badge badge-danger">International Airport</div>
                        <a href="#">
                        <img src="{{env('base_url')}}front/theme/images/items/4.jpg" alt="Image 3">
                        </a>
                        <!-- <div class="real-estate-item-price">
                           $1600<span>per month</span>
                           </div>
                           <div class="real-estate-item-info clearfix">
                           <a href="#"><i class="icon-line-stack-2"></i></a>
                           <a href="#"><i class="icon-line-heart"></i></a>
                           </div> -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="clear"></div>
         <div class="promo promo-dark promo-flat bottommargin-lg">
            <h3 class="t400 ls1">Special Offers on plot bookings &amp; Lease Agreements</h3>
            <a href="/login" class="button button-dark button-large button-rounded">Start Now</a>
         </div>
         <div class="section notopborder nomargin" style="background-color: #fff !important">
            <div class="container clearfix">
               <div class="col_two_fifth topmargin-sm nobottommargin" style="min-height: 350px">
                  <img src="https://www.dholera-smart-city.com/images/abt11.jpg">
               </div>
               <div class="col_three_fifth nobottommargin col_last">
                  <div class="heading-block topmargin-sm">
                     <h2>Guiding Principle</h2>
                     <span>Show off your Important Content with Elegance &amp; Attitude.</span>
                  </div>
                  <p>The real satisfaction of clients automatically generates Genuine Recommendations, and those Genuine Recommendations are but obviously the greatest medium of Promotion for any Business.</p>
                  <!-- <a href="#" class="button button-3d button-large">Check out</a> -->
               </div>
            </div>
         </div>
         <!-- <div class="heading-block nobottomborder">
            <h3>Project Guide</h3>
         </div>
         <div class="row real-estate-properties clearfix">
            <div class="col-lg-7">
               <a href="{{env('base_url')}}front/documents/vegas-city.pdf" target="_blank" style="background: url('{{env('base_url')}}front/theme/images/cities/4.jpg') no-repeat bottom center; background-size: cover;">
                  <h3 class="capitalize t500 badge badge-danger"><i class="icon-line-download"></i> Download Copy</h3>
               </a>
            </div>
            <div class="col-lg-5">
               <a href="{{env('base_url')}}front/documents/UNIT-PLAN-BUILDING-PLAN.pdf" target="_blank" style="background: url('{{env('base_url')}}front/theme/images/cities/2.jpg') no-repeat center center; background-size: cover;">
                  <h3 class="capitalize t500 badge badge-danger"><i class="icon-line-download"></i> Download Copy</h3>
               </a>
            </div>
           
         </div> -->
      </div>
      <div class="row norightmargin topmargin bottommargin-lg align-items-stretch">
         <div class="col-lg-5 d-none d-md-block"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14771.126841050524!2d72.18635752991933!3d22.248359615607686!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395f2451ff4100f9%3A0xaa2cd52f20110ead!2sDholera%2C%20Gujarat%20382455!5e0!3m2!1sen!2sin!4v1593510567118!5m2!1sen!2sin" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div>
         <div class="col-lg-3" style="background-color: #E5E5E5;">
            <div style="padding: 40px;">
               <h4 class="font-body t600 ls1">Our Headquarters</h4>
               <div style="font-size: 15px; line-height: 1.7;">
                  <address style="line-height: 1.7;">
                     <strong>Gujarat:</strong><br>
                     {{env('company_address1')}} {{env('company_address2')}}<br>
                     {{env('company_address3')}} {{env('company_pincode')}}.<br><br>
                     <abbr title="Phone Number"><strong>Phone:</strong></abbr> {{env('company_phone2')}}<br>
                     <abbr title="Email Address"><strong>Email:</strong></abbr> {{env('company_email_helpline')}}
                  </address>
                  <div class="clear topmargin-sm"></div>
                  <h4 class="font-body t500" style="font-size: 17px; margin-bottom: 10px;">Working Hours:</h4>
                  <abbr title="Mondays to Fridays"><strong>Mon-Fri:</strong></abbr> 10AM to 6PM<br>
                  <abbr title="Saturday"><strong>Saturday:</strong></abbr> 11AM to 3PM<br>
                  <abbr title="Sunday"><strong>Sunday:</strong></abbr> Closed
               </div>
            </div>
         </div>
         <div class="col-lg-4 bgcolor">
            <div class="col-padding">
               <div class="quick-contact-widget dark clearfix">
                  <h3 class="capitalize ls1 t400">Get a Quick Quote</h3>
                  @if(Session::has('message'))
                  <div class="form-result">
                     <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                  </div>
                  @endif
                  <form action="/submit" method="post" class="nobottommargin">
                     @csrf()
                     <div class="form-process"></div>
                     <input type="text" class="required sm-form-control input-block-level not-dark" id="name" name="name" value="" placeholder="Full Name" style="margin-bottom: 5px;" />
                     <input type="email" class="required sm-form-control email input-block-level not-dark" id="email" name="email" value="" placeholder="Email Address" style="margin-bottom: 5px;" />
                     <input type="text" class="required sm-form-control input-block-level not-dark" id="phone" name="phone" value="" placeholder="Phone Number " style="margin-bottom: 5px;" />
                     <textarea class="required sm-form-control input-block-level not-dark short-textarea" id="message" name="message" rows="5" cols="30" placeholder="What are you Looking for? " style="margin-bottom: 5px;"></textarea>
                     <!-- <input type="text" class="hidden" id="quick-contact-form-botcheck" name="quick-contact-form-botcheck" value="" />
                        <input type="hidden" name="prefix" value="quick-contact-form-"> -->
                     <button type="submit" class="button button-small button-rounded button-light button-white nomargin" value="submit">Send Message</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class="container clear-bottommargin clearfix">
         <div class="col_two_third">
            <div class="tabs tabs-justify tabs-tb tabs-alt nobottommargin clearfix" id="realestate-tabs" data-active="2">
               <ul class="tab-nav clearfix">
                  <li><a href="#realestate-tab-1">Why Us?</a></li>
                  <li><a href="#realestate-tab-2">Properties</a></li>
                  <li><a href="#realestate-tab-3">Legal</a></li>
               </ul>
               <div class="tab-container">
                  <div class="tab-content clearfix" id="realestate-tab-1">
                     <p>
                        {{env('company_name')}} is team of professionals having ability to transform dreams into reality. Our team is comprised of members who believe in “together we grow”. We look forward to serve our valuable customers with range of products to satisfy their day to days needs with varieties of brands to choose from.
                        <!-- <div class="col_one_fourth nobottommargin center">
                           <div class="counter ls1 t600" style="color: #D2D2D2;"><span data-from="100" data-to="964" data-refresh-interval="50" data-speed="2000"></span></div>
                           <h5>Floors Built</h5>
                           </div>
                           
                           <div class="col_one_fourth nobottommargin center">
                           <div class="counter ls1 t600" style="color: #D2D2D2;"><span data-from="100" data-to="8514" data-refresh-interval="50" data-speed="2500"></span></div>
                           <h5>Employees</h5>
                           </div>
                           
                           <div class="col_one_fourth nobottommargin center">
                           <div class="counter ls1 t600" style="color: #D2D2D2;"><span data-from="100" data-to="458" data-refresh-interval="50" data-speed="3500"></span></div>
                           <h5>Happy Clients</h5>
                           </div>
                           
                           <div class="col_one_fourth nobottommargin center col_last">
                           <div class="counter ls1 t600" style="color: #D2D2D2;"><span data-from="14" data-to="159" data-refresh-interval="15" data-speed="2700"></span></div>
                           <h5>Cities Served</h5>
                           </div> -->
                  </div>
                  <div class="tab-content clearfix" id="realestate-tab-2">
                     <p>Project is near to Pipli - Vataman highway</p>
                     <div class="row clearfix">
                        <div class="col-md-6">
                           <ul class="iconlist nobottommargin">
                              <li><i class="icon-ok"></i> Near to Dholera International Airport</li>
                              <li><i class="icon-ok"></i> Near to Pipli - Fedara GJ-HS 6</li>
                              <li><i class="icon-ok"></i> Near to 10 lane express way</li>
                              <li><i class="icon-ok"></i> Near to Metro Rail Connectivity</li>
                           </ul>
                        </div>
                        <div class="col-md-6">
                           <ul class="iconlist nobottommargin">
                              <li><i class="icon-ok"></i> Badminton Court</li>
                              <li><i class="icon-ok"></i> Attratctive Court</li>
                              <li><i class="icon-ok"></i> Senior Citizen Park</li>
                              <li><i class="icon-ok"></i> Club Room</li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="tab-content clearfix" id="realestate-tab-3">
                     <div class="clear-bottommargin-sm">
                        <div class="row clearfix">
                           <div class="col-md-7 bottommargin-sm">
                              <p>
                                 <a href="{{env('base_url')}}front/documents/Prasvegas-PAN.jpeg" target="_blank">PAN : {{env('company_pan')}} <i class="icon-line-download"></i></a><br>
                                 <a href="{{env('base_url')}}front/documents/Prasvegas-CIN.pdf" target="_blank">CIN : {{env('company_cin')}} <i class="icon-line-download"></i></a><br>
                                 <a href="{{env('base_url')}}front/documents/Prasvegas-GST.pdf" target="_blank">GST : {{env('company_gst')}} <i class="icon-line-download"></i></a><br>
                              </p>
                              <div class="clear-bottommargin-sm">
                                 <div class="row clearfix">
                                    <div class="col-md-6 bottommargin-sm">
                                       <address>
                                          <strong>Headquarters:</strong><br>
                                          {{env('company_address1')}} {{env('company_address2')}}<br>
                                          {{env('company_address3')}} {{env('company_pincode')}}<br>
                                       </address>
                                    </div>
                                    <div class="col-md-6 bottommargin-sm">
                                       <abbr title="Phone Number"><strong>Phone 1:</strong></abbr> {{env('company_phone1')}}<br>
                                       <abbr title="Email Address"><strong>Email:</strong></abbr> {{env('company_email_support')}}
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-5 bottommargin-sm">
                              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14771.126841050524!2d72.18635752991933!3d22.248359615607686!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395f2451ff4100f9%3A0xaa2cd52f20110ead!2sDholera%2C%20Gujarat%20382455!5e0!3m2!1sen!2sin!4v1593514491357!5m2!1sen!2sin" width="300" height="200" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col_one_third col_last">
            <h4 class="center">Top Builders</h4>
            <ul class="clients-grid grid-2 nobottommargin clearfix">
               <li style="padding: 20px;"><a href="#" style="opacity: 0.9"><img src="{{env('base_url')}}front/theme/images/builders/1.png" alt="Clients"></a></li>
               <li style="padding: 20px;"><a href="#" style="opacity: 0.9"><img src="{{env('base_url')}}front/theme/images/builders/2.png" alt="Clients"></a></li>
               <li style="padding: 20px;"><a href="#" style="opacity: 0.9"><img src="{{env('base_url')}}front/theme/images/builders/3.png" alt="Clients"></a></li>
               <li style="padding: 20px;"><a href="#" style="opacity: 0.9"><img src="{{env('base_url')}}front/theme/images/builders/4.png" alt="Clients"></a></li>
            </ul>
         </div>
         <div class="clear"></div>
      </div>
   </div>
</section>
<!-- #content end -->
@if(Session::has('message'))
<div class="modal-on-load" data-target="#myModal1"></div>
<!-- Modal -->
<div class="modal1 mfp-hide" id="myModal1">
   <div class="block divcenter" style="background-color: #FFF; max-width: 500px;">
      <div class="center" style="padding: 50px;">
         <h3>{{ Session::get('message') }}</h3>
      </div>
      <div class="section center nomargin" style="padding: 30px;">
         <a href="#" class="button" onClick="$.magnificPopup.close();return false;">Close</a>
      </div>
   </div>
</div>
@endif
@endsection