<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('links')
    <script defer type="text/javascript" src="{{asset('storage/js/verzekering-input-check.js')}}"></script>
    <title>Mental Massage | Voeg een client toe</title>
</head>
<body>
    @include('dashboard-header')
    <div class="dashboard-container">
        @include('dashboard-navigation')
        <main class="dashboard-content-container">
            <a href="/clienten"><i class="fa-solid fa-arrow-left"></i></a>
            <h1>Voeg een client toe</h1>
            <form class="flex-column user-registration-form gap-medium" action="/clienten/add" method="POST" enctype="multipart/form-data">
                @csrf
                <section class="flex-column form-container">
                    <h2>Persoonlijke Informatie</h2>
                    <label for="clientNaam">Achternaam</label>
                    <input type="text" name="clientNaam" required>

                    <label for="clientVoornaam">Voornaam</label>
                    <input type="text" name="clientVoornaam" required>

                    <label for="clientGeboorteDatum">Geboorte Datum</label>
                    <input type="date" name="clientGeboorteDatum" required>

                    <label for="clientGeslacht"> Geslacht: </label>
                    <select name="clientGeslacht" id="clientGeslacht" required>
                        @foreach($geslachten as $geslacht)
                            <option value="{{ $geslacht->geslachtId}}">{{ $geslacht->geslachtNaam }}</option>
                        @endforeach
                    </select>

                    <label for="clientGezinStatus">Client Gezin status</label>
                    <select name="clientGezinStatus" id="clientGezinStatus" required>
                        @foreach($gezinStatus as $gezinslid)
                            <option value="{{ $gezinslid->gezinsLidId }}">{{ $gezinslid->gezinsLidBeschrijving }}
                        @endforeach
                    </select>

                    <label for="clientBurgelijkeStaat">Burgelijke Staat</label>
                    <select name="clientBurgelijkeStaat" id="clientBurgelijkeStaat" required>
                        @foreach($burgelijkeStaat as $burgelijkestaat)
                            <option value="{{ $burgelijkestaat->burgelijkeStaatId }}">{{ $burgelijkestaat->burgelijkeStaatBeschrijving }}
                        @endforeach
                    </select> 

                    <label for="clientEthniciteit">Ethniciteit</label>
                    <select name="clientEthniciteit" id="clientEthniciteit" required>
                        @foreach($ethniciteiten as $ethniciteit)
                            <option value="{{ $ethniciteit->ethniciteitId }}">{{ $ethniciteit->ethniciteitBeschrijving }}
                        @endforeach
                    </select>  
                    
                    <label for="clientOpleiding">Hoogste Opleiding</label>
                    <input type="text" name="clientOpleiding" required>

                    <label for="clientBeroep">Beroep</label>
                    <input type="text" name="clientBeroep" required>

                    <label for="clientWerkgever">Werkgever</label>
                    <input type="text" name="clientWerkgever">

                    <button type="button" name="page-1-next">Volgende</button>
                </section>

                <section class="flex-column form-container">
                    <h2>Contact Informatie</h2>
                    <label for="clientEmail">Email</label>
                    <input type="text" name="clientEmail" required>

                    <label for="clienttelefoonNummer">Telefoon Nummer</label>
                    <input type="number" name="clienttelefoonNummer">

                    <label for="clientHuisTelefoonNummer">Huis Telefoon Nummer</label>
                    <input type="number" name="clientHuisTelefoonNummer">

                    <label for="contactpersoonnaam">Naam Contact Persoon</label>
                    <input type="text" name="contactpersoonnaam" required>

                    <label for="contactpersoontel">Telefoon Nummer Contact Persoon</label>
                    <input type="number" name="contactpersoontel">

                    <button type="button" name="page-2-prev">Vorige</button>
                    <button type="button" name="page-2-next">Volgende</button>
                </section>

                <section class="flex-column form-container">
                    <h2>Zorg Informatie</h2>
                    <label for="soortZorg">Wat voor zorg krijgt de client?</label>
                    <select name="soortZorg" id="soortZorg" required>
                        @foreach($soortZorg as $soortzorg)
                            <option value="{{ $soortzorg->zorgId }}">{{ $soortzorg->zorgBeschrijving }}
                        @endforeach
                    </select>

                    <label for="clientRegistratieDatum"> Registratie Datum</label>
                    <input type="date" name="clientRegistratieDatum" required>

                    <label for="clientHuisarts">Naam Huisarts</label>
                    <input type="text" name="clientHuisarts" required>

                    <label for="clientVerwijzing">Hoe is de client te weten gekomen over Mental Massage?</label>
                    <select name="clientVerwijzing" id="clientVerwijzing" required>
                        @foreach($verwijzingen as $verwijzing)
                            <option value="{{ $verwijzing->verwijzingId }}">{{ $verwijzing->verwijzingNaam }}
                        @endforeach
                    </select>

                    <button type="button" name="page-3-prev">Vorige</button>
                    <button type="button" name="page-3-next">Volgende</button>
                </section>
                <section>
                    <h2>Verzekerings Informatie</h2>
                    <p>Is de client verzekerd?</p>
                    <input type="radio" name="verzekeringstatus" id="verzekering_ja" value="1">
                    <label for="verzekering_ja">Ja</label>
                    <input type="radio" name="verzekeringstatus" id="verzekering_nee" value="2">
                    <label for="verzekering_nee">Nee</label>
                    <br>
                    <div id="verzekeringInfo" class="flex-column gap-medium">
                        <label>Verzekerings Maatschappij: </label>
                        <select name="verzekeringsmaatschappij">
                            @foreach($verzekeringsmaatschappijen as $verzekeringsmaatschappij)
                                <option value="{{$verzekeringsmaatschappij->verzekeringsMaatschappijId}}">{{ $verzekeringsmaatschappij->verzekeringsMaatschappijNaam }}</option>
                            @endforeach
                        </select>

                        <label for="verzekeringsnummer">Verzekering Nummer</label>
                        <input type="text" name="verzekeringsnummer" id="verzekeringsnummer">

                        <label for="verzekeringstype">Verzekerings Type</label>
                        <input type="text" name="verzekeringstype" id="verzekeringstype">

                    </div>
                    <input type="submit" name="submit" value="Toevoegen">     
                </section>
            </form>
        </main>
    </div>
</body>
</html>