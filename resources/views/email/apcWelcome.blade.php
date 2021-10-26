@extends('layouts.email')
@section('content')
<p>Hello {{$data->name}} </p>

<p><strong>Welcome </strong>&nbsp;to the digital world of Adyug, we are happy to find you there.

<br>
<strong><u>User Details</u></strong><br>
Link: <a href="http://www.pay4ad.com/apc/login" target="_blank" title="Click Here">Click Here</a><br>
User Key: {{$data->apc_key}}<br>
Password : {{$password}}</p>
@endsection