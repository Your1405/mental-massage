<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class AfspraakController extends Controller
{
    function add (Request $request){
        $userId= $request ->session()->get('userId');
        $userType= $request ->session()->get('userType');

        if($request ->isMethod('GET')){
            return view('afspraak.afspraakadd', [
                'userType' => $userType,
                'userId' => $userId,
            ]);
        }
        else if ($request->isMethod('POST')){
            $afspraakInfo = $request->all();
            $clientId = $afspraakInfo['clientSelect'];
            $afspraakDatum = $afspraakInfo['afspraakDatum'];
            $afspraakBegintijd = $afspraakInfo['afspraakBegintijd'];
            $afspraakEindtijd = $afspraakInfo['afspraakEindtijd'];
            $afspraakOmschrijving = $afspraakInfo['afspraakOmschrijving'];


            DB::table('afspraken')->insert([
                'clientId' => $clientId,
                'userId' => $userId,
                'afspraakDatum' => $afspraakDatum,
                'afspraakBegintijd' => $afspraakBegintijd,
                'afspraakEindtijd' => $afspraakEindtijd,
                'afspraakOmschrijving' => $afspraakOmschrijving,
            ]);

            $client_specialisten = DB::table('client_specialisten')
                ->where('clientId', '=', $clientId)
                ->where('userId', '=', $userId)
            ->get();

            if(count($client_specialisten) == 0){
                DB::table('client_specialisten')->insert([
                    'userId' => $userId,
                    'clientId' => $clientId
                ]);
            }

            return redirect('/afspraken');
        }
    }

    function add_user(){

    }

    function archive (){
        return view('afspraakarchive');
    }

    function edit (){
        return view('afspraakedit');
    }
    
    function view (){
        return view('afspraakview');
    }

    function view_user(){

    }

    function overzicht(Request $request){
        $userType = $request->session()->get('userType');
        $userId = $request->session()->get('userId');
        
        $afspraakInfo = collect();

        if($userType == 'admin'){
            $afspraakInfo = DB::table('afspraken')
            ->join('clients', 'clients.clientId', '=', 'afspraken.clientId')
            ->select('clients.*', 'afspraken.*')
            ->where('afspraakStatus', '=', 0)
            ->get();
        } else {
            $afspraakInfo = DB::table('afspraken')
            ->join('clients', 'clients.clientId', '=', 'afspraken.clientId')
            ->select('clients.*', 'afspraken.*')
            ->where('afspraakStatus', '=', 0)
            ->where('userId', '=', $userId)
            ->get();
        }

        return view('afspraak.overzicht', [
            'afspraakInfo' => $afspraakInfo,
            'userType' => $userType
        ]);
    }
}
