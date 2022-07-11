<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bent U zeker dat u deze patient wilt archiveren</title>
</head>
<body>

    <form class="flex-column user-registration-form gap-medium" action="/client/archive/{{$id}}" method="POST">
        @csrf
        @method('DELETE')

        @if($archived)
            <label for="confirmation">Bent u zeker dat u de client: {{ $naam['voornaam'] }} {{ $naam['achternaam'] }} wilt de-archiveren</label>
        @else
            <label for="confirmation">Bent u zeker dat u de client: {{ $naam['voornaam'] }} {{ $naam['achternaam'] }} wilt archiveren</label>
        @endif
        
        <button name="confirmation" type="submit" value="1">Ja</button>
        <button name="confirmation" type="submit" value="2">Nee</button>
    </form>
</body>
</html>