<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{!! asset(Auth::user()->foto) !!}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>{!! Auth::user()->namaUser; !!}</p>
            </div>
          </div>
          <!-- search form -->

          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li>
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Master</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              @if(Auth::user()->can('user.create'))
                <li><a href="{{URL::to('user')}}"><i class="fa fa-circle-o"></i>User</a></li>
              @endif

              @if(Auth::user()->can('role.create'))
                <li><a href="{{URL::to('role')}}"><i class="fa fa-circle-o"></i>Role</a></li>
              @endif
              @if(Auth::user()->can('permission.create'))
                <li><a href="{{URL::to('permission')}}"><i class="fa fa-circle-o"></i>Permission</a></li>
              @endif
              @if(Auth::user()->can('barang.create'))
                <li><a href="{{URL::to('subkelompok')}}"><i class="fa fa-circle-o"></i>Barang</a></li>
              @endif
                <li><a href="{{URL::to('/lokasi')}}"><i class="fa fa-circle-o"></i>Lokasi</a></li>
              </ul>
            </li>

             <li class="treeview">
              <a href="#">
               @if(Auth::user()->can('peminjaman.create'))
                <i class="fa fa-pie-chart"></i>
                <span>Transaksi</span>
                <i class="fa fa-angle-left pull-right"></i>
                @endif
              </a>
              <ul class="treeview-menu">
                <li><a href="{{URL::to('/peminjaman/create')}}"><i class="fa fa-circle-o"></i>Peminjaman Barang</a></li>
                <li><a href="{{URL::to('peminjaman')}}"><i class="fa fa-circle-o"></i>Approve Peminjaman</a></li>
                <li><a href="{{URL::to('/')}}"><i class="fa fa-circle-o"></i>Peta</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Laporan</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{URL::to('/laporan')}}"><i class="fa fa-circle-o"></i>PDF</a></li>
                <li><a href="{{URL::to('/chart')}}"><i class="fa fa-circle-o"></i>Grafik</a></li>
              </ul>
            </li> 
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>