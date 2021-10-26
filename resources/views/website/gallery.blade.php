@extends('layouts.website')
@section('title','Gallery')
@section('content')


			<!-- CONTENT -->
			<!-- Intro Section -->
			<section class="inner-intro  padding bg-img1 overlay-dark light-color">
				<div class="container">
					<div class="row title">
						<h1 data-title="@yield('title')"><span>@yield('title')</span></h1>
					</div>
				</div>
			</section>
			<!-- End Intro Section -->
			<!-- Work Section -->
			<section id="work" class="padding">
				<div class="container">
					
					<div class="row container-grid nf-col-3">
						@foreach($DashboardImage as $value)
						<div class="nf-item branding coffee spacing">
							<div class="item-box">
								<a> <img alt="{{env('company_name')}}" src="{{env('base_url')}}dashboard_image/{{$value->image}}" class="item-container"> </a>
								<div class="link-zoom">
									
									<a href="{{env('base_url')}}dashboard_image/{{$value->image}}" class="fancylight popup-btn" data-fancybox-group="light" > <i class="fa fa-search-plus"></i> </a>
								</div>
							</div>
						</div>
						@endforeach

						

					</div>

				</div>

			</section>
			<!--End Contact-->

@endsection