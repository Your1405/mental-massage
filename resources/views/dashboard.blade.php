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
    <header class="header-container dashboard-header">
        <div class="logo-container flex-row">
            <a href="/" class="logo-link"><img src="{{ asset('storage/images/logo-color.png') }}" alt="mental massage logo" width="72" height="72" class="logo"></a>
            <h1>Mental Massage</h1>
            <a href="/logout" class="logout-container flex-row">
                <img src="{{ asset('storage/images/icons/logout.svg') }}" width="24" height="24">
                Logout
            </a>
        </div>
    </header>
    <div class="grid-container">
        @include('user.dashboard-navigation')
        <main  class="dashboard-content-container">
            <h1>Dashboard :)</h1>
            @if ($userType == 'admin')
                <h2>I am admin :)</h2>
            @elseif($userType == 'specialist')
                <h2> I am specialist :)</h2>
            @endif
        </main>
    </div>
</body>
</html>