<section class="content-header">
      <h1>
          <span class="text-bold text-small"> @if($status==0) Pending @elseif($status==1) Accepted @elseif($status==2) Rejected @endif</span> - @yield('title') 

         <a href="/admin/user/seminar-leads?status=0" class="btn btn-xs btn-info">Seminar Leads </a>
<a href="/admin/user/follow-up-leads?status=0" class="btn btn-xs btn-info">Follow Up Leads </a>
<a href="/admin/user/visit-leads?status=0" class="btn btn-xs btn-info">Visit Leads </a>
<a href="/admin/user/digital-leads?status=0" class="btn btn-xs btn-info">Digital Leads </a>
      </h1>
      <ol class="breadcrumb">
         <li><a href="/admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">@yield('title')</li>
      </ol>
   </section>