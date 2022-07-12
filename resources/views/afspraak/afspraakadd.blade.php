<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('links')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <title>Mental Massage | Afspraak Maken</title>
</head>
<body>
    @include('dashboard-header')
    <div class="dashboard-container">
        @include('dashboard-navigation')
        <div class="dashboard-content-container">
            <a href="/afspraken"><i class="fa-solid fa-arrow-left"></i></a>
            <h1>Maak een afspraak</h1>
            <form class="flex-column user-registration-form gap-medium" action="/clienten/add" method="POST" enctype="multipart/form-data">
                @csrf
                <section>
                    <h2>Met welke client wilt u een afspraak maken?</h2>
                    <select id='selUser' name="client" style="width: 400px">
                        <option></option>
                    </select>
                </section>
    
                <section class="flex-column form-container">
                    <h2>Afspraak Informatie</h2>
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
        </div>
    <script>
        var CSRF_TOKEN = $('input[name="_token"]').attr('content');
        $(document).ready(function(){
            $( "#selUser" ).select2({
                placeholder: 'Zoek een client',
                ajax: { 
                url: "/client-search",
                type: "get",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                    _token: CSRF_TOKEN,
                    query: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                    results: response
                    };
                },
                cache: true
                }
            });
        });
    </script>
</body>
</html>