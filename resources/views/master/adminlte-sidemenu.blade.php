@if(\Auth::check())
<ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="{{ url('home') }}">
            <i class="fa fa-dashboard"></i> <span>Home</span>
            <span>
              <i></i>
            </span>
          </a>
        
        @if(\Auth::user()->hasRole('admin') || \Auth::user()->hasRole('user'))
        <li class="treeview">
          <a href="#">
            <i class="fa fa-database"></i> <span>Usulan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('proposal/usulan/tambah')}}"><i class="fa fa-circle-o"></i> Tambah Usulan</a></li>
            <li><a href="{{url('proposal/usulan')}}"><i class="fa fa-circle-o"></i> List Usulan</a></li>
            
          </ul>
        </li>
        @endif
        @if(\Auth::user()->hasRole('admin') || \Auth::user()->hasRole('manager'))
        <li>
          <a href="{{ url('/pengecekan/usulan') }}">
            <i class="fa fa-commenting"></i> <span>Verifikasi Data</span>
            <span>
              <i></i>
            </span>
          </a>
        </li>
        @endif
        @if(\Auth::user()->hasRole('admin'))
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('pengaturan/user')}}"><i class="fa fa-circle-o"></i> Daftar User</a></li>
            
            <li><a href="#"><i class="fa fa-circle-o"></i> History Log</a></li>
            
          </ul>
        </li>
        @endif
        
        @if(\Auth::user()->hasRole('admin'))
        <li class="treeview">
          <a href="#">
            <i class="fa fa-database"></i> <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('provinsi')}}"><i class="fa fa-circle-o"></i> Provinsi</a></li>
            <li><a href="{{url('kabupaten')}}"><i class="fa fa-circle-o"></i> Kabupaten</a></li>
            <li><a href="{{ url('kecamatan') }}"><i class="fa fa-circle-o"></i> Kecamatan</a></li>

            <li>
                <a href="#">
                  <i class="fa fa-database"></i> <span>Persyaratan</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{url('provinsi')}}"><i class="fa fa-circle-o"></i> Jalan</a></li>
                  <li><a href="{{url('kabupaten')}}"><i class="fa fa-circle-o"></i> SAB</a></li>
                  <li><a href="{{ url('kecamatan') }}"><i class="fa fa-circle-o"></i> PLTS</a></li>
                </ul>
            </li>
          </ul>
        </li>
        @endif
        @if(\Auth::user()->hasRole('admin'))
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Laporan Usulan</a></li>
            
          </ul>
        </li>
        @endif
        <li>
          <a href="#">
            <i class="fa fa-tool"></i> <span>Tools</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Profil User</a></li>
            <li><a href="{{ url('pengaturan/user/gantipassword')}}"><i class="fa fa-circle-o"></i> Ubah Password</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> User Manual</a></li>
          </ul>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-download"></i> <span>Downloads</span>
            <span>
              <i></i>
            </span>
          </a>
        </li>
        
</ul>
@endif
