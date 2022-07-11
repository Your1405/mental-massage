<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('links')
    <title>Mental Massage | Gebruiker Toevoegen</title>
</head>
<body>
    @include('dashboard-header')
    <div class="dashboard-container">
        @include('dashboard-navigation')
        <main class="dashboard-content-container">
            <a href="/users"><i class="fa-solid fa-arrow-left"></i></a>
            <h1>Gebruiker toevoegen</h1>
            <!-- This is Login Gegevens --> 
            <form class="flex-column user-registration-form gap-medium" action="/user/add" method="POST">
                @csrf
                <label for="userEmail">Email Adress</label>
                <input type="email" id="userEmail" name="userEmail" placeholder="Email Adress..." required>

                <label for="userPassword">Wachtwoord:</label>
                <input type="password" id="userPassword" name="userPassword" placeholder="Wachtwoord" required>
                {{-- <input type="button" value="Generate Password"> --}}

                <label for="userAccountType"> Account Type: </label>
                <select name="userAccountType" id="userAccountType" required>
                    <option value="1">Specialist</option>
                    <option value="2">Admin</option>
                </select>

                <input type="submit" value="Voeg nieuwe medewerker toe">
            </form>
            @if($insertStatus == 'success')
                <p>User met email: {{ $email }} successvol toegevoegd</p>
                <a href="/user/edit/{{$userId}}">Voer gebruiker gegevens in</a>
            @elseif($insertStatus == 'userExists')
                <p>User met email: {{ $email }} bestaat al!</p>
            @endif
        </main>
    </div>
</body>
</html>