@extends('layouts.website')
@section('title','Home')
@section('content')



      <section id="slider" class="slider-element slider-parallax swiper_wrapper min-vh-60 min-vh-md-100 include-header include-topbar">
         <div class="slider-inner">

            <div class="fslider h-100 position-absolute" data-speed="3000" data-pause="7500" data-animation="fade" data-arrows="false" data-pagi="false" style="background-color: #333;">
               <div class="flexslider">
                  <div class="slider-wrap">
                     <div class="slide" style="background: url('{{env('base_url')}}front/travel/images/slider/1.jpg') center center; background-size: cover;"></div>
                     <div class="slide" style="background: url('{{env('base_url')}}front/travel/images/slider/2.jpg') center center; background-size: cover;"></div>
                     <div class="slide" style="background: url('{{env('base_url')}}front/travel/images/slider/3.jpg') center center; background-size: cover;"></div>
                  </div>
               </div>
            </div>

          

         </div>
      </section>

      <!-- Content
      ============================================= -->
      <section id="content">
         <div class="content-wrap">

            <div class="section bottommargin-lg header-stick">
               <div class="container">

                  <div class="row mt-4 col-mb-30 mb-0">

                     

                     <div class="col-sm-6 col-lg-3 text-center text-sm-start">
                        <i class="i-plain color i-large icon-line2-key inline-block" style="margin-bottom: 15px;"></i>
                        <div class="heading-block border-bottom-0 mb-0">
                           <span class="before-heading">Over 15000+ Places.</span>
                           <h4>Get Hotel Deals</h4>
                        </div>
                     </div>

                     <div class="col-sm-6 col-lg-3 text-center text-sm-start">
                        <i class="i-plain color i-large icon-line2-present inline-block" style="margin-bottom: 15px;"></i>
                        <div class="heading-block border-bottom-0 mb-0">
                           <span class="before-heading">Explore Destinations.</span>
                           <h4>Holiday Packages</h4>
                        </div>
                     </div>

                     <div class="col-sm-6 col-lg-3 text-center text-sm-start">
                        <i class="i-plain color i-large icon-line2-credit-card inline-block" style="margin-bottom: 15px;"></i>
                        <div class="heading-block border-bottom-0 mb-0">
                           <span class="before-heading">Discounts.</span>
                           <h4>Get Travels Offers</h4>
                        </div>
                     </div>

                     <div class="col-sm-6 col-lg-3 text-center text-sm-start">
                        <i class="i-plain color i-large icon-line2-earphones-alt inline-block" style="margin-bottom: 15px;"></i>
                        <div class="heading-block border-bottom-0 mb-0">
                           <span class="before-heading">Dedicated Helpline.</span>
                           <h4>{{env('company_phone2')}}</h4>
                        </div>
                     </div>

                  </div>

               </div>

            </div>

            <div class="container clearfix">

               <div class="heading-block center border-bottom-0">
                  <span class="before-heading color">What are you in the Mood for.?</span>
                  <h2>Tailor made Packages for you</h2>
               </div>

            </div>

            <div id="portfolio" class="portfolio row grid-container portfolio-overlay-open g-0">

               <article class="portfolio-item col-12 col-sm-6 col-md-4 col-lg-3 pf-media pf-icons">
                  <div class="grid-inner">
                     <div class="portfolio-image">
                        <a href="portfolio-single.html">
                           <img src="{{env('base_url')}}front/travel/images/packages/1.jpg" alt="Beach Activities">
                           <div class="bg-overlay">
                              <div class="bg-overlay-content dark flex-column">
                                 <div class="portfolio-desc py-0 text-center">
                                    <h3>Beach Activities</h3>
                                 </div>
                              </div>
                              <div class="bg-overlay-bg dark op-ts op-05" data-hover-animate="op-1" data-hover-animate-out="op-05"></div>
                           </div>
                        </a>
                     </div>
                  </div>
               </article>

               <article class="portfolio-item col-12 col-sm-6 col-md-4 col-lg-3 pf-illustrations">
                  <div class="grid-inner">
                     <div class="portfolio-image">
                        <a href="portfolio-single.html">
                           <img src="{{env('base_url')}}front/travel/images/packages/2.jpg" alt="Romantic Getaways">
                           <div class="bg-overlay">
                              <div class="bg-overlay-content dark flex-column">
                                 <div class="portfolio-desc py-0 text-center">
                                    <h3>Romantic Getaways</h3>
                                 </div>
                              </div>
                              <div class="bg-overlay-bg dark op-ts op-05" data-hover-animate="op-1" data-hover-animate-out="op-05"></div>
                           </div>
                        </a>
                     </div>
                  </div>
               </article>

               <article class="portfolio-item col-12 col-sm-6 col-md-4 col-lg-3 pf-graphics pf-uielements">
                  <div class="grid-inner">
                     <div class="portfolio-image">
                        <a href="#">
                           <img src="{{env('base_url')}}front/travel/images/packages/3.jpg" alt="Mountain Madness">
                           <div class="bg-overlay">
                              <div class="bg-overlay-content dark flex-column">
                                 <div class="portfolio-desc py-0 text-center">
                                    <h3>Mountain Madness</h3>
                                 </div>
                              </div>
                              <div class="bg-overlay-bg dark op-ts op-05" data-hover-animate="op-1" data-hover-animate-out="op-05"></div>
                           </div>
                        </a>
                     </div>
                  </div>
               </article>

               <article class="portfolio-item col-12 col-sm-6 col-md-4 col-lg-3 pf-icons pf-illustrations">
                  <div class="grid-inner">
                     <div class="portfolio-image">
                        <a href="portfolio-single.html">
                           <img src="{{env('base_url')}}front/travel/images/packages/4.jpg" alt="Active Explorer">
                           <div class="bg-overlay">
                              <div class="bg-overlay-content dark flex-column">
                                 <div class="portfolio-desc py-0 text-center">
                                    <h3>Active Explorer</h3>
                                 </div>
                              </div>
                              <div class="bg-overlay-bg dark op-ts op-05" data-hover-animate="op-1" data-hover-animate-out="op-05"></div>
                           </div>
                        </a>
                     </div>
                  </div>
               </article>

               <article class="portfolio-item col-12 col-sm-6 col-md-4 col-lg-3 pf-uielements pf-media">
                  <div class="grid-inner">
                     <div class="portfolio-image">
                        <a href="portfolio-single.html">
                           <img src="{{env('base_url')}}front/travel/images/packages/5.jpg" alt="Icy Challenge">
                           <div class="bg-overlay">
                              <div class="bg-overlay-content dark flex-column">
                                 <div class="portfolio-desc py-0 text-center">
                                    <h3>Icy Challenge</h3>
                                 </div>
                              </div>
                              <div class="bg-overlay-bg dark op-ts op-05" data-hover-animate="op-1" data-hover-animate-out="op-05"></div>
                           </div>
                        </a>
                     </div>
                  </div>
               </article>

               <article class="portfolio-item col-12 col-sm-6 col-md-4 col-lg-3 pf-graphics pf-illustrations">
                  <div class="grid-inner">
                     <div class="portfolio-image">
                        <a href="portfolio-single.html">
                           <img src="{{env('base_url')}}front/travel/images/packages/6.jpg" alt="Hill Trekking">
                           <div class="bg-overlay">
                              <div class="bg-overlay-content dark flex-column">
                                 <div class="portfolio-desc py-0 text-center">
                                    <h3>Hill Trekking</h3>
                                 </div>
                              </div>
                              <div class="bg-overlay-bg dark op-ts op-05" data-hover-animate="op-1" data-hover-animate-out="op-05"></div>
                           </div>
                        </a>
                     </div>
                  </div>
               </article>

               <article class="portfolio-item col-12 col-sm-6 col-md-4 col-lg-3 pf-uielements pf-icons">
                  <div class="grid-inner">
                     <div class="portfolio-image">
                        <a href="portfolio-single-video.html">
                           <img src="{{env('base_url')}}front/travel/images/packages/7.jpg" alt="Forest Camping">
                           <div class="bg-overlay">
                              <div class="bg-overlay-content dark flex-column">
                                 <div class="portfolio-desc py-0 text-center">
                                    <h3>Forest Camping</h3>
                                 </div>
                              </div>
                              <div class="bg-overlay-bg dark op-ts op-05" data-hover-animate="op-1" data-hover-animate-out="op-05"></div>
                           </div>
                        </a>
                     </div>
                  </div>
               </article>

               <article class="portfolio-item col-12 col-sm-6 col-md-4 col-lg-3 pf-graphics">
                  <div class="grid-inner">
                     <div class="portfolio-image">
                        <a href="portfolio-single.html">
                           <img src="{{env('base_url')}}front/travel/images/packages/8.jpg" alt="River Rafting">
                           <div class="bg-overlay">
                              <div class="bg-overlay-content dark flex-column">
                                 <div class="portfolio-desc py-0 text-center">
                                    <h3>River Rafting</h3>
                                 </div>
                              </div>
                              <div class="bg-overlay-bg dark op-ts op-05" data-hover-animate="op-1" data-hover-animate-out="op-05"></div>
                           </div>
                        </a>
                     </div>
                  </div>
               </article>

            </div>


            <a href="#" class="button button-full button-dark center bottommargin-lg">
               <div class="container clearfix">
                  Can't find your Favorite Package? <strong>Contact Now</strong> <i class="icon-caret-right" style="top:4px;"></i>
               </div>
            </a>

            <div class="container">

               <div class="heading-block center">
                  <h2>Your favorite place to stay</h2>
                  <span>Stay in Touch with the Latest Travel Trends.</span>
               </div>

               <div class="row posts-md col-mb-50">
                  <div class="entry col-md-6">
                     <div class="grid-inner row align-items-center">
                        <div class="col-lg-6">
                           <div class="entry-image mb-0">
                              <a href="#"><img src="{{env('base_url')}}front/travel/images/blog/1.jpg" alt="Paris"></a>
                           </div>
                        </div>
                        <div class="col-lg-6 mt-3 mt-lg-0">
                           <span class="before-heading">Sightseeing</span>
                           <div class="entry-title title-xs nott">
                              <h3><a href="#">Things to do in Bangkok for free</a></h3>
                           </div>
                           <div class="entry-meta">
                              <!-- <ul>
                                 <li><i class="icon-calendar3"></i> 16th July</li>
                                 <li><a href="#"><i class="icon-comments"></i> 05</a></li>
                              </ul> -->
                           </div>
                           <div class="entry-content">
                              <!-- <a href="#" class="more-link">Read more</a> -->
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="entry col-md-6">
                     <div class="grid-inner row align-items-center">
                        <div class="col-lg-6">
                           <div class="entry-image mb-0">
                              <a href="#"><img src="{{env('base_url')}}front/travel/images/blog/2.jpg" alt="Paris"></a>
                           </div>
                        </div>
                        <div class="col-lg-6 mt-3 mt-lg-0">
                           <span class="before-heading">Nightlife</span>
                           <div class="entry-title title-xs nott">
                              <h3><a href="#">Nightclubs to check out in Kuala Lumpur</a></h3>
                           </div>
                           <div class="entry-meta">
                              <!-- <ul>
                                 <li><i class="icon-calendar3"></i> 21th June</li>
                                 <li><a href="#"><i class="icon-comments"></i> 12</a></li>
                              </ul> -->
                           </div>
                           <div class="entry-content">
                              <!-- <a href="#" class="more-link">Read more</a> -->
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="entry col-md-6">
                     <div class="grid-inner row align-items-center">
                        <div class="col-lg-6">
                           <div class="entry-image mb-0">
                              <a href="#"><img src="{{env('base_url')}}front/travel/images/blog/3.jpg" alt="Paris"></a>
                           </div>
                        </div>
                        <div class="col-lg-6 mt-3 mt-lg-0">
                           <span class="before-heading">Hotels</span>
                           <div class="entry-title title-xs nott">
                              <h3><a href="#">Prague hotels for every kind of traveller</a></h3>
                           </div>
                           <div class="entry-meta">
                              <!-- <ul>
                                 <li><i class="icon-calendar3"></i> 02th March</li>
                                 <li><a href="#"><i class="icon-comments"></i> 39</a></li>
                              </ul> -->
                           </div>
                           <div class="entry-content">
                              <!-- <a href="#" class="more-link">Read more</a> -->
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="entry col-md-6">
                     <div class="grid-inner row align-items-center">
                        <div class="col-lg-6">
                           <div class="entry-image mb-0">
                              <a href="#"><img src="{{env('base_url')}}front/travel/images/blog/4.jpg" alt="Paris"></a>
                           </div>
                        </div>
                        <div class="col-lg-6 mt-3 mt-lg-0">
                           <span class="before-heading">Eating Out</span>
                           <div class="entry-title title-xs nott">
                              <h3><a href="#">Shanghai restaurants for the discerning diner</a></h3>
                           </div>
                           <div class="entry-meta">
                              <!-- <ul>
                                 <li><i class="icon-calendar3"></i> 11th February</li>
                                 <li><a href="#"><i class="icon-comments"></i> 11</a></li>
                              </ul> -->
                           </div>
                           <div class="entry-content">
                              <!-- <a href="#" class="more-link">Read more</a> -->
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>

            <div class="section topmargin-lg footer-stick">
               <div class="container center clearfix">

                  <div class="heading-block bottommargin-sm border-bottom-0">
                     <span class="before-heading color">Introduction of your favourite holiday planner.</span>
                     <h2>Start making your Travel Plans</h2>
                  </div>

                  <p class="lead">Shree Holidays & Trading Co. Ltd (SHT) is one of the upcoming multi-dimensional independent services company in India. With over 5 years of experience, focused on delivering expert services in Web Marketing, Direct Marketing and Technical support services for our Publishers and customers.</p>

                  <!-- <a href="#" class="button button-rounded button-reveal text-end button-xlarge topmargin-sm"><i class="icon-angle-right"></i><span>Create a Package</span></a> -->

               </div>
            </div>
         </div>
      </section><!-- #content end -->

@endsection