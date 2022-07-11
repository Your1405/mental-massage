<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('links')
    <title>Mental Massage | Gebruiker {{ $userInfo['userNaam'] }} {{ $userInfo['userVoornaam'] }} Overzicht</title>
</head>
<body>
    @include('dashboard-header')
    <div class="dashboard-container">
        @include('dashboard-navigation')
        <main class="dashboard-content-container">
            <a href="/users"><i class="fa-solid fa-arrow-left"></i></a>
            <h1> {{ $userInfo['userNaam'] }} {{ $userInfo['userVoornaam'] }} </h1>
            <section>
                @php
                    use Carbon\Carbon;
                    $userpfp = $userInfo['userProfielfoto'];
                    $leeftijd = Carbon::parse($userInfo['userGeboorteDatum'])->age;
                @endphp
                <img src="{{ asset("storage/userImages/$userpfp")}}" width="64" height="64">

                <p>{{ $userInfo['userNaam'] }} {{ $userInfo['userVoornaam'] }}</p>
                <p> Leeftijd: {{ $leeftijd }}
                <p>{{ $userInfo['userSpecialty']}}</p>
                
                <a href="mailto:{{ $userInfo['userEmail'] }}"><i class="fa-solid fa-envelope"></i>{{ $userInfo['userEmail'] }}</a>
                
                <div>
                    <a href="/user/edit/{{ $userInfo['userId'] }}">Bewerk gebruiker</a>
                    <a href="/user/archive/{{ $userInfo['userId'] }}">Verwijder gebruiker</a>
                </div>
            </section>
            <section>
                <h2>Clienten</h2>
            </section>
            <section>
                <h2>Afspraken</h2>
            </section>
        </main>
    </div>
</body>
</html>