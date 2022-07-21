<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">\
    @include('links')
    <title>Mental Massage | Afspraken overzicht</title>
</head>
<body>
    @include('dashboard-header')
    <div class="dashboard-container">
        @include('dashboard-navigation')
        <main class="dashboard-content-container">
            <h1>Overzicht Afspraken</h1>
            @if(count($afspraakInfo) == 0)
                <h2>U heeft geen enkele afspraken.</h2>
                <a href="afspraken/add" class="btn add-btn"><i class="fa-solid fa-plus"></i> Maak Nieuwe Afspraak</a>
            @else
                <div class="overzicht-container">
                    <div class="flex-row overzicht-title">
                        <div class="flex-row gap-medium align-center">
                            <h2>Al uw afspraken</h2>
                            <p class="overzicht-totaal">Totaal: {{ sizeOf($afspraakInfo) }}</p>
                        </div>
                        <a href="afspraken/add" class="btn add-btn"><i class="fa-solid fa-plus"></i> Nieuwe Afspraak</a>
                    </div>
                    <div class="overzicht-header overzicht-grid">
                        <p>Naam</p>
                        <p>Email Address</p>
                        <p>Datum</p>
                        <p>Begin Tijd</p>
                        <p>Eind Tijd</p>
                    </div>
                    @foreach($afspraakInfo as $afspraak)
                    <div class="overzicht-item">
                        <a href="/afspraak/view/{{$afspraak->afspraakId}}" class="overzicht-link">
                            <p>{{ $afspraak->clientNaam }} {{ $afspraak->clientVoornaam }}</p>
                            <p>{{ $afspraak->clientEmail }}</p>
                            <p>{{ $afspraak->afspraakDatum }}</p>
                            <p>{{ $afspraak->afspraakBegintijd }}</p>
                            <p>{{ $afspraak->afspraakEindtijd }}</p>
                        </a>
                        <a href="/afspraak/edit/{{$afspraak->afspraakId}}"><i class="fa-solid fa-pen"></i></a>
                        <a href="/afspraak/archive/{{$afspraak->afspraakId}}"><i class="fa-solid fa-ban"></i></a>
                    </div>
                    @endforeach
                </div>
            @endif
        </main>
    </div>
</body>
</html>