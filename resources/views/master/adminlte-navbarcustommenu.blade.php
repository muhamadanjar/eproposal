<div class="navbar-custom-menu">
    
    <ul class="nav navbar-nav">
    <li><a><div class="loader"></div></a></li>
    <!-- Messages: style can be found in dropdown.less-->
        <!--<li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                
                <ul class="menu">
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
        </li>-->
    <!-- Notifications: style can be found in dropdown.less -->
        <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              @if($current_user_unnotif->count()>0) <span class="label label-warning">{{$current_user_unnotif->count()}}</span> @endif
              
            </a>
            <ul class="dropdown-menu">
              <li class="header">Ada {{$current_user_unnotif->count()}} Pemberitahuan</li>
              <li>
                
                <ul class="menu">
                  @foreach ($current_user->notifications as $notification)
                    @if ($notification->type == 'App\Notifications\UsulanUpdated')
                      <li>
                        <a href="{{ url('proposal/usulan/lihat',array($notification->data['usulan_id'])) }}">
                          <div class="pull-left">
                            <i class="fa fa-user text-red"></i>
                          </div>
                          <h4>
                            {{$notification->data['user']['name']}}
                            <small><i class="fa fa-clock-o"></i> {{$notification->created_at->diffForHumans()}}</small>
                          </h4>
                          <p>Usulan di update</p>
                        </a>
                      </li>
                    @endif
                    @if ($notification->type == 'App\Notifications\UsulanAdd')
                      <li>
                        <a href="{{ url('proposal/usulan/lihat',array($notification->data['usulan_id'])) }}">
                          <div class="pull-left">
                            <i class="fa fa-user text-red"></i>
                          </div>
                          <h4>
                            {{$notification->data['user']['name']}}
                            <small><i class="fa fa-clock-o"></i> {{$notification->created_at->diffForHumans()}}</small>
                          </h4>
                          <p>Usulan {{$notification->data['usulan']['nama_proyek']}} telah Masuk</p>
                        </a>
                      </li>
                    @endif
                    @if ($notification->type == 'App\Notifications\UsulanTelahDiperiksa')
                      <li>
                        <a href="{{ url('proposal/usulan/lihat',array($notification->data['usulan_id'])) }}">
                          <div class="pull-left">
                            <i class="fa fa-user text-red"></i>
                          </div>
                          <h4>
                            {{$notification->data['user']['name']}}
                            <small><i class="fa fa-clock-o"></i> {{$notification->created_at->diffForHumans()}}</small>
                          </h4>
                          @if($notification->data['user']['id'] == auth()->user()->id)
                          <p>Usulan Anda Telah diperiksa</p>
                          @endif
                        </a>
                      </li>
                    @endif
                    @if ($notification->type == 'App\Notifications\UsulanVerifikasi')
                      <li>
                        <a href="{{ url('proposal/usulan/lihat',array($notification->data['usulan_id'])) }}">
                          <div class="pull-left">
                            <i class="fa fa-user text-red"></i>
                          </div>
                          <h4>
                            {{$notification->data['user']['name']}}
                            <small><i class="fa fa-clock-o"></i> {{$notification->created_at->diffForHumans()}}</small>
                          </h4>
                          @if($notification->data['user']['id'] == auth()->user()->id)
                          <p>Usulan Anda Telah Diverifikasi</p>
                          @endif
                        </a>
                      </li>
                    @endif
                  @endforeach
                </ul>
              </li>
              <li class="footer"><a href="#">Lihat Semua</a></li>
            </ul>
        </li>
    <!-- Tasks: style can be found in dropdown.less -->
        <!--<li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                
                <ul class="menu">
                  <li>
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  
                  <li>
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  
                  <li>
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  
                  <li>
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
        </li>-->
    <!-- User Account: style can be found in dropdown.less -->
        @if(\Auth::check())
        <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="http://placehold.it/160" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ \Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="http://placehold.it/160" class="img-circle" alt="User Image">

                <p>
                  {{\Auth::user()->name}} - ----
                  <small>----</small>
                </p>
              </li>
              <!-- Menu Body -->
              <!--<li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                
              </li>-->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{url('map')}}" class="btn btn-default btn-flat">Lihat Peta</a>
                </div>
                <div class="pull-right">
                  <form method="post" action="{{ url('logout') }}">
                    {{ csrf_field() }}
                    <button class="btn btn-default btn-flat">Keluar</button>
                  </form>
                </div>
              </li>
            </ul>
        </li>
        @else
        <li class="user user-menu">
            <a href="{{ url('login') }}">
              <img src="{{ asset('dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">Login</span>
            </a>
        </li>
        @endif
    <!-- Control Sidebar Toggle Button -->
        <!--<li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a></li>-->
    </ul>
</div>