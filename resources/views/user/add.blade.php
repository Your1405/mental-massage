<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/storage/styles/main-styles.css') }}">
    <title>Mental Massage | Gebruiker Toevoegen</title>
</head>
<body>
    <h1>Gebruiker toevoegen</h1>
    <a href="/dashboard">Terug naar dashboard</a>
    <!-- This is Login Gegevens --> 
    <div> 
        <form class="flex-column user-registration-form gap-medium" action="/user/add" method="POST">
            @csrf
            <label for="userEmail">Email Adress</label>
            <input type="email" id="userEmail" name="userEmail" placeholder="Email Adress...">

            <label for="userPassword">Wachtwoord:</label>
            <input type="password" id="userPassword" name="userPassword" placeholder="Wachtwoord">
            {{-- <input type="button" value="Generate Password"> --}}

            <label for="userAccountType"> Account Type: </label>
            <select name="userAccountType" id="userAccountType">
                <option value="1">Specialist</option>
                <option value="2">Admin</option>
            </select>

            <input type="submit" value="Voeg nieuwe medewerker toe">
        </form>
        @if($insertStatus == 'success')
            <p>User met userid: {{ $userId }} successvol toegevoegd</p>
        @elseif($insertStatus == 'userExists')
            <p>User met email: {{ $email }} bestaat al!</p>
        @endif
    </div>
</body>
</html>