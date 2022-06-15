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
            <table style='border: solid 1px black; border-collapse: collapse; padding: 0.5em;'>
                <tr style="border: solid 1px black; padding: 0.5em;">
                    <th>Email</th>
                    <th>Type Gebruiker</th>
                </tr>
                @foreach($userInfo as $user)
                <tr>
                    <td>{{ $user['userEmail'] }}</td>
                    <td>{{ $user['userAccountDescription'] }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>
</html>