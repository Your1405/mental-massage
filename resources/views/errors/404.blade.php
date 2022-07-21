<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('links')
    <title>Error page </title>
</head>
<body>
    <header class="header-container">
        <div class="logo-container flex-row">
            <a href="/" class="logo-link"><img src="{{ asset('storage/images/logo-color.png') }}" alt="mental massage logo" width="96" height="96" class="logo"></a>
            <h1>Mental Massage</h1>
        </div>
    </header>
    <center><h1>File not found</h1></center>
    <main class="main-content flex-row">

            <img src="{{ asset('storage/images/error.png') }}" alt="error picture" width="400" height="300">
        
            <span class="flex-row">
                <a href="/dashboard" class="btn1">Dashboard</a>
            </span>
    </main>
    <footer class="footer-container">
        <div class="footer-content-container flex-row">
            <p>Made by: Team EASY!</p>
            <p>&copy; 2022 Mental Massage, All rights reserved</p>
        </div>
    </footer>
</body>
</html>