<!-- Main Header -->
<header class="main-header">

  <!-- Logo -->
  <a href="{{ url('/') }}" class="logo"><b>iProxier</b>.com</a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    @if (!in_array($action, ['getActivate', 'getResentActivateMail']))
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
    @endif
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        @if (!in_array($action, ['getActivate', 'getResentActivateMail']))
        <!-- User Wallet -->
        <li class="dropdown tasks-menu">
          <span style="color: white; line-height: 20px;display: block; padding: 15px 15px;">
            <i class="fa fa-cny "></i>
            {!! $user['wallet'] !!}
            <span class="label label-success"> <a href="/billing/charge" style="color: white;">charge</a></span>
          </span>
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
                {{-- <small>{{ $user['since'] or 'Member since Nov. 2012' }}</small> --}}
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                @if (!in_array($action, ['getActivate', 'getResentActivateMail']))
                <a href="{{ url('/user/profile') }}" class="btn btn-default btn-flat">Profile</a>
                @endif
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
