<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            //if size == 0, the database row for the specified email is empty, which means the user doesn't exist
            if(sizeOf($userAccountArray) == 0){
                //return login view, where a variable for errors is sent with the view
                return view('login', ['loginError'=>'userNotExists']);
            } else {
                $userId = $userAccountArray[0]['userId'];
                if($email == $userAccountArray[0]['userEmail']){
                    /*
                        Hash::check is a function which compares the user's password in the database
                        with the input password
                    */
                    if (Hash::check($password, $userAccountArray[0]['userPassword'])){
                        if($userAccountArray[0]['userFirstLogin'] == 0){
                            if($userAccountArray[0]['userAccountTypeId'] == 2){
                                /*
                                    session() sets a session storage variable, which is important data that is 
                                    stored on the user's pc. Basically a cookie.
                                */
                                 session([
                                    'userType'=>'admin',
                                    'userId'=>$userId
                                ]);
                                return redirect('/register');
                            } else if ($userAccountArray[0]['userAccountTypeId'] == 1){
                                session([
                                    'userType'=>'specialist',
                                    'userId'=>$userId
                                ]);
                                return redirect('/register');
                            }
                        } else {
                            if($userAccountArray[0]['userAccountTypeId'] == 2){
                                /*
                                    session() sets a session storage variable, which is important data that is 
                                    stored on the user's pc. Basically a cookie.
                                */
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
                            }
                        }             
                    } else {
                        return view('login', ['loginError'=>'wrongPassword']);
                    }
                }
            }
        }
        // if you request the page without submitting anything, you will get a view back with no errors.
        else if($request->isMethod('get')){
            return view('login', ['loginError'=>null]);
        }
    }

    function register(Request $request){
        $userId = $request->session()->get('userId');
        $geslachtInfo = DB::table('geslacht')->select()->get();
        $userLoginInfo = DB::table('medewerker')->select('userEmail')->where('userId', '=', $userId)->get();
        $userLoginArray = json_decode(json_encode($userLoginInfo->toArray()), true);

        if($request->isMethod('GET')){
            return view('user.register', [
                'geslachten' => $geslachtInfo,
                'userLoginInfo' => $userLoginArray[0],
                'filledInfo'=> null,
                'registerStatus' => null
            ]);
        } else if($request->isMethod('POST')){
            $userInput = $request->all();

            $userEmail = $userInput['email'];
            $userPassword = $userInput['password'];
            $confirmationPassword = $userInput['confirm-password'];
            if($userPassword == $confirmationPassword){
                $hashedPassword = Hash::make($userPassword);

                DB::table('medewerker')
                ->where('userId', '=', $userId)
                ->update([
                    'userPassword'=>$hashedPassword,
                    'userFirstLogin'=>1
                ]);

                $voornaam = $userInput['voornaam'];
                $achternaam = $userInput['achternaam'];
                $geboortedatum = $userInput['geboorte-datum'];
                $geslacht = $userInput['geslacht'];
                $specialiteit = $userInput['specialiteit'];

                $pfp_name = "user-".$userId."-".Carbon::now()->format('Y-m-d-H-i-s-A').".png";
                $user_pfp = $request->file('profiel-foto');
                $user_pfp->move(public_path('userImages'), $pfp_name);

                DB::table('medewerker_info')->where('userId', '=', $userId)
                ->update([
                    'userNaam'=>$achternaam,
                    'userVoornaam'=>$voornaam,
                    'userGeboortedatum'=>$geboortedatum,
                    'userGeslacht'=>$geslacht,
                    'userProfielFoto'=>$pfp_name,
                    'userSpecialty'=>$specialiteit
                ]);

                return redirect('/dashboard');
            } else {
                return view('user.register', [
                    'geslachten' => $geslachtInfo,
                    'userLoginInfo' => $userLoginArray[0],
                    'filledInfo' => $userInput,
                    'registerStatus' => 'nonMatchingPasswords'
                ]);
            }
        }
    }

    // This function adds users
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
            ->join('geslacht', 'medewerker_info.userGeslacht', '=', 'geslacht.geslachtId')
            ->select([
                'medewerker.userId',
                'medewerker.userEmail',
                'medewerker_info.userVoornaam',
                'medewerker_info.userNaam', 
                'useraccounttype.userAccountDescription',
                'medewerker_info.userGeboorteDatum',
                'geslacht.geslachtNaam', 
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
        if($request->isMethod('GET')){
            $userType = $request->session()->get('userType');
            if ($userType == 'admin'){
                $userInfo = DB::table('medewerker')
                ->join('useraccounttype', 'medewerker.userAccountTypeId', '=', 'useraccounttype.userAccountTypeId')
                ->join('medewerker_info', 'medewerker.userId', '=', 'medewerker_info.userId')
                ->join('geslacht', 'medewerker_info.userGeslacht', '=', 'geslacht.geslachtId')
                ->select([
                    'medewerker.userId',
                    'medewerker.userEmail',
                    'medewerker_info.userVoornaam',
                    'medewerker_info.userNaam', 
                    'useraccounttype.userAccountDescription',
                    'medewerker_info.userGeboorteDatum',
                    'geslacht.geslachtNaam', 
                    'medewerker_info.userProfielfoto', 
                    'medewerker_info.userSpecialty'
                ])
                ->where('medewerker.userId', '=', $id)
                ->get();

                $userInfoArray = json_decode(json_encode($userInfo->toArray()[0]), true);

                if(sizeof($userInfoArray) == 0){
                    return view('user.view', [
                        'userInfo' => null,
                        'exists' => false,
                        'userType' => $userType
                    ]);
                } else {
                    return view('user.view', [
                        'userInfo' => $userInfoArray,
                        'exists' => true,
                        'userType' => $userType
                    ]);
                }

            } else {
                return redirect('/forbidden');
            }
        }
    }

    function logout(Request $request){
        $request->session()->flush();
        return redirect('/login');
    }
}
