@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('links')
    <title>Mental Massage | Overzicht Gebruikers</title>
</head>
<body>
    @include('dashboard-header')
    <div class="dashboard-container">
        @include('dashboard-navigation')
        <div class="dashboard-content-container">
            <h1>Overzicht gebruikers</h1>
            <div class="overzicht-container">
                <div class="flex-row overzicht-title">
                    <div class="flex-row gap-medium align-center">
                        <h2>Geregistreerde Gebruikers</h2>
                        <p class="overzicht-totaal">Totaal: {{ sizeOf($userInfo) }}</p>
                    </div>
                    <a href="user/add" class="btn add-btn"><i class="fa-solid fa-plus"></i> Gebruiker Toevoegen</a>
                </div>
                <div class="overzicht-header overzicht-grid">
                    <p>Naam</p>
                    <p>Email Address</p>
                    <p>Leeftijd</p>
                    <p>Geslacht</p>
                    <p>Specialiteit</p>
                </div>
                <div>
                @foreach($userInfo as $user)
                <div class="overzicht-item">
                    @php
                        $leeftijd = Carbon::parse($user['userGeboorteDatum'])->age;
                        $userPfp = $user['userProfielfoto'];
                        $userId = $user['userId'];
                    @endphp
                    <a href="/user/view/{{$userId}}" class="overzicht-link">
                        <span class="flex-row gap-medium">
                            <img src="{{ asset("storage/userImages/$userPfp") }}" width="48" height="48" >
                            <p>{{ $user['userNaam'] }} {{ $user['userVoornaam']}}</p>
                        </span>
                        <p>{{ $user['userEmail'] }}</p>
                        <p>{{ $leeftijd }}</p>
                        <p>{{ $user['geslachtNaam'] }}</p>
                        <p>{{ $user['userSpecialty'] }}</p>
                    </a>
                    <a href="/user/edit/{{$userId}}"><i class="fa-solid fa-pen"></i></a>
                    <a href="/user/archive/{{$userId}}"><i class="fa-solid fa-trash-can"></i></a>
                </div>
                @endforeach
            </div>
            @if(count($nietGeregistreerdeUsers) > 0)
            <div class="overzicht-container">
                <h2>Nog niet ingelogde gebruikers: </h2>
                <p>Totaal: {{ count($nietGeregistreerdeUsers) }}</p>
                <div class="overzicht-header grid">
                    <p>Email Address</p>
                    <p>Type Account</p>
                </div>
                @foreach($nietGeregistreerdeUsers as $user)
                <div class="overzicht-item flex-row gap-xl">
                    @php
                        $userId = $user->userId;
                    @endphp
                    <p>{{ $user->userEmail }}</p>
                    <p>{{ $user->userAccountDescription}}</p>
                    <a href="/user/edit/{{$userId}}"><i class="fa-solid fa-pen"></i></a>
                    <a href="/user/archive/{{$userId}}"><i class="fa-solid fa-trash-can"></i></a>
                </div>
                @endforeach
            </div>
            @endif
            @if(count($archivedUsers) > 0)
            <div class="overzicht-container">
                <h2>Gearchiveerde Gebruikers:  </h2>
                <p>Totaal: {{ count($archivedUsers) }}</p>
                <div class="overzicht-header grid">
                    <p>Email Address</p>
                </div>
                @foreach($archivedUsers as $user)
                <div class="overzicht-item flex-row gap-xl">
                    @php
                        $userId = $user->userId;
                    @endphp
                    <p>{{ $user->userEmail }}</p>
                    <a href="/user/archive/{{$userId}}"><i class="fa-solid fa-check"></i></a>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</body>
</html>