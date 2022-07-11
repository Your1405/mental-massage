<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    function add (Request $request){
        $userType = $request->session()->get('userType');
        $userId = $request->session()->get('userId');

        $soortZorg = DB::table('soortzorg')->select()->get();
        $gezinStatus = DB::table('gezinsleden')->select()->get();
        $burgelijkeStaat = DB::table('burgelijkestaat')->select()->get();
        $ethniciteiten = DB::table('ethniciteiten')->select()->get();
        $geslachten = DB::table('geslacht')->select()->get();
        $verwijzingen = DB::table('verwijzingen')->select()->get();
        $verzekeringsstatus = DB::table('verzekeringstatus')->select()->get();
        $verzekeringsmaatschappijen = DB::table('verzekeringsmaatschappij')->select()->get();

        if($request ->isMethod('GET')){
            return view('clienten.add', [
                'userType' => $userType,
                'userId' => $userId,
                'soortZorg' => $soortZorg,
                'gezinStatus' => $gezinStatus,
                'burgelijkeStaat' => $burgelijkeStaat,
                'ethniciteiten' => $ethniciteiten,
                'geslachten' => $geslachten,
                'verwijzingen' => $verwijzingen,
                'verzekeringsstatus' => $verzekeringsstatus,
                'verzekeringsmaatschappijen' => $verzekeringsmaatschappijen
            ]);
        }else if ($request->isMethod('POST')){
            $clientInfo = $request->all();
           
            $clientNaam = $clientInfo['clientNaam'];
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
            $clientContactPersoon = $clientInfo['contactpersoonnaam'];
            $clientContactPersoonNummer = $clientInfo['contactpersoontel'];
            $clientVerzekeringsStatus = $clientInfo['verzekeringstatus'];
            $clientVerzekeringsMaatschappij = $clientInfo['verzekeringsmaatschappij'];
            $clientVerzekeringsNummer = $clientInfo['verzekeringsnummer'];
            $clientVerzekeringsType = $clientInfo['verzekeringstype'];

        $existingClient = DB::table('clients')->where('clientEmail', '=', $clientEm)->get();
        if($existingClient->count() == 0){
            $clientId = DB::table('clients')->insertGetId([
                'clientNaam' => $clientNaam,
                'clientVoornaam' => $clientVoornaam,
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
                'clientContactPersoonNaam' => $clientContactPersoon,
                'clientContactPersoonNummer' => $clientContactPersoonNummer,
                'clientVerzekeringsStatus' => $clientVerzekeringsStatus,
                'clientVerzekeringsMaatschappij' => $clientVerzekeringsMaatschappij,
                'clientVerzekeringsNummer' => $clientVerzekeringsNummer,
                'clientVerzekeringsType' => $clientVerzekeringsType
            ]);

            DB::table('client_specialisten')->insert([
                'clientId' => $clientId,
                'userId' => $userId
            ]);
            
            return redirect("/client/view/$clientId");

            } else {
                return view('clienten.add', [
                    'clientId'=>null,
                    'insertStatus'=>'userExists',
                    'email'=>$clientEm,
                    'userType' => $userType,
                    'userId' => $userId,
                    'soortZorg' => $soortZorg,
                    'gezinStatus' => $gezinStatus,
                    'burgelijkeStaat' => $burgelijkeStaat,
                    'ethniciteiten' => $ethniciteiten,
                    'geslachten' => $geslachten,
                    'verwijzingen' => $verwijzingen
                ]);
            }
        }
    }

    function archive (Request $request, $id){
        $clientInfo = DB::table('clients')
        ->select(['clientId','clientVoornaam', 'clientNaam','clientBehandelingStatus'])
        ->where('clientId', '=', $id)
        ->get()->first();

        if($request->isMethod('GET')){
            if($clientInfo->clientBehandelingStatus == 0){
                return view('clienten.archiveconfirm', [
                    'archived' => false,
                    'naam' => [
                        'voornaam' => $clientInfo->clientVoornaam,
                        'achternaam' => $clientInfo->clientNaam
                    ],
                    'id' => $id
                ]);
            } else if($clientInfo->clientBehandelingStatus == 1){
                return view('clienten.archiveconfirm', [
                    'archived' => true,
                    'naam' => [
                        'voornaam' => $clientInfo->clientVoornaam,
                        'achternaam' => $clientInfo->clientNaam
                    ],
                    'id' => $id
                ]);
            }
        } else if($request->isMethod('DELETE')){
            $confirmation = $request->get('confirmation');
            if($confirmation == 1){
                if($clientInfo->clientBehandelingStatus == 0){
                    DB::table('clients')
                    ->where('clientId', '=', $id)
                    ->update([
                        'clientBehandelingStatus' => 1
                    ]);
                } else if($clientInfo->clientBehandelingStatus == 1){
                    DB::table('clients')
                    ->where('clientId', '=', $id)
                    ->update([
                        'clientBehandelingStatus' => 0
                    ]);
                }

                return redirect('/clienten');
            } else {
                return redirect('/clienten');
            }
        }
    }

    function edit (Request $request){
        return view('patientedit');
    }

    function view(Request $request, $id){
        $userId = $request->session()->get('userId');
        $userType = $request->session()->get('userType');

        $specialistClient = DB::table('client_specialisten')->select()
        ->where('clientId', '=', $id)
        ->where('userId', '=', $userId)
        ->get();
        
        if($userType == 'admin' || count($specialistClient) != 0 ){
            $clientInfo = DB::table('clients')
            ->join('soortzorg', 'soortzorg.zorgId', '=', 'clients.soortZorg')
            ->join('gezinsleden', 'gezinsleden.gezinsLidId', '=', 'clients.clientGezinStatus')
            ->join('burgelijkestaat', 'burgelijkestaat.burgelijkeStaatId', '=', 'clients.clientBurgelijkeStaat')
            ->join('ethniciteiten', 'ethniciteiten.ethniciteitId', '=', 'clients.clientEthniciteit')
            ->join('geslacht', 'geslacht.geslachtId', '=', 'clients.clientGeslacht')
            ->join('verwijzingen', 'verwijzingen.verwijzingId', '=', 'clients.clientVerwijzing')
            ->join('verzekeringstatus', 'verzekeringstatus.verzekeringStatusId', '=', 'clients.clientVerzekeringsStatus')
            ->join('verzekeringsmaatschappij', 'verzekeringsmaatschappij.verzekeringsMaatschappijId', '=', 'clients.clientVerzekeringsMaatschappij')
            ->select([
                'clients.*',
                'soortzorg.zorgBeschrijving', 
                'gezinsleden.gezinsLidBeschrijving', 
                'burgelijkestaat.burgelijkeStaatBeschrijving', 
                'ethniciteiten.ethniciteitBeschrijving', 
                'geslacht.geslachtNaam', 
                'verwijzingen.verwijzingNaam',
                'verzekeringstatus.verzekeringsStatus',
                'verzekeringsmaatschappij.verzekeringsMaatschappijNaam'
                ])
            ->where('clientId', '=', $id)
            ->get()->first();

            // SELECT clients.*, soortzorg.zorgBeschrijving, gezinsleden.gezinsLidBeschrijving, burgelijkestaat.burgelijkeStaatBeschrijving, ethniciteiten.ethniciteitBeschrijving, geslacht.geslachtNaam, verwijzingen.verwijzingNaam FROM `clients`
            //     JOIN soortZorg ON soortzorg.zorgId = clients.soortZorg
            //     JOIN gezinsleden ON gezinsleden.gezinsLidId = clients.clientGezinStatus 
            //     JOIN burgelijkestaat ON burgelijkestaat.burgelijkeStaatId = clients.clientBurgelijkeStaat
            //     JOIN ethniciteiten ON ethniciteiten.ethniciteitId = clients.clientEthniciteit
            //     JOIN geslacht ON geslacht.geslachtId = clients.clientGeslacht
            //     JOIN verwijzingen ON verwijzingen.verwijzingId = clients.clientVerwijzing

            return view('clienten.view', [
                'userType' => $userType,
                'clientInfo' => $clientInfo
            ]);
        }

        return redirect('/forbidden');
    }

    function overzicht(Request $request){
        $userType = $request->session()->get('userType');
        $userId = $request->session()->get('userId');

        if($request->isMethod('GET')){
            $clientInfo = '';
            if($userType == 'admin'){
                $clientInfo = DB::table('client_specialisten')
                ->join('clients', 'clients.clientId', '=', 'client_specialisten.clientId')
                ->join('soortzorg', 'clients.soortZorg', '=', 'soortzorg.zorgId')
                ->join('geslacht', 'clients.clientGeslacht', '=', 'geslacht.geslachtId')
                ->select([
                    'clients.clientId',
                    'clients.clientVoornaam',
                    'clients.clientNaam',
                    'soortzorg.zorgBeschrijving',
                    'clients.clientGeboorteDatum',
                    'clients.clientRegistratieDatum',
                    'clients.clienttelefoonNummer',
                    'clients.clientEmail',
                    'geslacht.geslachtNaam'
                ])
                ->where('clients.clientBehandelingStatus', '<>', 2)
                ->get();
            } else {
                $clientInfo = DB::table('client_specialisten')
                ->join('clients', 'clients.clientId', '=', 'client_specialisten.clientId')
                ->join('soortzorg', 'clients.soortZorg', '=', 'soortzorg.zorgId')
                ->join('geslacht', 'clients.clientGeslacht', '=', 'geslacht.geslachtId')
                ->select([
                    'clients.clientId',
                    'clients.clientVoornaam',
                    'clients.clientNaam',
                    'soortzorg.zorgBeschrijving',
                    'clients.clientGeboorteDatum',
                    'clients.clientRegistratieDatum',
                    'clients.clienttelefoonNummer',
                    'clients.clientEmail',
                    'geslacht.geslachtNaam'
                ])
                ->where('clients.clientBehandelingStatus', '<>', 2)
                ->where('client_specialisten.userId', '=', $userId)
                ->get();
            }

            return view('clienten.overzicht',[
                'clientInfo' => $clientInfo,
                'userType' => $userType
            ]);
        }    
    
            return view('clienten.patientview');
    }

    function add_ziektes(){

    }
}
