<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medewerker;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Translation\Provider\NullProvider;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\NullsafeMethodCall;

class UserController extends Controller
{
    function login(Request $request){
        //check for http method used
        if($request->isMethod('POST')){
            //get user input values
            $email = $request->input('email');
            $password = $request->input('password');

            //check if user account exists
            $userAccount = DB::table('medewerker')->where('userEmail', '=', $email)->get();

            //convert to associative array
            $userAccountArray = json_decode(json_encode($userAccount->toArray()), true);
            if(sizeOf($userAccountArray) == 0){
                return view('login', ['loginError'=>'userNotExists']);
            } else {
                $userId = $userAccountArray[0]['userId'];
                if($email == $userAccountArray[0]['userEmail']){
                    if (Hash::check($password, $userAccountArray[0]['userPassword'])){                
                        if($userAccountArray[0]['userAccountTypeId'] == 2){
                            session([
                                'userType'=>'admin',
                                'userId'=>$userId
                            ]);
                            return redirect('/dashboard');
                        } else if ($userAccountArray[0]['userAccountTypeId'] == 1){
                            session([
                                'userType'=>'specialist',
                                'userId'=>$userId
                            ]);
                            return redirect('/dashboard');
                        } else {
                            return view('login', ['loginError'=>'email']);
                        }
                    } else {
                        return view('login', ['loginError'=>'password']);
                    }
                }
            }
        }
        else if($request->isMethod('get')){
            return view('login', ['loginError'=>null]);
        }
    }

    function add(Request $request){
        if($request->isMethod('get')){
            return view('user.add', [
                'userId'=> null,
                'insertStatus'=> null,
                'email'=>null,
                'userType'=>'admin'
            ]);
        } else if ($request->isMethod('POST')){
            $userInfo = $request->all();

            $email = $userInfo['userEmail'];
            $password = $userInfo['userPassword'];
            $acctype = $userInfo['userAccountType'];

            $existingUser = DB::table('medewerker')->where('userEmail', '=', $email)->get();
            if($existingUser->count() == 0){
                DB::table('medewerker')->insert([
                    'userAccountTypeId' => $acctype,
                    'userEmail' => $email,
                    'userPassword' => Hash::make($password)
                ]);

                $userIdArray = DB::table('medewerker')->select('userId')->where('userEmail', '=', $email)->get()->toArray();

                $userId = json_decode(json_encode($userIdArray), true);

                DB::table('medewerker_info')->insert([
                    'userId'=>$userId[0]['userId']
                ]);

                return view('user.add', [
                    'userId'=>$userId[0]['userId'],
                    'insertStatus'=>'success',
                    'email'=>$email,
                    'userType'=>'admin'
                ]);
            } else {
            return view('user.add', [
                'userId'=>null,
                'insertStatus'=>'userExists',
                'email'=>$email,
                'userType'=>'admin'
            ]);
           }
        }
    }

    function useredit(){
        return view('user.edit');
    }

    function userarchive(){
        return view('user.archive');
    }

    function overzicht(Request $request){
        if($request->isMethod('get')){
            $userInfo = DB::table('medewerker')
            ->join('useraccounttype', 'medewerker.userAccountTypeId', '=', 'useraccounttype.userAccountTypeId')
            ->join('medewerker_info', 'medewerker.userId', '=', 'medewerker_info.userId')
            ->select([
                'medewerker.userId',
                'medewerker.userEmail',
                'medewerker_info.userVoornaam',
                'medewerker_info.userNaam', 
                'useraccounttype.userAccountDescription',
                'medewerker_info.userGeboorteDatum',
                'medewerker_info.userGeslacht', 
                'medewerker_info.userProfielfoto', 
                'medewerker_info.userSpecialty'
            ])
            ->get();

            $userInfoArray = json_decode(json_encode($userInfo->toArray()), true);
            return view('user.overzicht', [
                'userInfo'=>$userInfoArray,
                'userType'=>'admin'
            ]);
        }
    }

    function view(Request $request, $id){
        // if($request->isMethod('GET')){
        //     DB::table()
        //     return view('user.view');
        // }
    }

    function logout(Request $request){
        $request->session()->flush();
        return redirect('/login');
    }
}
