<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('links')
    <title>Mental Massage | Login</title>
</head>
<body>
    <header class="header-container">
        <div class="logo-container flex-row">
            <a href="/" class="logo-link"><img src="{{ asset('storage/images/logo-color.png') }}" alt="mental massage logo" width="96" height="96" class="logo"></a>
            <h1>Mental Massage</h1>
        </div>
    </header>
    <main class="main-content flex-row">
        <div class="image-container">
            <img src="{{ asset('storage/images/mental-health.png') }}" alt="mental health picture" width="256" height="256">
        </div>
        <div class="form-container">
            <h2>Inloggen</h2>
            <form method="POST" action="/login" class="form flex-column">
                @csrf
                <span class="flex-column gap-medium">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="text-input" placeholder="Email addres..." required>
                </span>
                <span class="flex-column gap-medium">
                    <label for="password">Wachtwoord</label>
                    <input type="password" name="password" id="password" class="text-input" placeholder="Wachtwoord..." required>
                </span>
                <span class="flex-row">
                    <input type="submit" value="Inloggen" class="submit-input">
                    <a href="#" class="action-link">Wachtwoord vergeten</a>
                </span>
            </form>
            @if($loginError == 'wrongPassword')
                <p class="error-message">Verkeerd wachtwoord!</p>
            @elseif($loginError == 'userNotExists')
                <p class="error-message">Gebruiker bestaat niet, maak contact met de admin van de webapp voor toegang<p>
            @endif
        </div>
    </main>
    <footer class="footer-container">
        <div class="footer-content-container flex-row">
            <p>Made by: Team EASY!</p>
            <p>&copy; 2022 Mental Massage, All rights reserved</p>
        </div>
    </footer>
</body>
</html>