@php
    use Carbon\Carbon;
    $leeftijd = Carbon::parse($clientInfo->clientGeboorteDatum)->age;
    $geboortedatum = Carbon::parse($clientInfo->clientGeboorteDatum)->format('j F Y');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('links')
    <title>Mental Massage | Overzicht Client: {{ $clientInfo->clientNaam }} {{ $clientInfo->clientVoornaam }}</title>
</head>
<body>
    @include('dashboard-header')
    <div class="dashboard-container">
        @include('dashboard-navigation')
        <main class="dashboard-content-container">
            <a href="/clienten"><i class="fa-solid fa-arrow-left"></i></a>
            @if($clientInfo->clientBehandelingStatus == 1)
                <p>Deze gebruiker is al afgehandeld!</p>
                @if($userType == 'admin')
                    <a href="/client/archive/{{ $clientInfo->clientId }}">Maak client weer actief</a>
                @endif
            @endif
            <h1>Overzicht Client: {{ $clientInfo->clientNaam }} {{ $clientInfo->clientVoornaam }}</h1>
            @if($clientInfo->clientBehandelingStatus == 0 && $userType == 'admin')
                <div class="flex-column gap-xl"> 
                    <a href="/client/edit/{{ $clientInfo->clientId }}"><i class="fa-solid fa-pen"></i> Bewerk client</a>
                    <a href="/client/archive/{{ $clientInfo->clientId }}"><i class="fa-solid fa-check"></i> Maak client afgehandeld</a>
                </div>
            @endif
            <section>
                <h2>Contact Gegevens: </h2>
                <p>Email: </p>
                <a href="mailto:{{ $clientInfo->clientEmail }}"><i class="fa-solid fa-envelope"></i> {{ $clientInfo->clientEmail }}</a>
                @if($clientInfo->clientTelefoonNummer)
                    <p>Telefoon nummer: </p>
                    <a href="tel: +597{{ $clientInfo->clientTelefoonNummer }}"><i class="fa-solid fa-phone"></i> {{ $clientInfo->clientTelefoonNummer }}</a>
                @endif
                @if($clientInfo->clientHuisTelefoonNummer)
                    <p>Huis telefoon nummer: </p>
                    <a href="tel: +597{{ $clientInfo->clientHuisTelefoonNummer }}"><i class="fa-solid fa-phone"></i> {{ $clientInfo->clientHuisTelefoonNummer }}</a>
                @endif
                <p>Naam contactpersoon: {{ $clientInfo->clientContactPersoonNaam }}</p> 
                <p>Telefoon contactpersoon: </p> 
                <a href="tel: +597{{ $clientInfo->clientContactPersoonNummer }}"><i class="fa-solid fa-phone"></i> {{ $clientInfo->clientContactPersoonNummer }}</a>
            </section>

            <section>
                <h2>Persoonlijke Gegevens: </h2>
                <p>Voornaam: {{ $clientInfo->clientVoornaam }}</p>
                <p>Achternaam: {{ $clientInfo->clientNaam }}</p>
                <p>Geboortedatum: {{ $geboortedatum }} ({{ $leeftijd }} Jaar)</p>
                <p>{{ $clientInfo->geslachtNaam }}
                <p>{{ $clientInfo->zorgBeschrijving }}e zorg</p>
                <p>Gezinslid: {{ $clientInfo->gezinsLidBeschrijving }}</p>
                <p>Burgerlijke Staat: {{ $clientInfo->burgelijkeStaatBeschrijving }}</p>
                <p>Ethniciteit: {{ $clientInfo->ethniciteitBeschrijving }}</p>
                <p>Opleiding: {{ $clientInfo->clientOpleiding }}</p>
                <p>Beroep: {{ $clientInfo->clientBeroep }}; Naam werkgever: {{ $clientInfo->clientWerkgever }}</p>
            </section>

            <section>
                <h2>Medische Gegevens: </h2>
                <p>Huisarts: {{ $clientInfo->clientHuisarts }}</p>
                <p>Verwijzing naar Stg. Mental Massage: {{ $clientInfo->verwijzingNaam }}</p>
                <h3>Verzekering: </h3>
                <p>Verzekeringsstatus: </p>
                <p>{{ $clientInfo->verzekeringsStatus }}</p>
                @if($clientInfo->clientVerzekeringsStatus == 1)
                    <p>Verzekerings Maatschappij: {{ $clientInfo->verzekeringsMaatschappijNaam }} </p>
                    <p>Verzekerings Nummer: {{ $clientInfo->clientVerzekeringsNummer }} </p>
                    <p>Verzekerings Type: {{ $clientInfo->clientVerzekeringsType }} </p>
                @endif
            </section>
        </main>
    </div>
</body>
</html>