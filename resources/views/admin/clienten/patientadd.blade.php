<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient toevoegen</title>
</head>
<body>
    <h1>Patient toevoegen :)</h1>
    <form action="/clienten/add" method="POST" enctype="multipart/form-data">
		@csrf	
			
        <div class="form-row" >
        <div class="form-group col-md-6">
        <label for="clientVoornaam">Client Voornaam</label>
        <input type="text" class="form-control" name="clientVoornaam" required>
        </div>
        <div class="form-group col-md-6">
        <label for="soortZorg">What voor zorg heeft de client</label>
        <select name="soortZorg" id="soortZorg" required>
            <option value="1">eenmaalig</option>
            <option value="2">meerderemaalig</option>
        </select>
       </div>
        
        <div class="form-row" >
        <div class="form-group col-md-6">
        <label for="clientGezinStatus">Client Gezin status</label>
        <input type="text" class="form-control" name="clientGezinStatus" >
        </div>
        <div class="form-group col-md-6">
        <label for="clientGeboorteDatum">Client Geboorte Datum</label>
        <input type="date" class="form-control" name="clientGeboorteDatum" required>
        </div>

        <div class="form-row" >
        <div class="form-group col-md-6">
        <label for="clientRegistratieDatum"> Registatratie Datum</label>
        <input type="date" class="form-control" name="clientRegistratieDatum" required>
        </div>
        <div class="form-group col-md-6">
        <label for="clientBurgelijkeStaat">Burgelijkestaat</label>
        <select name="clientBurgelijkeStaat" id="clientBurgelijkeStaat" required>
            <option value="1">gehuwd</option>
            <option value="2">ongehuwd</option>
        </select> 
        </div>

        <div class="form-row" >
        <div class="form-group col-md-6">
        <label for="clienttelefoonNummer">client tel</label>
        <input type="text" class="form-control" name="clienttelefoonNummer" required>
        </div>
        <div class="form-group col-md-6">
        <label for="clientHuisTelefoonNummer">client huis tel</label>
        <input type="text" class="form-control" name="clientHuisTelefoonNummer" required>
        </div>

        <div class="form-row" >
        <div class="form-group col-md-6">
        <label for="clientEmail">client email</label>
        <input type="text" class="form-control" name="clientEmail" required>
        </div>
        <div class="form-group col-md-6">
        <label for="clientEthniciteit">client enthi....</label>
        <select name="clientEthniciteit" id="clientEthniciteit" required>
            <option value="1">Hindustaan</option>
            <option value="2">Javaan</option>
            <option value="3">Indiaan</option>
            <option value="4">Creole</option>
            <option value="5">Chinees</option>
            <option value="6">Mix</option>
            <option value="7">other..</option>
        </select>   
        </div>
        
        
        <div class="form-row" >
        <div class="form-group col-md-6">
            <label for="clientGeslacht"> Gelsacht: </label>
            <select name="clientGeslacht" id="clientGeslacht" required>
                <option value="1">male</option>
                <option value="2">female</option>
                <option value="3">other..</option>
            </select>
        </div>
        <div class="form-group col-md-6">
        <label for="clientHuisarts">client huisarts</label>
        <input type="text" class="form-control" name="clientHuisarts" required>
        </div>

        <div class="form-row" >
        <div class="form-group col-md-6">
        <label for="clientVerwijzing">client verwijzing</label>
        <select name="clientVerwijzing" id="clientVerwijzing" required>
            <option value="1">dokter/specialist</option>
            <option value="2">self</option>
        </select>
        </div>
        <div class="form-group col-md-6">
        <label for="clientOpleiding">client opleiding</label>
        <input type="text" class="form-control" name="clientOpleiding" required>
        </div>

        <div class="form-row" >
        <div class="form-group col-md-6">
        <label for="clientBeroep">client beroep</label>
        <input type="text" class="form-control" name="clientBeroep" required>
        </div>
        <div class="form-group col-md-6">
        <label for="clientWerkgever">client werkgever</label>
        <input type="text" class="form-control" name="clientWerkgever" required>
        </div>

        <div class="form-row" >
        <div class="form-group col-md-6">
        <label for="clientContactPersoonId">client contact persoon ID</label>
        <input type="text" class="form-control" name="clientContactPersoonId">
        </div>
        <div class="form-group col-md-6">
        <label for="clientMedicatie">client medicatie</label>
        <input type="text" class="form-control" name="clientMedicatie" required>
        </div>

        <div class="form-row" >
        <div class="form-group col-md-6">
        <label for="clientOnderliggendeZiekten">client onderliggende ziekten</label>
        <input type="text" class="form-control" name="clientOnderliggendeZiekten" required>
        </div>
        <div class="form-group col-md-6">
        <label for="clientBehandelingStatus">client behandeling status</label>
        <input type="checkbox" id="clientBehandelingStatus" name="clientBehandelingStatus" >
        <label for="clientBehandelingStatus"> Afgekeurd</label><br>
        </div>

                     <input type="submit" name="submit" class="btn btn-info btn-large" value="TOEVOEGEN">
                    
                    
                </form>
            </div>
            </div>
        
          </div>
        </div>
</body>
</html>