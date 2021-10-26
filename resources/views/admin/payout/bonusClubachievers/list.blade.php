@extends('layouts.admin')
@section('title','Bonus Club Payout')
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

       
          <!-- /.box-header -->
			@if(Session::has('message'))
			<div class="alert alert-success">
					<p>{{Session::get('message') }}</p>
			</div>
			@endif
            <div class="box-body dataRow">
              <input type="date" name="date" value="{{$date}}"  class="form-control" onchange=" window.location.href = '?date='+$(this).val()">
              <form action="/admin/achiever/bonus-club/processPayment" method="POST"> 
                      @csrf
              <table id="example1" class="table table-bordered table-striped">
              <thead>
                  <tr>
                  <th>#</th>
                  <th>Club</th>
                  <th>Sales</th>
                  <th>Per ID cost</th>
                  <th>Set Manual Cost</th>
                  <th>Turnover</th>
                  <th>Achievers</th>
                  <th>Distribution / ID</th>
                  <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($achievers as $key=> $achiever)
                  @php $achievers =  count($achiever->bonusClub->usersfromBounusClub); @endphp 
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$achiever->bonusClub->name}}</td>
                    <td> <span class="sell{{$key}}">{{$sell}}</span></td>
                    <td><span class="persellAmount{{$key}}">{{$achiever->bonusClub->per_id_cost}}</span></td>
                    <td>
                      <input type="hidden" name="bonus_club_id[]" value="{{$achiever->bonus_club_id}}">
                      <input type="hidden" name="sell[]" value="{{$sell}}">
                      <input type="hidden" name="date[]" value="{{$date}}">
                   
                      <input type="hidden" name="achievers[]" value="{{$achievers}}">
                      <input type="hidden" data-key-id="{{$key}}" name="perIDAcutalCost[]" value="{{$achiever->bonusClub->per_id_cost}}"  class="form-control">
                      <input type="text" data-key-id="{{$key}}" name="perIDCost[]" value="{{$achiever->bonusClub->per_id_cost}}"  class="form-control perIDCostManual">
                    </td>
                    <td><span class="currentTurnOver{{$key}}">{{$sell*200}}</span></td>
                    <td><span class="achievers{{$key}}">{{$achievers}}</span>
                     <a href="/admin/achiever/bonus-club/details/{{$achiever->bonus_club_id}}" class="btn btn-xs btn-info">View</a></td>
                    <td><span class="distributionPerID{{$key}}">@if($achievers){{$sell*200/$achievers}} @else 0 @endif</span></td>
                    <td>
                     
                      <a href="/admin/achiever/bonus-club/history" class="btn btn-xs btn-info">History</a></td>
                  </tr>
                  @endforeach
              </tbody>
              </table>
                   <button type="submit" class="btn btn-xs btn-success">Pay</button>
                  </form>

          </div>
          
          </div>
        </section>
      </div>
  <!-- /.box-body -->
  @endsection