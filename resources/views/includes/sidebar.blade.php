<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{env('base_url')}}dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <b>@if(Auth::user()->club_id==1)
              Bronze
            @eleif(Auth::user()->club_id==2)
            @eleif(Auth::user()->club_id==3)
            @eleif(Auth::user()->club_id==4)
            @eleif(Auth::user()->club_id==5)
              No Club
            @else
            @endif

          </b>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="active treeview">
          <a href="/support/chat">
            <i class="fa fa-dashboard"></i> <span>Support</span>
          </a>
        </li>

       
        <li class="treeview">
            <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Pin Module</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/pin/add"><i class="fa fa-circle-o"></i>Generate Pin</a></li>
            <li><a href="/admin/pin/"><i class="fa fa-circle-o"></i>View Pin</a></li>
            <li><a href="/admin/pin/assign"><i class="fa fa-circle-o"></i>Transfer pin</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Pin Status</a></li>
          </ul>
        </li>


        <li class="treeview">
            <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Packages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i>Add</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>View</a></li>
          </ul>
        </li>


        <li class="treeview">
            <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Payment Module</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i>See Payment</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Stop Payment</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Release Payment</a></li>
          </ul>
        </li>

        <li class="treeview">
            <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Associates Module</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i>Add Associates</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>See Associates</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Tree View</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Block Associate</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Tag Achievers</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>HEW</a></li>
            <li><a href="/associatemodule/topuppending"><i class="fa fa-circle-o"></i>Top-up Pending</a></li>
            <li><a href="/associatemodule/invoicepending"><i class="fa fa-circle-o"></i>Invoice Pending</a></li>
          </ul>
        </li>
                <li class="treeview">
                    <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Report</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i>Sale report</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>Income report</a></li>
                  </ul>
                 </li>

                 <li class="treeview">
                    <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Gallery</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i>Images</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>Videos</a></li>
                  </ul>
                 </li>

        <li class="treeview">
          <a href="#">

            <i class="fa fa-files-o"></i>
            <span>PIN Module</span>
            <span class="pull-right-container">
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/pin/"><i class="fa fa-circle-o"></i> List</a></li>
            <li><a href="/admin/pin/add"><i class="fa fa-circle-o"></i> Add</a></li>
            <li><a href="/admin/pin/history"><i class="fa fa-circle-o"></i> History</a></li>

            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">12</small>
           
                <i class="fa fa-angle-left pull-right"></i>
            </span>
              
              

          </a>

                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i>Check</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>Send Message</a></li>
                  </ul>
        </li>


        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Testimonials</span>
          </a>
        </li>


        <li class="treeview">
            <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Documents</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i>Verify Uploads</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>Add Documents</a></li>

          </ul>
        </li>


        <li class="treeview">
            <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Dispatch Details</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i>New Entry</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i>History</a></li>
          </ul>
        </li>





      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>