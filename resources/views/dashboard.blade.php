<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('links')
    <title>Mental Massage | Dashboard</title>
</head>
<body>
    @include('dashboard-header')
    <div class="dashboard-container">
        @include('dashboard-navigation')
        <main class="dashboard-content-container">
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