<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('links')
    <title>Mental Massage | First Time Login</title>
</head>
<body>
    @include('dashboard-header')
    <div class="dashboard-container">
        @include('dashboard-navigation')
        <main class="dashboard-content-container">
            <h1>Welkom bij Mental Massage gebruiker</h1>
            <p>Dit is uw eerste login, graag uw gegevens hieronder invullen: </p>
            <form action="/register" method="POST" enctype="multipart/form-data">
                @csrf
                <section class="flex-column form-container" data-form-step="1">
                    <h2>Login Gegevens</h2>
                    @if ($registerStatus == 'nonMatchingPasswords')
                        <p>De wachtwoorden komen niet overeen. Graag opnieuw invullen!</p>
                    @endif
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ $userLoginInfo ? $userLoginInfo['userEmail'] : "" }}" readonly>
                    <label for="password">Nieuw wachtwoord</label>
                    <p>*Zorg ervoor dat u een uniek wachtwoord gebruikt!</p>
                    <input type="password" name="password" id="password" required>
                    <label for="confirm-password">Opnieuw uw wachtwoord</label>
                    <input type="password" name="confirm-password" id="confirm-password" required>

                    <button type="button" name="page-1-next">Volgende</button>
                </section>

                <section class="hidden flex-column form-container" data-form-step="2">
                    <h2>Persoonlijke Gegevens</h2>
                    <label for="voornaam">Voornaam</label>
                    <input type="text" name="voornaam" id="voornaam" required>
                    <label for="">Achternaam</label>
                    <input type="text" name="achternaam" id="achternaam" required>
                    <label for="geboorte-datum">Geboorte Datum</label>
                    <input type="date" name="geboorte-datum" id="geboorte-datum" required>
                    <label for="geslacht">Geslacht</label>
                    <select name="geslacht" required>
                    @foreach ($geslachten as $geslacht)
                        <option value="{{ $geslacht->geslachtId }}">{{ $geslacht->geslachtNaam}}</option>
                    @endforeach
                    </select>
                    <label for="specialiteit">Specialiteit</label>
                    <input type="text" name="specialiteit" id="specialiteit" required>
                    <button type="button" name="page-2-prev">Vorige</button>
                    <button type="button" name="page-2-next">Volgende</button>
                </section>
                
                <section class="hidden flex-column form-container" data-form-step="3">
                    <h2>Profiel Foto</h2>
                    <label for="profiel-foto">Kies een profiel foto: </label>
                    <input type="file" name="profiel-foto" id="profiel-foto" accept=".png, .jpg, .jpeg" required>
                    <button type="button" name="page-3-prev">Vorige</button>
                    <input type="submit" value="Gegevens opslaan">
                </section>
            </form>
        </main>
    </div>
</body>
</html>