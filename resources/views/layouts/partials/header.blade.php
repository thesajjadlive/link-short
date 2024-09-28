<ul class="nav navbar-toolbar">
    <li class="dropdown dropdown-user">
        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
            <img src="{{ auth()->user()->image !== null? asset(auth()->user()->image) :asset('assets/backend/img/admin-avatar.png') }}" />
            <span></span>{{ auth()->user()->name??'' }}<i class="fa fa-angle-down m-l-5"></i></a>
        <ul class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route('app.user.profile') }}"><i class="fa fa-user"></i>Profile</a>
            <li class="dropdown-divider"></li>
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-power-off"></i>  {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </ul>
    </li>
</ul>
