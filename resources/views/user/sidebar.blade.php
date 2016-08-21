<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">{{trans('base.menu')}}</li>
      <!-- Optionally, you can add icons to the links -->
      <li id="user-services" class="fa-lg">
        <a href="/user">
          <span class="fa-stack">
            <i class="fa fa-user fa-stack-1x"></i>
          </span>
          <span>{{trans('base.services')}}</span>
        </a>
      </li>
      <li id="user-billing" class="fa-lg">
        <a href="/user/billing">
          <span class="fa-stack">
            <i class="fa fa-credit-card fa-stack-1x"></i>
          </span>
          <span>{{trans('base.billing')}}</span>
        </a>
      </li>
      <li id="user-helps" class="fa-lg">
        <a href="/user/helps">
          <span class="fa-stack">
            <i class="fa fa-question-circle fa-stack-1x"></i>
          </span>
          <span>{{trans('base.helps')}}</span>
        </a>
      </li>
      <li id="user-logs" class="fa-lg">
        <a href="/user/logs">
          <span class="fa-stack">
            <i class="fa fa-history fa-stack-1x"></i>
          </span>
          <span>{{trans('base.logs')}}</span>
        </a>
      </li>
      <li id="user-invitation" class="fa-lg">
        <a href="/user/invitation">
          <span class="fa-stack">
            <i class="fa fa-users fa-stack-1x"></i>
          </span>
          <span>{{trans('invitation.invitation')}}</span>
        </a>
      </li>
      <li id="user-settings" class="fa-lg">
        <a href="/user/settings">
          <span class="fa-stack">
            <i class="fa fa-cog fa-stack-1x"></i>
          </span>
          <span>{{trans('base.settings')}}</span>
        </a>
      </li>

    </ul><!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
