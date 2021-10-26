@extends('layouts.email')
@section('content')
<p>Hello {{$data->name}} </p>

<p><strong>Welcome </strong>&nbsp;to the digital world of Adyug, we are happy to find you there. <strong>{{$data->company_name}}</strong>.<br>

<br>
<strong><u>User Details</u></strong><br>
Link: <a href="http://www.pay4ad.com/dpc/login" target="_blank" title="Click Here">Click Here</a><br>
User Key: {{$data->dpc_key}}<br>
Password : {{$password}}</p>
@endsection