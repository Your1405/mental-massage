<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    function client_search(Request $request){

        if($request->ajax()){
            $data = '';
            $query = $request->get('query');
            if($query != '') {
                $data = DB::table('clients')
                    ->where('clientVoornaam', 'like', '%'.$query.'%')
                    ->orWhere('clientNaam', 'like', '%'.$query.'%')
                    ->orWhere('clientEmail', 'like', '%'.$query.'%')
                    ->orderBy('clientId', 'desc')
                    ->limit(10)
                    ->get(); 
                    
            } else if($query == ''){
                $data = DB::table('clients')->orderBy('clientId', 'desc')->limit(10)->get();
            }

            $response = array();
            foreach($data as $client){
                $response[] = array(
                    "id" => $client->clientId,
                    "text"=> $client->clientVoornaam.' '.$client->clientNaam.' | '.$client->clientEmail,
                );
            }
                
            return response()->json($response);
        }
    }
}
