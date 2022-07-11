<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('links')
    <title>Mental Massage | Medewerker bewerken</title>
</head>
<body>
    @include('dashboard-header')
    <div class="dashboard-container">
        @include('dashboard-navigation')
        <main class="dashboard-content-container">
            <a href="/users"><i class="fa-solid fa-arrow-left"></i></a>
            <h1>Bewerk gegevens voor gebruiker: {{ $userInfo->userVoornaam }} {{ $userInfo->userNaam }}</h1>
            @if($editStatus == 'emailInUse')
                <p>Email: {{ $inputEmail }} is al in gebruik!<p>
            @elseif($editStatus == 'success')   
                <p>Account succesvol bewerkt</p>
            @endif
            <form action="/user/edit/{{ $userInfo->userId }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <section class="flex-column form-container" data-form-step="1">
                    <h2>Login Gegevens</h2>
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ $userInfo ? $userInfo->userEmail : "" }}">
                    <button type="button" name="page-1-next">Volgende</button>
                </section>
                <section class="hidden flex-column form-container" data-form-step="2">
                    <h2>Persoonlijke Gegevens</h2>
                    <label for="voornaam">Voornaam</label>
                    <input type="text" name="voornaam" id="voornaam" value="{{ $userInfo ? $userInfo->userVoornaam : "" }}" required>
                    <label for="">Achternaam</label>
                    <input type="text" name="achternaam" id="achternaam" value="{{ $userInfo ? $userInfo->userNaam : "" }}" required>
                    <label for="geboorte-datum">Geboorte Datum</label>
                    <input type="date" name="geboorte-datum" id="geboorte-datum" value="{{ $userInfo ? $userInfo->userGeboorteDatum : "" }}" required>
                    <label for="geslacht">Geslacht</label>
                    <select name="geslacht" required>
                    @foreach ($geslachtInfo as $geslacht)
                        @if($userInfo->userGeslacht == $geslacht->geslachtId) 
                            <option selected="selected" value="{{ $geslacht->geslachtId }}">{{ $geslacht->geslachtNaam}}</option>
                        @else
                            <option value="{{ $geslacht->geslachtId }}">{{ $geslacht->geslachtNaam}}</option>
                        @endif
                    @endforeach
                    </select>
                    <label for="specialiteit">Specialiteit</label>
                    <input type="text" name="specialiteit" id="specialiteit" value="{{ $userInfo ? $userInfo->userSpecialty : "" }}" required>
                    <button type="button" name="page-2-prev">Vorige</button>    
                    <button type="button" name="page-2-next">Volgende</button>
                </section>
                <section class="hidden flex-column form-container" data-form-step="3">
                    <h2>Profiel Foto</h2>
                    <p>Huidige profiel foto: </p>
                    <img src="{{ asset("storage/userImages/$userInfo->userProfielfoto") }}" width="48" height="48" >
                    <label for="profiel-foto">Kies een profiel foto: </label>
                    <input type="file" name="profiel-foto" id="profiel-foto" accept=".png, .jpg, .jpeg">
                    <button type="button" name="page-3-prev">Vorige</button>
                    <input type="submit" value="Gegevens opslaan">
                </section>
            </form>
        </main>
    </div>
</body>
</html>