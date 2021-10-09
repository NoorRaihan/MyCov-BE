<div class="sidebar sidebar-dark sidebar-fixed sidebar-self-hiding-xl" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        {{ config('app.name', 'Laravel') }}
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="init">
    @role('admin')
    <li class="nav-item">
        <a class="nav-link" href="index.html">
            Dashboard
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/admin/roles">
            {{ __('Roles') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/admin/user">
            {{ __('Users') }}
        </a>
    </li>
    @endrole

    @role('member')
    <li class="nav-item">
        <a class="nav-link" href="index.html">
            Dashboard
        </a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="/admin/user">
            {{ __('Users') }}
        </a>
    </li>
    @endrole

    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"
            {{ __('Logout') }}>
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
    </ul>
</div>