<li class="side-menus {{ Request::is('dashboard*') ? 'active' : '' }}">
    <a class="nav-link" href="/public/dashboard">
        <i class="fas fa-building"></i><span>Dashboard</span>
    </a>
</li>
<li class="side-menus {{ Request::is('users*') ? 'active' : '' }}" style="display: none">
    <a class="nav-link" href="{{ route('users.index') }}">
        <i class="fas fa-users"></i><span>Users</span>
    </a>
</li>
<li class="side-menus {{ Request::is('banners*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('banners.index') }}">
        <i class="fas fa-image"></i><span>Banners</span>
    </a>
</li>
<li class="side-menus {{ Request::is('reviews*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('reviews.index') }}">
        <i class="fas fa-comments"></i><span>Rating & Review</span>
    </a>
</li>
<li class="side-menus {{ Request::is('contact-us*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('contact-us.index') }}">
        <i class="fas fa-comments"></i><span>Radhika Technology</span>
    </a>
</li>
<li class="side-menus {{ Request::is('settings*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('settings.index') }}">
        <i class="fas fa-cog"></i><span>Setting</span>
    </a>
</li>
