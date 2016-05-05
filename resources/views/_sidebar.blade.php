<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                <img src="{{ asset("/bower_components/admin-lte/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
<!--                     <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
                    @if (Auth::user()->type == 0)
                        Admin
                    @elseif (Auth::user()->type == 1)
                        Support Supervisor
                    @else
                        Support Agent
                    @endif
                </div>
            </div>

            <!-- search form (Optional) -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
                </div>
            </form>
            <!-- /.search form -->

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header">Sections</li>
                <!-- Optionally, you can add icons to the links -->
                <li><a href="home.html"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
                @if (Auth::user())
                    <li class="treeview">
                        <a href="#"><i class="fa fa-link"></i> <span>Admin panel</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu" style="display: none;">
                            <li><a href="/projects">Projects</a></li>
                            <li><a href="/admins" onClick="window.location.reload()">Administrators</a></li>
                            <li><a href="/supervisors" onClick="window.location.reload()">Support supervisors</a></li>
                            <li><a href="/agents" onClick="window.location.reload()">Support agents</a></li>
                            <li><a href="/customers">Customers</a></li>
                        </ul>
                    </li>
                @endif
                <li><a href="/tickets"><i class="fa fa-link"></i> <span>All tickets</span></a></li>
                <li><a href="statistics"><i class="fa fa-link"></i> <span>Statistics</span></a></li>
                @if (Auth::user()->type == 0)
                    <li><a href="/app_settings"><i class="fa fa-link"></i> <span>Settings</span></a></li>
                @endif
            </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>
