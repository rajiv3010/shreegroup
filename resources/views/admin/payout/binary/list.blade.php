    @extends('layouts.admin')
@section('title','Binary')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
 @yield('title')
  </h1>
  <ol class="breadcrumb">
  <li><a href="/admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">@yield('title')</li>
  </ol>
</section>
  <!-- Main content -->
  <section class="content">
      <!-- /.row 1 - small boxes -->
      <div class="box">
          <div class="box-header">
          <a href="/admin/admanagement/add" class="small-box-footer">
            <span class="pull-left-container">
                  <small class="label pull-left bg-green"><i class="fa fa-plus"></i> new</small>
            </span>
            </a>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive" >
          <table id="example1" class="table table-responsive table-bordered table-striped">
              <thead>
                  <tr>
                  <th>#</th>
                  <th>Category</th>
                  <th>Company</th>
                  <th>Offer Type</th>
                  <th>Offer ID</th>
                  <th>Offer Name</th>
                  <th>Link Type</th>
                  <th>Image</th>
                  <th>Link</th>
                  <th>Subject</th>
                  <th>Sender Name</th>
                  <th>Description</th>
                  <th>Point</th>
                  <th>Date</th>
                  <th>Expire</th>
                  </tr>
              </thead>
              <tbody>
                  @php $i = 1 @endphp
                  @foreach($advertisements as $advertisement)
                      <tr>
                      <td>{{$i}}</td>
                      <td>{{$advertisement->category}}</td>
                      <td>{{$advertisement->company}}</td>
                      <td>{{$advertisement->linkType->name}}</td>
                      <td>{{$advertisement->offer_id}}</td>
                      <td>{{$advertisement->offer_name}}</td>
                      <td>{{$advertisement->link_type}}</td>
                      <td>{{$advertisement->image}}</td>
                      <td><a target="_blank" href="{{$advertisement->link}}"> {{$advertisement->link}}  </a> </td>
                      <td>{{$advertisement->subject}}</td>
                      <td>{{$advertisement->sender_name}}</td>
                      <td>{{$advertisement->description}}</td>
                      <td>{{$advertisement->points}}</td>
                      <td>{{$advertisement->publisher_date}}</td>
                      <td>{{$advertisement->expiry_date}}</td>

                      </tr>
                  @php $i++ @endphp
                  @endforeach
              </tbody>
              </table>
          </div>
          
          </div>
        </section>
      </div>

  <!-- /.box-body -->
  @endsection