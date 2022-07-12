<nav class="dashboard-navigation-container">
    <ul class="nav-list flex-column gap-large">
        <li class="nav-item {{ ( Request::is('dashboard')) ? 'active' : '' }}">
            <a href="/dashboard" class="flex-row"> 
                <i class="fa-solid fa-xl fa-house"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item {{ ( Request::is('clienten')) ? 'active' : '' }}">
            <a href="/clienten" class="flex-row">
                <i class="fa-solid fa-xl fa-people-group"></i>
                Clienten
            </a>
        </li>
        <li class="nav-item {{ ( Request::is('afspraken')) ? 'active' : '' }}">
            <a href="/afspraken" class="flex-row">
            <i class="fa-solid fa-xl fa-calendar-day"></i>
                Afspraken
            </a>
        </li>
        @if($userType == 'admin')
        <p>Admin Tools</p>
        <li class="nav-item {{ ( Request::is('users')) ? 'active' : '' }}">
            <a href="/users" class="flex-row"> 
                <i class="fa-solid fa-xl fa-users"></i>
                Gebruikers
            </a>
        </li>
        @endif
    </ul>
</nav>