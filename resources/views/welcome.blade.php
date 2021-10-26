@extends('layouts.web')
@section('title','homepage')
@section('content')
 <!-- Content Wrapper. Contains page content -->

	
	<!-- Slider -->
		<div class="slider">
			<ul class="rslides" id="slider">
				<li>
					<div class="w3ls-slide-text">
						<h3>Sell or Advertise anything online</h3>
						<a href="categories.php" class="w3layouts-explore-all">Browse all Categories</a>
					</div>
				</li>
				<li>
					<div class="w3ls-slide-text">
						<h3>Find the Best Deals Here</h3>
						<a href="categories.php" class="w3layouts-explore">Explore</a>
					</div>
				</li>
				<li>
					<div class="w3ls-slide-text">
						<h3>Lets build the home of your dreams</h3>
						<a href="real-estate.html" class="w3layouts-explore">Explore</a>
					</div>
				</li>
				<li>
					<div class="w3ls-slide-text">
						<h3>Find your dream ride</h3>
						<a href="bikes.html" class="w3layouts-explore">Explore</a>
					</div>
				</li>
				<li>
					<div class="w3ls-slide-text">
						<h3>The Easiest Way to get a Job</h3>
						<a href="jobs.html" class="w3layouts-explore">Find a Job</a>
					</div>
				</li>
			</ul>
		</div>
		<!-- //Slider -->
		<!-- content-starts-here -->
		<div class="main-content">
			<div class="w3-categories">
				<h3>Browse Categories</h3>
				<div class="container">
					  @if(Session::has('message'))
                   <div class="alert alert-danger">
                     <p>{{Session::get('message') }}</p>
                    </div>
                    @endif
					@foreach($business_categories as $category)
					<div class="col-md-3">
						<div class="focus-grid w3layouts-boder1">
							<a class="btn-8" href="/category/{{ strtolower($category->name)}}">
								<div class="focus-border">
									<div class="focus-layout">
										<div class="focus-image"><i class="{{$category->image}}"></i></div>
										<h4 class="clrchg">{{$category->name}}</h4>
									</div>
								</div>
							</a>
						</div>
					</div>
					@endforeach
					<div class="clearfix"></div>
				</div>
			</div>
			<!-- most-popular-ads -->
			<div class="w3l-popular-ads">  
				<h3>Most Popular Ads</h3>
				 <div class="w3l-popular-ads-info">
					<div class="col-md-4 w3ls-portfolio-left">
						<div class="portfolio-img event-img">
							<img src="{{env('base_url')}}web/images/ad1.jpg" class="img-responsive" alt=""/>
							<div class="over-image"></div>
						</div>
						<div class="portfolio-description">
						   <h4><a href="cars.html">Latest Cars</a></h4>
						   <p>Suspendisse placerat mattis arcu nec por</p>
							<a href="cars.html">
								<span>Explore</span>
							</a>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="col-md-4 w3ls-portfolio-left">
						<div class="portfolio-img event-img">
							<img src="{{env('base_url')}}web/images/ad2.jpg" class="img-responsive" alt=""/>
							 <div class="over-image"></div>
						</div>
						<div class="portfolio-description">
						   <h4><a href="real-estate.html">Apartments for Sale</a></h4>
						   <p>Suspendisse placerat mattis arcu nec por</p>
							<a href="real-estate.html">
								<span>Explore</span>
							</a>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="col-md-4 w3ls-portfolio-left">
						<div class="portfolio-img event-img">
							<img src="{{env('base_url')}}web/images/ad3.jpg" class="img-responsive" alt=""/>
							 <div class="over-image"></div>
						</div>
						<div class="portfolio-description">
						   <h4><a href="jobs.html">BPO jobs</a></h4>
						   <p>Suspendisse placerat mattis arcu nec por</p>
							<a href="jobs.html">
								<span>Explore</span>
							</a>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="col-md-4 w3ls-portfolio-left">
						<div class="portfolio-img event-img">
							<img src="{{env('base_url')}}web/images/ad4.jpg" class="img-responsive" alt=""/>
							 <div class="over-image"></div>
						</div>
						<div class="portfolio-description">
						   <h4><a href="electronics-appliances.html">Accessories</a></h4>
						   <p>Suspendisse placerat mattis arcu nec por</p>
							<a href="electronics-appliances.html">
								<span>Explore</span>
							</a>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="col-md-4 w3ls-portfolio-left">
						<div class="portfolio-img event-img">
							<img src="{{env('base_url')}}web/images/ad5.jpg" class="img-responsive" alt=""/>
							 <div class="over-image"></div>
						</div>
						<div class="portfolio-description">
						   <h4><a href="furnitures.html">Home Appliances</a></h4>
						   <p>Suspendisse placerat mattis arcu nec por</p>
							<a href="furnitures.html">
								<span>Explore</span>
							</a>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="col-md-4 w3ls-portfolio-left">
						<div class="portfolio-img event-img">
							<img src="{{env('base_url')}}web/images/ad6.jpg" class="img-responsive" alt=""/>
							 <div class="over-image"></div>
						</div>
						<div class="portfolio-description">
						   <h4><a href="fashion.html">Clothing</a></h4>
						   <p>Suspendisse placerat mattis arcu nec por</p>
							<a href="fashion.html">
								<span>Explore</span>
							</a>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="clearfix"> </div>
				 </div>
			 </div>
			<!-- most-popular-ads -->									
			<div class="trending-ads">
				<div class="container">
				<!-- slider -->
				<div class="agile-trend-ads">
					<h2>Trending Ads</h2>
							<ul id="flexiselDemo3">
								<li>
									<div class="col-md-3 biseller-column">
										<a href="single.php">
											<img src="{{env('base_url')}}web/images/p1.jpg" alt="" />
											<span class="price">&#36; 450</span>
										</a> 
										<div class="w3-ad-info">
											<h5>There are many variations of passages</h5>
											<span>1 hour ago</span>
										</div>
									</div>
									<div class="col-md-3 biseller-column">
										<a href="single.php">
											<img src="{{env('base_url')}}web/images/p2.jpg" alt="" />
											<span class="price">&#36; 399</span>
										</a> 
										<div class="w3-ad-info">
											<h5>Lorem Ipsum is simply dummy</h5>
											<span>3 hour ago</span>
										</div>
									</div>
									<div class="col-md-3 biseller-column">
										<a href="single.php">
											<img src="{{env('base_url')}}web/images/p3.jpg" alt="" />
											<span class="price">&#36; 199</span>
										</a> 
										<div class="w3-ad-info">
											<h5>It is a long established fact that a reader</h5>
											<span>8 hour ago</span>
										</div>
									</div>
									<div class="col-md-3 biseller-column">
										<a href="single.php">
											<img src="{{env('base_url')}}web/images/p4.jpg" alt="" />
											<span class="price">&#36; 159</span>
										</a> 
										<div class="w3-ad-info">
											<h5>passage of Lorem Ipsum you need to be</h5>
											<span>19 hour ago</span>
										</div>
									</div>
								</li>
								<li>
									<div class="col-md-3 biseller-column">
										<a href="single.php">
											<img src="{{env('base_url')}}web/images/p5.jpg" alt="" />
											<span class="price">&#36; 1599</span>
										</a> 
										<div class="w3-ad-info">
											<h5>There are many variations of passages</h5>
											<span>1 hour ago</span>
										</div>
									</div>
									<div class="col-md-3 biseller-column">
										<a href="single.php">
											<img src="{{env('base_url')}}web/images/p6.jpg" alt="" />
											<span class="price">&#36; 1099</span>
										</a> 
										<div class="w3-ad-info">
											<h5>passage of Lorem Ipsum you need to be</h5>
											<span>1 day ago</span>
										</div>
									</div>
									<div class="col-md-3 biseller-column">
										<a href="single.php">
											<img src="{{env('base_url')}}web/images/p7.jpg" alt="" />
											<span class="price">&#36; 109</span>
										</a> 
										<div class="w3-ad-info">
											<h5>It is a long established fact that a reader</h5>
											<span>9 hour ago</span>
										</div>
									</div>
									<div class="col-md-3 biseller-column">
										<a href="single.php">
											<img src="{{env('base_url')}}web/images/p8.jpg" alt="" />
											<span class="price">&#36; 189</span>
										</a> 
										<div class="w3-ad-info">
											<h5>Lorem Ipsum is simply dummy</h5>
											<span>3 hour ago</span>
										</div>
									</div>
								</li>
								<li>
									<div class="col-md-3 biseller-column">
										<a href="single.php">
											<img src="{{env('base_url')}}web/images/p9.jpg" alt="" />
											<span class="price">&#36; 2599</span>
										</a> 
										<div class="w3-ad-info">
											<h5>Lorem Ipsum is simply dummy</h5>
											<span>3 hour ago</span>
										</div>
									</div>
									<div class="col-md-3 biseller-column">
										<a href="single.php">
											<img src="{{env('base_url')}}web/images/p10.jpg" alt="" />
											<span class="price">&#36; 3999</span>
										</a> 
										<div class="w3-ad-info">
											<h5>It is a long established fact that a reader</h5>
											<span>9 hour ago</span>
										</div>
									</div>
									<div class="col-md-3 biseller-column">
										<a href="single.php">
											<img src="{{env('base_url')}}web/images/p11.jpg" alt="" />
											<span class="price">&#36; 2699</span>
										</a> 
										<div class="w3-ad-info">
											<h5>passage of Lorem Ipsum you need to be</h5>
											<span>1 day ago</span>
										</div>
									</div>
									<div class="col-md-3 biseller-column">
										<a href="single.php">
											<img src="{{env('base_url')}}web/images/p12.jpg" alt="" />
											<span class="price">&#36; 899</span>
										</a> 
										<div class="w3-ad-info">
											<h5>There are many variations of passages</h5>
											<span>1 hour ago</span>
										</div>
									</div>
								</li>
						</ul>
					</div>   
			</div>
			<!-- //slider -->				
			</div>
			<!--partners-->
			<div class="w3layouts-partners">
				<h3>Our Partners</h3>
					<div class="container">
						<ul>
							<li><a href="#"><img class="img-responsive" src="{{env('base_url')}}web/images/p-1.png" alt=""></a></li>
							<li><a href="#"><img class="img-responsive" src="{{env('base_url')}}web/images/p-2.png" alt=""></a></li>
							<li><a href="#"><img class="img-responsive" src="{{env('base_url')}}web/images/p-3.png" alt=""></a></li>
							<li><a href="#"><img class="img-responsive" src="{{env('base_url')}}web/images/p-4.png" alt=""></a></li>
							<li><a href="#"><img class="img-responsive" src="{{env('base_url')}}web/images/p-5.png" alt=""></a></li>
							<li><a href="#"><img class="img-responsive" src="{{env('base_url')}}web/images/p-6.png" alt=""></a></li>
							<li><a href="#"><img class="img-responsive" src="{{env('base_url')}}web/images/p-7.png" alt=""></a></li>
							<li><a href="#"><img class="img-responsive" src="{{env('base_url')}}web/images/p-8.png" alt=""></a></li>
							<li><a href="#"><img class="img-responsive" src="{{env('base_url')}}web/images/p-9.png" alt=""></a></li>
							<li><a href="#"><img class="img-responsive" src="{{env('base_url')}}web/images/p-10.png" alt=""></a></li>	
						</ul>
					</div>
				</div>	
		<!--//partners-->	
		<!-- mobile app -->
			<div class="agile-info-mobile-app">
				<div class="container">
					<div class="col-md-5 w3-app-left">
						<a href="mobileapp.html"><img src="{{env('base_url')}}web/images/app.png" alt=""></a>
					</div>
					<div class="col-md-7 w3-app-right">
						<h3>Resale App is the <span>Easiest</span> way for Selling and buying second-hand goods</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam auctor Sed bibendum varius euismod. Integer eget turpis sit amet lorem rutrum ullamcorper sed sed dui. vestibulum odio at elementum. Suspendisse et condimentum nibh.</p>
						<div class="agileits-dwld-app">
							<h6>Download The App : 
								<a href="#"><i class="fa fa-apple"></i></a>
								<a href="#"><i class="fa fa-windows"></i></a>
								<a href="#"><i class="fa fa-android"></i></a>
							</h6>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<!-- //mobile app -->
		</div>
		
	


  
  @endsection