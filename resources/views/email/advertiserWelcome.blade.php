@extends('layouts.email')
@section('content')

<p>Hello {{$data['name']}}.</p>

<p><strong>Welcome,</strong>&nbsp;to the digital world of Adyug, we are happy to find you there with your Business <strong>{{$data['company_name']}}</strong>.<br>

<strong><u>Login Details</u></strong><br>
Link: <a href="http://www.adyug.com/advertiser?name={{$data['company_name']}}&auth_token={{base64_encode($data['company_name'])}}&access_key='{{base64_encode($data['name'])}}'" target="_blank" title="Click Here">Click Here</a><br>
User Name: {{$data['email']}}<br>
Password : {{$password}}</p>
 @endsection