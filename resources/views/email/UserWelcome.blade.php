@extends('layouts.email')
@section('content')
<p>Hello {{$data->name}} ,</p>


<br>
<strong><u>User Details</u></strong><br>
Link: <a href="http://www.pay4ad.com/login" target="_blank" title="Click Here">Click Here</a><br>
User Key: {{$data->user_key}}<br>
Password : {{$password}}</p>
Transaction password : {{$transaction_password}}</p>
@endsection