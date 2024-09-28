<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img class="rounded-circle" width="45px" src="{{ auth()->user()->image !== null? asset(auth()->user()->image) :asset('assets/backend/img/admin-avatar.png') }}" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">{{ auth()->user()->name?? 'Admin User' }}</div><small>Administrator</small></div>
        </div>
        <ul class="side-menu metismenu">
            @can('app.dashboard')
                <li class="{{ Request::is('app/dashboard')?'active':'' }}">
                    <a href="{{ route('app.dashboard') }}"><i class="sidebar-item-icon fa fa-th-large"></i>
                        <span class="nav-label">Dashboard</span>
                    </a>
                </li>
            @endcan

            @if (Request::is('app/roles*') || Request::is('app/users*'))
                @php($accessNav = true)
            @endif
            <li class="{{ isset($accessNav) ? 'active' : '' }}">
                <a href="javascript:void (0)"><i class="sidebar-item-icon fa fa-lock"></i>
                    <span class="nav-label">Access Control</span><i class="fa fa-angle-left arrow"></i>
                </a>

                <ul class="nav-2-level {{ isset($accessNav) ? 'collapse in' : 'collapse' }}">
                    @can('app.roles.index')
                        <li>
                            <a class="{{ Request::is('app/roles')?'active':'' }}" href="{{ route('app.roles.index') }}">Roles</a>
                        </li>
                    @endcan
                    @can('app.users.index')
                        <li>
                            <a class="{{ Request::is('app/users')?'active':'' }}" href="{{ route('app.users.index') }}">Users</a>
                        </li>
                    @endcan
                </ul>
            </li>

            @if (Request::is('app/setting/appearance') || Request::is('app/setting/general') || Request::is('app/setting/privacy') || Request::is('app/setting/term') || Request::is('app/setting/about'))
                @php($settingNav = true)
            @endif
            <li class="{{ isset($settingNav) ? 'active' : '' }}">
                <a href="javascript:void (0)"><i class="sidebar-item-icon fa fa-cog"></i>
                    <span class="nav-label">System</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    @can('app.setting.index')
                        <li>
                            <a class="{{ Request::is('app/setting/appearance') || Request::is('app/setting/general') || Request::is('app/setting/privacy') || Request::is('app/setting/term') || Request::is('app/setting/about') ?'active':'' }}" href="{{ route('app.setting.general.index') }}">Settings</a>
                        </li>
                    @endcan
                </ul>
            </li>
        </ul>
    </div>
</nav>
