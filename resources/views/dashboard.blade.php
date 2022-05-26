<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('storage/styles/main-styles.css') }}">
    <title>Mental Massage | Dashboard</title>
</head>
<body>
    <header class="header-container">
        <div class="logo-container flex-row">
            <a href="/" class="logo-link"><img src="{{ asset('storage/images/logo-color.png') }}" alt="mental massage logo" width="96" height="96" class="logo"></a>
            <h1>Mental Massage</h1>
            <div class="flex-row logout-container">
                <img src="{{ asset('storage/images/icons/logout.svg') }}">
                <a href="/login">Logout</a>
            </div>
        </div>
    </header>
    <div class="grid-container">
        @include('user.dashboard-navigation')
        <main  class="dashboard-content-container">
            <h1>Dashboard :)</h1>
        </main>
    </div>
</body>
</html>