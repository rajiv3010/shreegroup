<div class="navbar-custom-menu">
  <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
<li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-inr fa-2x" aria-hidden="true" ></i>
              <span class="label label-danger" style="font-size: 13px">
                 {{$sum}}
            </span>
            </a>
            <ul class="dropdown-menu" style="width: 324px;">
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  @foreach($payouts as $key => $payout)
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                         {{$payout->businessarea->lable}}
                        <small class="pull-right " style=" color: {{$payout->businessarea->bg_color}}; font-weight: bolder; ; ">{{$payout->total}}</small>
                      </h3>
                    </a>
                  </li>
                    @endforeach
                </ul>
              </li>
            </ul>
          </li>
          <li class="dropdown messages-menu" style="display: none">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">{{count($messages)}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{count($messages)}} messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <!-- end message -->
                   @forelse ($messages as $msg)
                  <li><!-- start message -->
                    <a href="/{{$user_type}}/getmessage/{{$msg->id}}">
                      <div class="pull-left">
                          
                          <img src="{{$img}}"></div>
                      <h4>
                        {{$msg->category_name}}
                        <small><i class="fa fa-clock-o"></i> {{date ('d,M',strtotime($msg->created_at))}}</small>
                      </h4>
                      <p> {{$msg->message}}</p>
                    </a>

                  </li>

                  @empty
                  <li> <h4>
                       No new Message

                      </h4></li>
                  @endforelse
                </ul>
              </li>

            </ul>
          </li>
       


          <!-- Tasks: style can be found in dropdown.less -->
          
           <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu" >
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              {!! $img !!}
              <span class="hidden-xs">{{ $user_key  }}</span>
            </a>
            <ul class="dropdown-menu" >
              <!-- User image -->
              <li class="user-header" style="height: 103px;">
              {!! $img !!}
                <p>
                 {{ $user_name}} - {{ $user_key}}
                  <small>Member since {{ date('M,Y',strtotime($member_since)) }}</small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/profile" class="btn btn-success btn-flat" style="background-color: #00a65a;">Profile</a>
                </div>
                <div class="pull-right">

                  <a class="btn btn-danger btn-flat" href="{{ url('/logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();" style="
    background-color: #dd4b39;
">
                  <i class="mdi-action-lock-open"></i>  Sign out
                  </a>
                  <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                  </form>

                </div>
              </li>

            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
