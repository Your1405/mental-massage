<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    function add (Request $request){
        if($request ->isMethod('get')){
            return view('admin.clienten.patientadd', [
               
            ]);
        }else if ($request->isMethod('post')){
            $clientInfo = $request->all();

           
           $clientVoornaam = $clientInfo['clientVoornaam'];
           $soortZorg = $clientInfo['soortZorg'];
           $clientGS= $clientInfo['clientGezinStatus'];
           $clientGD = $clientInfo['clientGeboorteDatum'];
           $clientRD = $clientInfo['clientRegistratieDatum'];
           $clientBS = $clientInfo['clientBurgelijkeStaat'];
           $clientTN = $clientInfo['clienttelefoonNummer'];
           $clientHTN = $clientInfo['clientHuisTelefoonNummer'];
           $clientEm = $clientInfo['clientEmail'];
           $clientEt = $clientInfo['clientEthniciteit'];
           $clientGeslacht = $clientInfo['clientGeslacht'];
           $clientHA = $clientInfo['clientHuisarts'];
           $clientVerwijzing = $clientInfo['clientVerwijzing'];
           $clientOpleiding = $clientInfo['clientOpleiding'];
           $clientBeroep = $clientInfo['clientBeroep'];
           $clientWerkgever = $clientInfo['clientWerkgever'];
           $clientCPI = $clientInfo['clientContactPersoonId'];
           $clientMed = $clientInfo['clientMedicatie'];
           $clientOZ = $clientInfo['clientOnderliggendeZiekten'];
           $clientBehandelingSatus = $clientInfo['clientBehandelingStatus'];

        $existingClient = DB::table('clients')->where('clientEmail', '=', $clientEm)->get();
        if($existingClient->count() == 0){
            DB::table('clients')->insert([

                'clientVoornaam' =>$clientVoornaam,
                'soortZorg' => $soortZorg,
                'clientGezinStatus' => $clientGS,
                'clientGeboorteDatum' => $clientGD,
                'clientRegistratieDatum' => $clientRD,
                'clientBurgelijkeStaat' =>$clientBS,
                'clienttelefoonNummer' =>  $clientTN, 
                'clientHuisTelefoonNummer' => $clientHTN,
                'clientEmail' => $clientEm,
                'clientEthniciteit' => $clientEt,
                'clientGeslacht' =>  $clientGeslacht,
                'clientHuisarts' => $clientHA,
                'clientVerwijzing' => $clientVerwijzing,
                'clientOpleiding' => $clientOpleiding,
                'clientBeroep' => $clientBeroep,
                'clientWerkgever' => $clientWerkgever,
                'clientContactPersoonId' => $clientCPI,
                'clientMedicatie' => $clientMed,
                'clientOnderliggendeZiekten' => $clientOZ,
                'clientBehandelingStatus' => $clientBehandelingSatus,

            ]);
            
        return view('admin.clienten.patientview');

            // $clientId = DB::table('clients')->select('clientId')->where('clientEmail', '=', $clientEm)->get();
            // return view('admin.clienten.patientadd', [
            //     'clientId'=>$clientId,
            //     'insertStatus'=>'success',
            //     'email'=>$clientEm,
            //     'userType'=>'Specialist'
            // ]);
        } else {
            return view('admin.clienten.patientadd', [
                'clientId'=>null,
                'insertStatus'=>'userExists',
                'email'=>$clientEm,
                'userType'=>'Specialist'
            ]);
        }


        }
      
    }
    function archive (){
        return view('patientarchive');
    }
    function edit (){
        return view('patientedit');
    }
    function view (Request $request){

    if($request->isMethod('get')){
        $clientInfo = DB::table('clients')
        ->select([
            'clients.clientId',
            'clients.clientVoornaam',
            'clients.soortZorg',
            'clients.clientVoornaam',
            'clients.clientGeboorteDatum',
            'clients.clientRegistratieDatum',
            'clients.clientBurgelijkeStaat',
            'clients.clienttelefoonNummer',
            'clients.clientHuisTelefoonNummer',
            'clients.clientEmail',
            'clients.clientEthniciteit',
            'clients.clientGeslacht',
            'clients.clientHuisarts',
            'clients.clientVerwijzing',
            'clients.clientOpleiding',
            'clients.clientBeroep',
            'clients.clientWerkgever',
            'clients.clientContactPersoonId',
            'clients.clientMedicatie',
            'clients.clientOnderliggendeZiekten',
            'clients.clientBehandelingStatus',
            'clients.clientGeboorteDatum',
            'clients.clientRegistratieDatum',
            'clients.clientBurgelijkeStaat',
            'clients.clienttelefoonNummer',
            'clients.clientHuisTelefoonNummer',
            'clients.clientEmail',
            'clients.clientEthniciteit',
            'clients.clientGeslacht',
            'clients.clientHuisarts',
            'clients.clientVerwijzing',
            'clients.clientOpleiding',
            'clients.clientBeroep',
            'clients.clientWerkgever',
            'clients.clientContactPersoonId',
            'clients.clientMedicatie',
            'clients.clientOnderliggendeZiekten',
            'clients.clientBehandelingStatus',

        ])
        ->get();
            $clientInfoArray = json_decode(json_encode($clientInfo->toArray()), true);
            return view('admin.clienten.overzicht',[
                'clientInfo' =>$clientInfoArray,
            ]);

    }    

        return view('admin.clienten.patientview');
    }
}
