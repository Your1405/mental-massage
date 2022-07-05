@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('links')
    <title>Mental Massage | Overzicht Gebruikers</title>
</head>
<body>
    @include('dashboard-header')
    <div class="dashboard-container">
        @include('dashboard-navigation')
        <div class="dashboard-content-container">
            <div class="overzicht-container">
                <h1>Gebruikers</h1>
                <p>Totaal: {{ sizeOf($userInfo) }}</p>
                <div class="overzicht-header grid">
                    <p>Naam</p>
                    <p>Email Address</p>
                    <p>Leeftijd</p>
                    <p>Geslacht</p>
                    <p>Specialiteit</p>
                </div>
                @foreach($userInfo as $user)
                <div class="overzicht-item flex-row gap-xl">
                    @php
                        $leeftijd = Carbon::parse($user['userGeboorteDatum'])->age;
                        $userPfp = $user['userProfielfoto'];
                        $userId = $user['userId'];
                    @endphp
                    <img src="{{ asset("storage/userImages/$userPfp") }}" width="48" height="48" >
                    <p>{{ $user['userNaam'] }} {{ $user['userVoornaam']}}</p>
                    <p>{{ $user['userEmail'] }}</p>
                    <p>{{ $leeftijd }}</p>
                    <p>{{ $user['geslachtNaam'] }}</p>
                    <p>{{ $user['userSpecialty'] }}</p>
                    <a href="/user/edit/{{$userId}}"><i class="fa-solid fa-pen"></i></a>
                    <a href="/user/delete/{{$userId}}"><i class="fa-solid fa-trash-can"></i></a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>