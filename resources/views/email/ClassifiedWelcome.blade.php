@extends('layouts.email')
@section('content')
<p>Hello {{$data->first_name}} {{$data->last_name}}.</p>

<p><strong>Welcome,</strong>&nbsp;to the digital world of Adyug, we are happy to find you there with your Business <strong>{{$data->company_name}} - {{$data->customer_id}}</strong>.<br>
To Activate your account please complete your listing page with all the basic requirement<br>
1: Profile menu (all fields are mandatory to activate your account)<br>
2: Image gallery with at least&nbsp;6 full-size images of your business area.<br>
<br>
<strong><u>Admin Details</u></strong><br>
Link: <a href="{{env('adyug_wall')}}administrator/login" target="_blank" title="Click Here">Click Here</a><br>
Email: {{$data->email}}<br>
User Key: {{$data->customer_id}}<br>
Password : {{$password}}</p>
@endsection