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
    <title>Mental Massage | Overzicht Clienten</title>
</head>
<body>
    @include('dashboard-header')
    <div class="dashboard-container">
        @include('dashboard-navigation')
        <main class="dashboard-content-container">
            @if(count($clientInfo) > 0)
            <section class="overzicht-container">
                <h1>Overzicht clienten</h1>
                <a href="/clienten/add"><i class="fa-solid fa-plus"></i> Nieuwe Client</a>
                    <div class="overzicht-header grid">
                    <tr>
                    <th>Naam</th>
                    <th>Soort Zorg</th>
                    <th>Leeftijd</th>
                    <th>Registratie Datum</th>
                    <th>Telefoon Nummer</th>
                    <th>Email</th>
                    <th>Geslacht</th>
                    <th>Bewerken</th>
                    <th>Verwijderen</th>
                    </tr>
                </div>

                @foreach($clientInfo as $client)
                @php
                    $leeftijd = Carbon::parse($client->clientGeboorteDatum)->age;
                @endphp
            <div class="overzicht-item flex-row gap-xl">
                <a href="/client/view/{{$client->clientId}}" class="flex-row gap-xl">
                    <tr>
                    <td>{{ $client->clientVoornaam }} {{$client->clientNaam}}</td>
                    <td>{{ $client->zorgBeschrijving }}</td>
                    <td>{{ $leeftijd }}</td>
                    <td>{{ $client->clientRegistratieDatum }}</td>
                    <td>{{ $client->clienttelefoonNummer }}</td>
                    <td>{{ $client->clientEmail }}</td>
                    <td>{{ $client->geslachtNaam }}</td>
                    </tr>
                </a>
                <a href="/client/edit/{{$client->clientId}}"><i class="fa-solid fa-pen"></i></a>
                <a href="/client/archive/{{$client->clientId}}"><i class="fa-solid fa-ban"></i></a>
            </div>
            @endforeach
               
            </section>
            @else
                <h1>Er zijn nog geen clienten geregistreerd</h1>
                <a href="/clienten/add"><i class="fa-solid fa-plus"></i> Voeg nieuwe client toe</a>
            @endif
        </main>
    </div>
</body>
</html>