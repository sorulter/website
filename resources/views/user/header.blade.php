<!-- Main Header -->
<header class="main-header">

  <!-- Logo -->
  <a href="{{ url('/') }}" class="logo"><b>iProxier</b>.com</a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li>
          <a href="/user/status">Status</a>
        </li>
        <li class="dropdown tasks-menu">
          <a href="/user/billing/charge" style="color: white;">Charge</a>
        </li>
        @if (in_array($user['id'], mb_split(',', env('ADMINIDS'))))
        <li>
          <a href="/{{ env('ADMINNS') }}">Admin Panel</a>
        </li>
        @endif

        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- The user image in the navbar-->
            <img src="{{ $user['avatar'] or asset("/static/default/img/noavatar.png") }}" class="user-image" alt="User Image"/>
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs">{{ $user['email'] or 'Email' }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
              <img src="{{ $user['avatar'] or asset("/static/default/img/noavatar.png") }}" class="img-circle" alt="User Image" />
              <p>
                {{ $user['email'] or 'Email' }}
                <small>{{ $user['created_at'] or 'Member since Nov. 2012' }}</small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="{{ url('/user/settings') }}" class="btn btn-default btn-flat">Settings</a>
              </div>
              <div class="pull-right">
                <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
