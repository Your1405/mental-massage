<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afspraak add</title>
</head>
<body>
    <h1>Afspraak add</h1>

    <form class="flex-column user-registration-form gap-medium" action="/clienten/add" method="POST" enctype="multipart/form-data">
        @csrf
        <section class="flex-column form-container">
            <h2>Afspraak datum</h2>
            <label for="afspraakDatum">Datum</label>
            <input type="date" name="afspraakDatum" required>

            <label for="afspraakBegintijd">Begin tijd</label>
            <input type="time" name="afspraakBegintijd" required>

            <label for="afspraakEindtijd">Eind tijd</label>
            <input type="time" name="afspraakEindtijd" required>

            <label for="afspraakOmschrijving">afspraak omschrijving</label>
            <input type="Text" name="afspraakOmschrijving" required>
        </section>
    </form>
</body>
</html>