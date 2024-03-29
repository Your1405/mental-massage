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
                <section class="flex-column form-container">
                    <h2>Login Gegevens</h2>
                    @if ($registerStatus == 'nonMatchingPasswords')
                        <p class="error-message">De wachtwoorden komen niet overeen. Graag opnieuw invullen!</p>
                    @endif
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" class="input-field" value="{{ $userLoginInfo ? $userLoginInfo['userEmail'] : "" }}" readonly>
                    <div class="flex-column" style="margin-top: 1em;">
                        <label for="password">Nieuw wachtwoord</label>
                        <p style="color: var(--primary-color); margin: -0.1em 0;">*Zorg ervoor dat u een uniek wachtwoord gebruikt!</p>
                    </div>
                    <input type="password" name="password" id="password" class="input-field" required>
                    <label for="confirm-password">Opnieuw uw wachtwoord</label>
                    <input type="password" name="confirm-password" id="confirm-password" class="input-field" required>
                </section>

                <section class="hidden flex-column form-container">
                    <h2>Persoonlijke Gegevens</h2>
                    <label for="voornaam">Voornaam</label>
                    <input type="text" name="voornaam" id="voornaam" class="input-field" required>
                    <label for="achternaam">Achternaam</label>
                    <input type="text" name="achternaam" id="achternaam" class="input-field" required>
                    <label for="geboorte-datum">Geboorte Datum</label>
                    <input type="date" name="geboorte-datum" id="geboorte-datum" class="input-field" required>
                    <label for="geslacht">Geslacht</label>
                    <select name="geslacht" class="dropdown-input" required>
                    @foreach ($geslachten as $geslacht)
                        <option value="{{ $geslacht->geslachtId }}">{{ $geslacht->geslachtNaam}}</option>
                    @endforeach
                    </select>
                    <label for="specialiteit">Specialiteit</label>
                    <input type="text" name="specialiteit" id="specialiteit" class="input-field" required>
                </section>
                
                <section class="hidden flex-column form-container">
                    <h2>Profiel Foto</h2>
                    <label for="profiel-foto">Kies een profiel foto: </label>
                    <div class="flex-column">
                        <input type="file" name="profiel-foto" id="profiel-foto" class="image-upload" accept=".png, .jpg, .jpeg" required>
                        <input type="submit" value="Gegevens opslaan" class="submit-form submit-input">
                    </div>
                </section>
            </form>
        </main>
    </div>
</body>
</html>