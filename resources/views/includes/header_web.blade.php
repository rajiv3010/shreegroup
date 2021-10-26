<!DOCTYPE html>
<html lang="en">
<head>

	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-79848138-14"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-79848138-14');
</script>

<title>TDM</title>

<link rel="stylesheet" href="{{env('base_url')}}web/css/bootstrap.min.css"><!-- bootstrap-CSS -->
<link rel="stylesheet" href="{{env('base_url')}}web/css/bootstrap-select.css"><!-- bootstrap-select-CSS -->
<link href="{{env('base_url')}}web/css/style.css" rel="stylesheet" type="text/css" media="all" /><!-- style.css -->
<link rel="stylesheet" href="{{env('base_url')}}web/css/font-awesome.min.css" /><!-- fontawesome-CSS -->
<link rel="stylesheet" href="{{env('base_url')}}web/css/menu_sideslide.css" type="text/css" media="all"><!-- Navigation-CSS -->
<link rel="stylesheet" type="text/css" href="{{env('base_url')}}web/css/jquery-ui1.css">
<link rel="stylesheet" href="{{env('base_url')}}web/css/flexslider.css" type="text/css" media="screen" /><!-- flexslider-CSS -->
<!-- meta tags -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Resale Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //meta tags -->
<!--fonts-->
<link href='//fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!--//fonts-->	
<!-- js -->
<script type="text/javascript" src="web/js/jquery.min.js"></script>
<!-- js -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{env('base_url')}}web/js/bootstrap.js"></script>
<script src="{{env('base_url')}}web/js/bootstrap-select.js"></script>
<script>
  $(document).ready(function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
  });
</script>
<!-- language-select -->
<script type="text/javascript" src="web/js/jquery.leanModal.min.js"></script>
<link href="{{env('base_url')}}web/css/jquery.uls.css" rel="stylesheet"/>
<link href="{{env('base_url')}}web/css/jquery.uls.grid.css" rel="stylesheet"/>
<link href="{{env('base_url')}}web/css/jquery.uls.lcd.css" rel="stylesheet"/>
<!-- Source -->
<script src="{{env('base_url')}}web/js/jquery.uls.data.js"></script>
<script src="{{env('base_url')}}web/js/jquery.uls.data.utils.js"></script>
<script src="{{env('base_url')}}web/js/jquery.uls.lcd.js"></script>
<script src="{{env('base_url')}}web/js/jquery.uls.languagefilter.js"></script>
<script src="{{env('base_url')}}web/js/jquery.uls.regionfilter.js"></script>
<script src="{{env('base_url')}}web/js/jquery.uls.core.js"></script>
<script>
			$( document ).ready( function() {
				$( '.uls-trigger' ).uls( {
					onSelect : function( language ) {
						var languageName = $.uls.data.getAutonym( language );
						$( '.uls-trigger' ).text( languageName );
					},
					quickList: ['en', 'hi', 'he', 'ml', 'ta', 'fr'] //FIXME
				} );
			} );
		</script>

<!-- //language-select -->
<!-- switcher-grid and list alignment -->
<script src="web/js/tabs.js"></script>	
<script type="text/javascript">
$(document).ready(function () {    
var elem=$('#container ul');      
	$('#viewcontrols a').on('click',function(e) {
		if ($(this).hasClass('gridview')) {
			elem.fadeOut(1000, function () {
				$('#container ul').removeClass('list').addClass('grid');
				$('#viewcontrols').removeClass('view-controls-list').addClass('view-controls-grid');
				$('#viewcontrols .gridview').addClass('active');
				$('#viewcontrols .listview').removeClass('active');
				elem.fadeIn(1000);
			});						
		}
		else if($(this).hasClass('listview')) {
			elem.fadeOut(1000, function () {
				$('#container ul').removeClass('grid').addClass('list');
				$('#viewcontrols').removeClass('view-controls-grid').addClass('view-controls-list');
				$('#viewcontrols .gridview').removeClass('active');
				$('#viewcontrols .listview').addClass('active');
				elem.fadeIn(1000);
			});									
		}
	});
});
</script>
<!-- //switcher-grid and list alignment -->
</head>

<body>	
	<!-- Navigation -->
		<div class="agiletopbar">
			<div class="wthreenavigation">
				<div class="menu-wrap">
				<nav class="menu">
					<div class="icon-list">
						<a href="mobiles.html"><i class="fa fa-fw fa-mobile"></i><span>Mobiles</span></a>
						<a href="electronics-appliances.html"><i class="fa fa-fw fa-laptop"></i><span>Electronics and appliances</span></a>
						<a href="cars.html"><i class="fa fa-fw fa-car"></i><span>Cars</span></a>
						<a href="bikes.html"><i class="fa fa-fw fa-motorcycle"></i><span>Bikes</span></a>
						<a href="furnitures.html"><i class="fa fa-fw fa-wheelchair"></i><span>Furnitures</span></a>
						<a href="pets.html"><i class="fa fa-fw fa-paw"></i><span>Pets</span></a>
						<a href="books-sports-hobbies.html"><i class="fa fa-fw fa-book"></i><span>Books, Sports & Hobbies</span></a>
						<a href="fashion.html"><i class="fa fa-fw fa-asterisk"></i><span>Fashion</span></a>
						<a href="kids.html"><i class="fa fa-fw fa-asterisk"></i><span>Kids</span></a>
						<a href="services.html"><i class="fa fa-fw fa-shield"></i><span>Services</span></a>
						<a href="jobs.html"><i class="fa fa-fw fa-at"></i><span>Jobs</span></a>
						<a href="real-estate.html"><i class="fa fa-fw fa-home"></i><span>Real Estate</span></a>
					</div>
				</nav>
				<button class="close-button" id="close-button">Close Menu</button>
			</div>
			<button class="menu-button" id="open-button"> </button>
			</div>
			<div class="clearfix"></div>
		</div>
		<!-- //Navigation -->
	<!-- header -->
	<header>
		<div class="w3ls-header"><!--header-one--> 
			<div class="w3ls-header-left">
				<p><a href="mobileapp.html"><i class="fa fa-download" aria-hidden="true"></i>Download Mobile App </a></p>
			</div>
			<div class="w3ls-header-right">
				<ul>
					<li class="dropdown head-dpdn">
						<a href="/login" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> Sign In</a>
					</li>
					<li class="dropdown head-dpdn">
						<a href="help.html"><i class="fa fa-question-circle" aria-hidden="true"></i> Help</a>
					</li>
					<li class="dropdown head-dpdn">
						<a href="#"><span class="active uls-trigger"><i class="fa fa-language" aria-hidden="true"></i>languages</span></a>
					</li>
					<li class="dropdown head-dpdn">
						<div class="header-right">			
	<!-- Large modal -->
			<div class="selectregion">
				<button class="btn btn-primary" data-toggle="modal" data-target="#myModal">
				<i class="fa fa-globe" aria-hidden="true"></i>Select City</button>
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
					aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										&times;</button>
									<h4 class="modal-title" id="myModalLabel">
										Please Choose Your Location</h4>
								</div>
								<div class="modal-body">
									 <form class="form-horizontal" action="#" method="get">
										<div class="form-group">
											<select id="basic2" class="show-tick form-control" multiple>
												<optgroup label="Popular Cities">
													<option selected style="display:none;color:#eee;">Select City</option>
													<option>Birmingham</option>
													<option>Anchorage</option>
													<option>Phoenix</option>
													<option>Little Rock</option>
												</optgroup>

												<optgroup label="More Cities">
													<optgroup label="Alabama">
														<option>Birmingham</option>
														<option>Montgomery</option>
														<option>Mobile</option>
														<option>Huntsville</option>
														<option>Tuscaloosa</option>
													</optgroup>
													<optgroup label="Alaska">
														<option>Anchorage</option>
														<option>Fairbanks</option>
														<option>Juneau</option>
														<option>Sitka</option>
														<option>Ketchikan</option>
													</optgroup>
													<optgroup label="New Hampshire">
														<option>Manchesters</option>
														<option>Nashua</option>
														<option>Concord</option>
														<option>Dover</option>
													</optgroup>
												</optgroup>
												
											</select>
										</div>
									  </form>    
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
					</li>
				</ul>
			</div>
			
			<div class="clearfix"> </div> 
		</div>
		<div class="container">
			<div class="agile-its-header">
				<div class="logo">
					<h1><a href="index.html"><span>Pay4</span>Add</a></h1>
				</div>
				<div class="agileits_search">
					<form action="#" method="post">
						<input name="Search" type="text" placeholder="How can we help you today?" required="" />
						<select id="agileinfo_search" name="agileinfo_search" required="">
							<option value="">All Categories</option>
							<option value="Mobiles">Mobiles</option>
							<option value="Electronics & Appliances">Electronics & Appliances</option>
							<option value="Cars">Cars</option>
							<option value="Bikes">Bikes</option>
							<option value="Furnitures">Furnitures</option>
							<option value="Books, Sports & Hobbies">Books, Sports & Hobbies</option>
							<option value="Fashion">Fashion</option>
							<option value="Kids">Kids</option>
							<option value="Services">Services</option>
							<option value="Jobs">Jobs</option>
							<option value="Real Estates">Real Estates</option>
						</select>
						<button type="submit" class="btn btn-default" aria-label="Left Align">
							<i class="fa fa-search" aria-hidden="true"> </i>
						</button>
					</form>
				<a class="post-w3layouts-ad" href="post-ad.html">Post Free Ad</a>
				</div>	
				<div class="clearfix"></div>
			</div>
		</div>
	</header>
	<!-- //header -->