@extends('layouts.website')
@section('title','Download Section')
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
					<div class="row">
						<div class="col-sm-12">
							<div class="heading-box pb-30">
								<h2><span>Download</span> Contents</h2>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 pb-xs-30">
							<div class="text-content">
								<table class="table table-bordered">
									<thead>
										<tr style="background-color: #0c1f38">
										<th>#</th>
										<th>Title</th>
										<th>Document</th>
										</tr>
									</thead>
									<tbody>
										@foreach($downloads as $key=>$value)
										<tr>
											<td>{{$key+1}}</td>
											<td>{{$value->name}}</td>
											<td><a href="{{env('base_url')}}downloads/{{$value->file}}" target="_blank" class="btn btn-info">Download</a></td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

			</section>
			<!--End Contact-->

@endsection