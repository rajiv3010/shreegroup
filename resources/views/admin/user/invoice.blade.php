
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<div style="float: left; width: 50%;">
<img src="logo.png" height="50" width="50" /><br>
Adyug Pvt Ltd.<br />
27, Vishnupuri<br />
Indore (Madhya Pradesh) <br />
</p>
<div>PAN No: AAWCS9402P</div>
<div>GSTIN: GST00012312AD87</div>
<div>WEBSITE: www.adyug.com</div>
<div>EMAIL: info@adyug.com</div>
<div>Phone No.: 0731-2877005</div>



<h2 align ="center"></h2>


<br />
</div>

<div style="float: right; width: 50%;">

<b>To,</b><br>
{{$user->name}}<br>
{{$user->address}} , {{$user->address1}}<br>
{{$user->city}}
 State: {{$user->state}}<br>
<br>
<div>Email ID: {{$user->email}}</div>
<div>Phone: {{$user->mobile}}</div>
<div>Invoice Date: {{$user->dob}}</div>
</div>
<br />
<table border="1" width="100%" cellpadding="0" cellspacing="0"> 
        
    <tr align="center">
    <th>Invoice Date</th>
    <th>User ID</th>
    <th>Reference ID</th>
    <th>PAN</th>
    </tr>
    <tr align="center">
        <td>{{$user->created_at}}</td>
        <td>{{$user->user_key}}</td>
        <td>{{$user->user_key}}</td>
        <td>{{$user->pan}}</td>
    </tr>
    </table>
    <br>
<table border="1" width="100%" cellpadding="0" cellspacing="0"> 
    <col width="60%"><col width="40%" />     
    <tr>
    <th>Particulars</th>
    <th>Amount</th>
    </tr>
    <tbody>
        <tr>
            <td>
                {{$user->package->name}}
            </td>   @php  $tax = $user->package->amount*18/100;
                          $newPackageAmount = $user->package->amount-$tax;

                     @endphp
            <td align="right"><i class="fa fa-inr" aria-hidden="true"></i>₹ {{$newPackageAmount}}</td>
        </tr>

        
         
                      <tr>
                    <td align="right"> GGST @ 18%</td>
                 
                    <td align="right">₹ {{$tax}}</td>
                </tr>

        
        <tr>
            <th align="right">Total</th>
            <td align="right">₹ {{$user->package->amount}}</td>
        
       
       
        </tr>     
            
    </tbody>
</table>
<br />

<div><b>For Adyug Pvt. Ltd.</b></div>
<br />
<br />
<div><p align="center">***This is a digital invoice hence signature not required. ***</p></div>
</body>
</html>