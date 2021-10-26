
<!DOCTYPE html>
<html>
<head>
<title>TDM - Classifieds, Campaigns, Home Based Business, Software Development and Marketing</title>
<link href="{{env('base_url')}}TDM_index/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<style type="text/css">@import url("{{env('base_url')}}TDM_index/css/style.css");</style>
<link href="{{env('base_url')}}TDM_index/css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<script src="{{env('base_url')}}TDM_index/js/jquery.min.js"></script>
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="TDM serve you the platform where every business get the exposure you deserve and make your life easy. TDM is a digital AD network portal.">
<meta name="author" content="Ace Webmaster">
<meta name="keywords" content="Classifieds, Campaigns, Home Based Business, Software Development and Marketing, Multilevel Marketing" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,700,300,600,800,400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
  <!-- Light Box -->
    <link rel="stylesheet" href="{{env('base_url')}}TDM_index/css/swipebox.css">
    <script src="{{env('base_url')}}TDM_index/js/jquery.swipebox.min.js"></script> 
    <script type="text/javascript">
		jQuery(function($) {
			$(".swipebox").swipebox();
		});
	</script>
    <!--Eng Light Box -->	
	  <!-- Script for gallery Here -->
				<script type="text/javascript" src="{{env('base_url')}}TDM_index/js/jquery.mixitup.min.js"></script>
					<script type="text/javascript">
					$(function () {
						
						var filterList = {
						
							init: function () {
							
								// MixItUp plugin
								// http://mixitup.io
								$('#portfoliolist').mixitup({
									targetSelector: '.portfolio',
									filterSelector: '.filter',
									effects: ['fade'],
									easing: 'snap',
									// call the hover effect
									onMixEnd: filterList.hoverEffect()
								});				
							
							},
							
							hoverEffect: function () {
							
								// Simple parallax effect
								$('#portfoliolist .portfolio').hover(
									function () {
										$(this).find('.label').stop().animate({bottom: 0}, 200, 'easeOutQuad');
										$(this).find('img').stop().animate({top: -30}, 500, 'easeOutQuad');				
									},
									function () {
										$(this).find('.label').stop().animate({bottom: -40}, 200, 'easeInQuad');
										$(this).find('img').stop().animate({top: 0}, 300, 'easeOutQuad');								
									}		
								);				
							
							}
				
						};
						
						// Run the show!
						filterList.init();
						
						
					});	
					</script>
	<script type="text/javascript" src="{{env('base_url')}}TDM_index/js/move-top.js"></script>
	<script type="text/javascript" src="{{env('base_url')}}TDM_index/js/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
			});
		});
	</script>
<!---css-style-switecher-->
		<script type="text/javascript" src="{{env('base_url')}}TDM_index/js/jsapi"></script>
		<script>
		google.setOnLoadCallback(function()
			{
			    // Color changer
			    $(".colorblue").click(function(){
			        $("link").attr("href", "{{env('base_url')}}TDM_index/css/blue.css");
			        return false;
			    });
			    
			    $(".colorrose").click(function(){
			        $("link").attr("href", "{{env('base_url')}}TDM_index/css/rose.css");
			        return false;
			    });
			    
			    $(".colorgreen").click(function(){
			        $("link").attr("href", "{{env('base_url')}}TDM_index/css/green.css");
			        return false;
			    });
			
			});
		</script>
		<!--//End-css-style-switecher-->
</head>
<body>
	<!-- header-section-starts -->
	<div class="header" id="home">
		<div class="container">
			<div class="header-top">
				<div class="logo">
					<a href="/">
						<img src="{{env('base_url')}}images/logo.png">
					</a>
				</div>
				<div class="top-menu">
				<span class="menu"> </span>
					<ul>

						<li><a class="active scroll" href="#home">Home</a></li>
						<li><a class="scroll" href="#about">About</a></li>
						<li><a class="scroll" href="#services">Services</a></li>
						<li><a class="scroll" href="#pricings">Pricing</a></li>
						<li><a href="/login">Login</a></li>
						<li><a class="scroll" href="#contact">Contact</a></li>
					</ul>
				</div>
						<!-- script-for-menu -->
						<script>
							$("span.menu").click(function(){
								$(".top-menu ul").slideToggle("slow" , function(){
								});   
							});
						</script>
						<!-- script-for-menu -->
				<div class="clearfix"></div>
			</div>

			<div class="header-info text-center">


				<h1>WHAT IS TDM ? 
				</h1>
				<p>TDM serve you the platform where every business get the exposure you deserve and make your life easy. TDM is a digital AD network portal.</p>
				<a class="scroll" href="#services"><img src="{{env('base_url')}}TDM_index/images/go_down.png" alt="" /></a>
			</div>
		</div>
	</div>
	<div class="main-part">
		<div class="services-section" id="services">
			<div class="container">
				<div class="services-section-head text-center">
					<h3>SERVICES</h3>
				</div>
				<div class="services-section-grids">
					<div class="col-md-4 services-section-grid">
						<div class="services-section-grid-head">
							<div class="service-icon">
								<i class="needs"></i>
							</div>
							<div class="service-icon-heading">
								<h4>Classified</h4>
							</div>
							<div class="clearfix"></div>
						</div>
						<p>Classified ads are the place to look for finding a job, checking out garage sales and finding great deals on many miscellaneous items.  Search our classified database from all categories in India.  Classifieds – everyone’s marketplace!</p>
					</div>
					<div class="col-md-4 services-section-grid">
						<div class="services-section-grid-head">
							<div class="service-icon">
								<i class="needs"></i>
							</div>
							<div class="service-icon-heading">
								<h4>E Commerce</h4>
							</div>
							<div class="clearfix"></div>
						</div>
						<p>We provide a direct portal to our classified listers to maintain their products, they can sell to our huge crowd and promote the NAME to BRAND. </p>
					</div>
					<div class="col-md-4 services-section-grid">
						<div class="services-section-grid-head">
							<div class="service-icon">
								<i class="needs"></i>
							</div>
							<div class="service-icon-heading">
								<h4>Software development</h4>
							</div>
							<div class="clearfix"></div>
						</div>
						<p>Like attracts like, and every brand a consumer aligns with is a reflection of their own. With a thoughtful identity that unites everything from your logo to your web and app application, we help you become not just another purchase, but something to brag about. </p>
					</div>
					<div class="col-md-4 services-section-grid">
						<div class="services-section-grid-head">
							<div class="service-icon">
								<i class="needs"></i>
							</div>
							<div class="service-icon-heading">
								<h4>Home Based Business</h4>
							</div>
							<div class="clearfix"></div>
						</div>
						<p>A huge platform to any person working anywhere, you can earn a residual income just by doing what you are doing everytime, YES!! just use your mobile phone to work with us by becoming our affiliate and by using our all services. </p>
					</div>
					<div class="col-md-4 services-section-grid">
						<div class="services-section-grid-head">
							<div class="service-icon">
								<i class="needs"></i>
							</div>
							<div class="service-icon-heading">
								<h4>Campaigns</h4>
							</div>
							<div class="clearfix"></div>
						</div>
						<p>Our industry is moving toward a place where the most successful campaigns are highly targeted and measurable. Data allows us to not only optimize, but identify opportunities to create unexpected experiences for consumers. </p>
					</div>
					<div class="col-md-4 services-section-grid">
						<div class="services-section-grid-head">
							<div class="service-icon">
								<i class="needs"></i>
							</div>
							<div class="service-icon-heading">
								<h4>Social Media Management</h4>
							</div>
							<div class="clearfix"></div>
						</div>
						<p>Social media management is easy. The hard part? Finding a partner that can manage while being creative,
analytical, responsive, and strategic – all at once. We’ll help you create and share content while
identifying places. </p>
					</div>					
				<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<!-- projects -->


		<!-- projects -->
			<div class="about-section" id="about">
				<div class="about-top">
					<div class="container">
						<div class="col-md-3 about-grid text-center">
							<i class="volunteer"></i>
							<h5>+1000 volunteers</h5>
						</div>		
						<div class="col-md-3 about-grid text-center">
							<i class="projects"></i>
							<h5>+10 business areas</h5>
						</div>	
						<div class="col-md-3 about-grid text-center">
							<i class="idea"></i>
							<h5>+1000 campaigns</h5>
						</div>	
						<div class="col-md-3 about-grid text-center">
							<i class="volunteer"></i>
							<h5>+10 distributers</h5>
						</div>		
						<div class="clearfix"></div>	
					</div>
				</div>
				<!-- <div class="our-team">
					<div class="container">
						<div class="our-team-head text-center">
							<h3>OUR TEAM</h3>
						</div>
						<div class="our-team-grids">
							<div class="col-md-3 our-team-grid text-center">
								<img src="{{env('base_url')}}TDM_index/images/team_pic_1.JPG" alt="" />
								<h5>Name</h5>
								<p>Designation</p>
								<div class="abt_social_icons">
									<a href="#"><i class="abt_facebook"></i></a>
									<a href="#"><i class="abt_twitter"></i></a>
									<a href="#"><i class="abt_googlepluse"></i></a>
									<a href="#"><i class="abt_linkedin"></i></a>
								</div>
							</div>
							<div class="col-md-3 our-team-grid text-center">
								<img src="{{env('base_url')}}TDM_index/images/team_pic_2.JPG" alt="" />
								<h5>Name</h5>
								<p>Designation</p>
								<div class="abt_social_icons">
									<a href="#"><i class="abt_facebook"></i></a>
									<a href="#"><i class="abt_twitter"></i></a>
									<a href="#"><i class="abt_googlepluse"></i></a>
									<a href="#"><i class="abt_linkedin"></i></a>
								</div>
							</div>
							<div class="col-md-3 our-team-grid text-center">
								<img src="{{env('base_url')}}TDM_index/images/team_pic_3.JPG" alt="" />
								<h5>Name</h5>
								<p>Designation</p>
								<div class="abt_social_icons">
									<a href="#"><i class="abt_facebook"></i></a>
									<a href="#"><i class="abt_twitter"></i></a>
									<a href="#"><i class="abt_googlepluse"></i></a>
									<a href="#"><i class="abt_linkedin"></i></a>
								</div>
							</div>
							<div class="col-md-3 our-team-grid text-center">
								<img src="{{env('base_url')}}TDM_index/images/team_pic_4.JPG" alt="" />
								<h5>Name</h5>
								<p>Designation</p>
								<div class="abt_social_icons">
									<a href="#"><i class="abt_facebook"></i></a>
									<a href="#"><i class="abt_twitter"></i></a>
									<a href="#"><i class="abt_googlepluse"></i></a>
									<a href="#"><i class="abt_linkedin"></i></a>
								</div>
							</div>
							<div class="clearfix"></div>	
						</div>
					</div>
				</div> -->
			</div>
			<div class="subscribe text-center" >
				<div class="container">
					<h3>SUBSCRIBE TO OUR NEWSLETTER</h3>
					<input type="text" class="text" value="YOUR MAIL ADDRESS" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'YOUR MAIL ADDRESS';}">
					<input type="submit" value="Subscribe">
				</div>
			</div>
			<div class="pricing-section" id="pricings">
				<div class="container">
					<div class="pricing-section-head text-center">
						<h3>PRICE PLANS</h3>
					</div>
					<div class="pricing-section-grids">
						<div class="col-md-3 pricing-section-grid text-center">
							<div class="price">
								<h5>₹2000</h5>
							</div>
							<h4 class="change">TRAINING</h4>
							<p>0 PV</p>
							<p>0 Training Package</p>
							<p>2000 Classified Points</p>
							<p>10% Classified Income</p>
							<p>20% Direct Income</p>
							<a href="#">PURCHASE</a>
						</div>
						<div class="col-md-3 pricing-section-grid text-center">
							<div class="price">
								<h5>₹10000</h5>
							</div>
							<h4 class="change">REGULAR</h4>
							<p>10 PV</p>
							<p>5 Training Package</p>
							<p>10000 Classified Points</p>
							<p>20% Classified Income</p>
							<p>5% Direct Income</p>
							<a href="#">PURCHASE</a>
						</div>
						<div class="col-md-3 pricing-section-grid text-center">
							<div class="price">
								<h5>₹40000</h5>
							</div>
							<h4 class="change">PROFESSIONAL</h4>
							<p>40 PV</p>
							<p>20 Training Package</p>
							<p>40000 Classified Points</p>
							<p>20% Classified Income</p>
							<p>5% Direct Income</p>
							<a href="#">PURCHASE</a>
						</div>
						<div class="col-md-3 pricing-section-grid text-center">
							<div class="price">
								<h5>₹100000</h5>
							</div>
							<h4 class="change">ULTIMATE</h4>
							<p>100 PV</p>
							<p>50 Training Package</p>
							<p>100000 Classified Points</p>
							<p>20% Classified Income</p>
							<p>5 Direct Income</p>
							<a href="#">PURCHASE</a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<!-- <div class="clients">
				<div class="container">
					<ul>
						<li><a href="#"><img src="{{env('base_url')}}TDM_index/images/behance.jpg" alt="" /></a></li>
						<li><a href="#"><img src="{{env('base_url')}}TDM_index/images/drop.jpg" alt="" /></a></li>
						<li><a href="#"><img src="{{env('base_url')}}TDM_index/images/row.jpg" alt="" /></a></li>
						<li><a href="#"><img src="{{env('base_url')}}TDM_index/images/facebook.jpg" alt="" /></a></li>
						<li><a href="#"><img src="{{env('base_url')}}TDM_index/images/microsoft.jpg" alt="" /></a></li>
						<li><a href="#"><img src="{{env('base_url')}}TDM_index/images/dell.jpg" alt="" /></a></li>
					</ul>
				</div>
			</div> -->
			<!-- <div class="blog-section" id="blog">
				<div class="container">
					<div class="blog-section-head text-center">
						<h3>FROM OUR BLOG</h3>
					</div>
					<div class="blog-section-grids">
						<div class="col-md-4 blog-section-grid">
							<div class="date">
								<p>17</p>
								<p>MAY</p>
							</div>
							<img src="images/blog_pic_1.jpg" alt="" />
							<h4 class="text-center">First Blog Post Title</h4>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
							<a href="#">Read More</a>
						</div>
						<div class="col-md-4 blog-section-grid">
							<div class="date">
								<p>13</p>
								<p>MAY</p>
							</div>
							<img src="images/blog_pic_2.jpg" alt="" />
							<h4 class="text-center">Secound Blog Post Title</h4>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
							<a href="#">Read More</a>
						</div>
						<div class="col-md-4 blog-section-grid">
							<div class="date">
								<p>27</p>
								<p>MAR</p>
							</div>
							<img src="images/blog_pic_3.jpg" alt="" />
							<h4 class="text-center">Third Blog Post Title</h4>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
							<a href="#">Read More</a>
						</div>
						<div class="col-md-4 blog-section-grid">
							<div class="date">
								<p>20</p>
								<p>MAR</p>
							</div>
							<img src="images/blog_pic_4.jpg" alt="" />
							<h4 class="text-center">Fourth Blog Post Title</h4>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
							<a href="#">Read More</a>
						</div>
						<div class="col-md-4 blog-section-grid">
							<div class="date">
								<p>23</p>
								<p>FEb</p>
							</div>
							<img src="images/blog_pic_5.jpg" alt="" />
							<h4 class="text-center">Fifth Blog Post Title</h4>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
							<a href="#">Read More</a>
						</div>
						<div class="col-md-4 blog-section-grid">
							<div class="date">
								<p>30</p>
								<p>JAN</p>
							</div>
							<img src="images/blog_pic_6.jpg" alt="" />
							<h4 class="text-center">Sixth Blog Post Title</h4>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
							<a href="#">Read More</a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div> -->
			<div class="contact-section" id="contact">
				<div class="contact-section-head text-center">
					<h3>GET IN TOUCH</h3>
				</div>
				<div class="map">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d920.255330041993!2d75.86327982914652!3d22.690250236378695!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjLCsDQxJzI0LjkiTiA3NcKwNTEnNDkuOCJF!5e0!3m2!1sen!2sin!4v1514638357593" width="800" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				<div class="contact-form">
					<div class="container">
						<form>
							<input type="text" class="text" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}">
							<input type="text" class="text" value="E-Mail" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E-Mail';}">
							<textarea onfocus="if(this.value == 'Message:') this.value='';" onblur="if(this.value == '') this.value='Your Message';" >Message</textarea>
							<input type="submit" value="Submit">
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="footer">
			<!-- <div class="social-icons">
				<div class="container">
					<a href="#"><i class="f_facebook"></i></a>
					<a href="#"><i class="f_youtube"></i></a>
					<a href="#"><i class="f_linkedin"></i></a>
					<a href="#"><i class="f_pinterest"></i></a>
					<a href="#"><i class="f_behance"></i></a>
					<a href="#"><i class="f_googlepluse"></i></a>
					<a href="#"><i class="f_rss"></i></a>
					<a href="#"><i class="f_tumbler"></i></a>
					<a href="#"><i class="f_instagram"></i></a>
					<a href="#"><i class="f_dribble"></i></a>
					<a href="#"><i class="f_mail"></i></a>
				</div>
			</div> -->
			<div class="footer-top">
				<div class="container">
					<div class="col-md-4 col-sm-12 col-xs-12 footer-grid">
						<h4>About Us</h4>
						<p>TDM serve you the platform where every business get the exposure you deserve and make your life easy. TDM is a digital AD network portal..</p>
					</div>
					<div class="col-md-4  col-sm-12 col-xs-12  footer-grid">
						<h4>Useful Links</h4>
						<ul>
							<li><a href="https://adyug.com/faq" target="_blank">- FAQ</a></li>
							<li><a href="https://adyug.com/terms" target="_blank">- Terms of Use</a></li>
						</ul>
					</div>
					<div class="col-md-4  col-sm-12 col-xs-12  footer-grid">
						<h4>Contact Us</h4>
						<ul class="address">
							<li><i class="f_phone"></i></li>
							<li>+91 9977414999</li>
						</ul>
						<ul class="address">
							<li><i class="f_msg"></i></li>
							<li><a href="example@mail.com"> support@TDM.com</a></li>
						</ul>
						
					</div>
					<!-- <div class="col-md-3  col-sm-6 col-xs-6  footer-grid">
						<h4>Flicker</h4>
						<ul class="flkr">
							<li><img src="{{env('base_url')}}TDM_index/images/f1.jpg" alt=""/ ></li>
							<li><img src="{{env('base_url')}}TDM_index/images/f2.jpg" alt=""/ ></li>
							<li><img src="{{env('base_url')}}TDM_index/images/f3.jpg" alt=""/ ></li>
							<li><img src="{{env('base_url')}}TDM_index/images/f4.jpg" alt=""/ ></li>
							<li><img src="{{env('base_url')}}TDM_index/images/f5.jpg" alt=""/ ></li>
							<li><img src="{{env('base_url')}}TDM_index/images/f6.jpg" alt=""/ ></li>
							<li><img src="{{env('base_url')}}TDM_index/images/f7.jpg" alt=""/ ></li>
							<li><img src="{{env('base_url')}}TDM_index/images/f8.jpg" alt=""/ ></li>
							<li><img src="{{env('base_url')}}TDM_index/images/f9.jpg" alt=""/ ></li>
							<li><img src="{{env('base_url')}}TDM_index/images/f10.jpg" alt=""/ ></li>
							<li><img src="{{env('base_url')}}TDM_index/images/f11.jpg" alt=""/ ></li>
							<li><img src="{{env('base_url')}}TDM_index/images/f12.jpg" alt=""/ ></li>
						</ul>
					</div> -->
					<div class="clearfix"></div>
				</div>	
			</div>
			<div class="footer-bottom">
				<div class="container">
					<div class="copyright text-center">
						<p>Copyright &copy; 2018-2019 All rights reserved | By  <a href="http://adyug.com/" target="_blank">  Adyug Classify Pvt. Ltd.</a></p>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
						$(document).ready(function() {
							
							var defaults = {
					  			containerID: 'toTop', // fading element id
								containerHoverID: 'toTopHover', // fading element hover id
								scrollSpeed: 1200,
								easingType: 'linear' 
					 		};
							
							
							$().UItoTop({ easingType: 'easeOutQuart' });
							
						});
					</script>
				<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>

</body>
</html>