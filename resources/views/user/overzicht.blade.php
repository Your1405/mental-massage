<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('storage/styles/main-styles.css') }}">
    <title>Mental Massage | Overzicht Gebruikers</title>
</head>
<body>
    <div>
        <h1>Overzicht gebruikers</h1>
        <a href="/dashboard">Terug naar dashboard</a>
        <table style='border: solid 1px black; border-collapse: collapse'>
            <tr style="border: solid 1px black;">
                <th>Email</th>
                <th>Type Gebruiker</th>
            </tr>
            @foreach($userInfo as $user)
            <tr>
                <td>{{ $user['userEmail'] }}</td>
                <td>{{ $user['userAccountDescription'] }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
</html>