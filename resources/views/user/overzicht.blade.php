<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('storage/styles/main-styles.css') }}">
    <title>Mental Massage | Overzicht Gebruikers</title>
</head>
<body>
    <header class="header-container dashboard-header">
        <div class="logo-container flex-row">
            <a href="/" class="logo-link"><img src="{{ asset('storage/images/logo-color.png') }}" alt="mental massage logo" width="72" height="72" class="logo"></a>
            <h1>Mental Massage</h1>
            <a href="/logout" class="logout-container flex-row">
                <img src="{{ asset('storage/images/icons/logout.svg') }}" width="24" height="24">
                Logout
            </a>
        </div>
    </header>
    <div class="dashboard-container">
        @include('dashboard-navigation')
        <div class="dashboard-content-container">
            <h1>Overzicht gebruikers</h1>
            <table style='border: solid 1px black; border-collapse: collapse; padding: 0.5em; text-align: center'>
                <tr style="border: solid 1px black; padding: 0.5em;">
                    <th>Profiel Foto</th>
                    <th>Email</th>
                    <th>Voornaam</th>
                    <th>Naam</th>
                    <th>Geboorte Datum</th>
                    <th>Geslacht</th>
                    <th>Specialiteit</th>
                    <th>Type Gebruiker</th>
                    <th>Bewerk Gebruiker</th>
                    <th>Verwijder Gebruiker</th>
                </tr>
                @foreach($userInfo as $user)
                <tr>
                    @php
                        $userPfp = $user['userProfielfoto'];
                        $userId = $user['userId'];
                    @endphp
                    <td><img src="{{ asset("storage/userImages/$userPfp") }}" width="48" height="48" ></td>
                    <td>{{ $user['userEmail'] }}</td>
                    <td>{{ $user['userVoornaam'] }}</td>
                    <td>{{ $user['userNaam'] }}</td>
                    <td>{{ $user['userGeboorteDatum'] }}</td>
                    <td>{{ $user['userGeslacht'] }}</td>
                    <td>{{ $user['userSpecialty'] }}</td>
                    <td>{{ $user['userAccountDescription'] }}</td>
                    <td><a href="/user/edit/{{$userId}}"><img src="{{ asset('storage/images/pencil.png') }}" width="24" height="24"></a></td>
                    <td><a href="/user/delete/{{$userId}}"><img src="{{ asset('storage/images/delete.png') }}" width="24" height="24"></a></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>
</html>