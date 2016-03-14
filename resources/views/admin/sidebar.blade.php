<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">Menu</li>
      <!-- Optionally, you can add icons to the links -->
      <li id="user-overview" class="fa-lg">
        <a href="/{{ env('ADMINNS') }}">
          <span class="fa-stack">
            <i class="fa fa-pie-chart fa-stack-1x"></i>
          </span>
          <span>Overview</span>
        </a>
      </li>
      <li id="user-ports" class="fa-lg">
        <a href="/{{ env('ADMINNS') }}/ports">
          <span class="fa-stack">
            <i class="fa fa-desktop fa-stack-1x"></i>
          </span>
          <span>Ports</span>
        </a>
      </li>
      <li id="user-users" class="fa-lg">
        <a href="/{{ env('ADMINNS') }}/users">
          <span class="fa-stack">
            <i class="fa fa-user fa-stack-1x"></i>
          </span>
          <span>Users</span>
        </a>
      </li>
      <li id="user-articles" class="treeview">
        <a href="#" class="fa-lg">
          <span class="fa-stack">
            <i class="fa fa-list fa-stack-1x"></i>
          </span>
          <span>Articles</span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="{{ route('admin/articles') }}"><i class="fa fa-circle-o"></i> Articles</a>
          </li>
          <li>
            <a href="{{ route('admin/articles/create') }}"><i class="fa fa-circle-o"></i>Create Articles</a>
          </li>
          <li>
            <a href="{{ route('admin/category') }}"><i class="fa fa-circle-o"></i> Category</a>
          </li>
        </ul>
        <li id="user-orders" class="fa-lg">
          <a href="/{{ env('ADMINNS') }}/orders">
            <span class="fa-stack">
              <i class="fa fa-cny fa-stack-1x"></i>
            </span>
            <span>Orders</span>
          </a>
        </li>
      </li>

    </ul><!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
