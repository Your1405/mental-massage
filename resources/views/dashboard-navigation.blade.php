<nav class="dashboard-navigation-container">
    <ul class="nav-list flex-column gap-large">
        <li class="nav-item {{ ( Request::is('dashboard')) ? 'active' : '' }}">
            <a href="/dashboard" class="flex-row"> 
                <i class="fa-solid fa-xl fa-house"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item {{ ( Request::is('clienten/add')) ? 'active' : '' }}">
            <a href="/clienten/add" class="flex-row"> 
                <i class="fa-solid fa-xl fa-user-plus"></i>
                Registreer Client
            </a>
        </li>
        <li class="nav-item {{ ( Request::is('clienten')) ? 'active' : '' }}">
            <a href="/clienten" class="flex-row">
                <i class="fa-solid fa-xl fa-users"></i>
                Overzicht Clienten
            </a>
        </li>
        <li class="nav-item {{ ( Request::is('afspraak')) ? 'active' : '' }}">
            <a href="/afspraak" class="flex-row">
            <img src="{{ asset('storage/images/icons/event.svg') }}" width="24" height="24">
                Afspraken
            </a>
        </li>
        @if($userType == 'admin')
        <p>Admin Tools</p>
        <li class="nav-item {{ ( Request::is('user/add')) ? 'active' : '' }}">
            <a href="/user/add" class="flex-row"> 
                <img src="{{ asset('storage/images/icons/person.svg') }}" width="24" height="24">
                Gebruiker Toevoegen
            </a>
        </li>
        <li class="nav-item {{ ( Request::is('users')) ? 'active' : '' }}">
            <a href="/users" class="flex-row"> 
                <img src="{{ asset('storage/images/icons/people.svg') }}" width="24" height="24">
                Overzicht Gebruikers
            </a>
        </li>
        @endif
    </ul>
</nav>