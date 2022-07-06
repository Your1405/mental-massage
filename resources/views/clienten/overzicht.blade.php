<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('links')
    <title>Mental Massage | Overzicht Clienten</title>
</head>
<body>
    <header class="header-container dashboard-header">
        <div class="logo-container flex-row">
            <a href="/" class="logo-link"><img src="{{ asset('storage/images/logo-color.png') }}" alt="mental massage logo" width="72" height="72" class="logo"></a>
            <h1>Mental Massage</h1>
        </div>
    </header>
    <div class="dashboard-container">
        {{-- @include('dashboard-navigation') --}}
        <div class="dashboard-content-container">
            <h1>Overzicht clienten</h1>
            <table style='border: solid 1px black; border-collapse: collapse; padding: 0.5em; text-align: center'>
                <tr style="border: solid 1px black; padding: 0.5em;">
                    {{-- <th>client ID</th> --}}
                    <th>client naam</th>
                    <th>soortzorg</th>
                    {{-- <th>client gezin status</th> --}}
                    <th>client geboorte datum</th>
                    <th>client registratie datum</th>
                    {{-- <th>client burgerlijkestaat</th> --}}
                    <th>client telefoon nummer</th>
                    <th>client email</th>
                    {{-- <th>client enthniciteit</th> --}}
                    <th>client geslacht</th>
                    {{-- <th>client huisarts </th>
                    <th>client verwijzing</th>
                    <th>client opleiding</th>
                    <th>client beroep</th>
                    <th>client werkgever</th>
                    <th>client contact persoon id </th>
                    <th>client medicatie</th>
                    <th>client onderliggende ziekten</th> --}}
                    <th>client behandeling status</th>
                    {{-- <th>client status</th> --}}
                </tr>
                @foreach($clientInfo as $client)
                <tr>
 
                     {{-- <td>{{ $client['clientId'] }}</td> --}}
                    <td>{{ $client['clientVoornaam'] }}</td>
                    <td>{{ $client['soortZorg'] }}</td>
                    <td>{{ $client['clientGeboorteDatum'] }}</td>
                    <td>{{ $client['clientRegistratieDatum'] }}</td>
                    <td>{{ $client['clienttelefoonNummer'] }}</td>
                    <td>{{ $client['clientEmail'] }}</td>
                    <td>{{ $client['clientGeslacht'] }}</td>
                    <td>{{ $client['clientBehandelingStatus'] }}</td>
                    {{-- <td>{{ $client['clientStatus'] }}</td> --}}
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>
</html>