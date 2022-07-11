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

        $userType = $request->session()->get('userType');

        if($request->isMethod('GET')){
            return view('user.register', [
                'geslachten' => $geslachtInfo,
                'userLoginInfo' => $userLoginArray[0],
                'filledInfo'=> null,
                'registerStatus' => null,
                'userType' => $userType
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
                $user_pfp->move(public_path('storage/userImages'), $pfp_name);

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
                    'registerStatus' => 'nonMatchingPasswords',
                    'userType' => $userType
                ]);
            }
        }
    }

    // This function adds users
    function add(Request $request){
        $userType = $request->session()->get('userType');
        $userId = $request->session()->get('userId');

        if($userType == "admin"){
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
        } else {
            return redirect('/forbidden');
        }
    }

    function edit(Request $request, $id){
        $userType = $request->session()->get('userType');
        $userId = $request->session()->get('userId');

        if($userType == "admin" || $userId == $id){
            $geslachtInfo = DB::table('geslacht')->select()->get();
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
                    ->where('medewerker.userId', '=', $id)
                    ->get()->first();

            if($request->isMethod('GET')){
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
                    ->where('medewerker.userId', '=', $id)
                    ->get()->first();

                return view('user.edit', [
                    'userInfo' => $userInfo,
                    'geslachtInfo' => $geslachtInfo,
                    'userType' => $userType,
                    'editStatus' => null,
                    'inputEmail' => null
                ]);
            } else if($request->isMethod('PUT')){
                $userInput = $request->all();
                $userEmail = $userInput['email'];

                if(DB::table('medewerker')->where('userEmail', '=', $userEmail)->exists()){
                    if(!$userInfo->userEmail == $userEmail){
                        return view('user.edit', [
                            'userInfo' => $userInfo,
                            'geslachtInfo' => $geslachtInfo,
                            'userType' => $userType,
                            'editStatus' => 'emailInUse',
                            'inputEmail' => $userEmail
                        ]);
                    }
                }

                $voornaam = $userInput['voornaam'];
                $achternaam = $userInput['achternaam'];
                $geboortedatum = $userInput['geboorte-datum'];
                $geslacht = $userInput['geslacht'];
                $specialiteit = $userInput['specialiteit'];

                DB::table('medewerker')->where('userId', '=', $id)
                    ->update([
                        'userEmail'=>$userEmail
                    ]);

                if($request->has('profiel-foto')){
                    $user_pfp = $request->file('profiel-foto');

                    Storage::delete("/storage/userImages/$userInfo->userProfielFoto");
                
                    $pfp_name = "user-".$id."-".Carbon::now()->format('Y-m-d-H-i-s-A')."$user_pfp->getClientOriginalExtension";
                    $user_pfp->move(public_path('storage/userImages'), $pfp_name);

                    DB::table('medewerker_info')->where('userId', '=', $id)
                    ->update([
                        'userNaam'=>$achternaam,
                        'userVoornaam'=>$voornaam,
                        'userGeboortedatum'=>$geboortedatum,
                        'userGeslacht'=>$geslacht,
                        'userProfielFoto'=>$pfp_name,
                        'userSpecialty'=>$specialiteit
                    ]);
                } else {
                    DB::table('medewerker_info')->where('userId', '=', $id)
                    ->update([
                        'userNaam'=>$achternaam,
                        'userVoornaam'=>$voornaam,
                        'userGeboortedatum'=>$geboortedatum,
                        'userGeslacht'=>$geslacht,
                        'userSpecialty'=>$specialiteit
                    ]);
                }
                return view('user.edit', [
                    'userInfo' => $userInfo,
                    'geslachtInfo' => $geslachtInfo,
                    'userType' => $userType,
                    'editStatus' => 'success',
                    'inputEmail' => $userEmail
                ]);
            } 
        } else {
            return view('errors.forbidden');
        }
    }

    function archive(Request $request, $id){
        $userType = $request->session()->get('userType');

        $userInfo = DB::table('medewerker')
        ->select('userEmail', 'userStatus')
        ->where('userId', '=', $id)
        ->get()->first();

        if($userType == "admin"){
            if($request->isMethod('GET')){
                if($userInfo->userStatus == 0){
                    return view('user.archiveconfirm', [
                        'archived' => false,
                        'email' => $userInfo->userEmail,
                        'id' => $id
                    ]);
                } else if($userInfo->userStatus == 1){
                    return view('user.archiveconfirm', [
                        'archived' => true,
                        'email' => $userInfo->userEmail,
                        'id' => $id
                    ]);
                }
            } else if($request->isMethod('DELETE')){
                if($request->get('confirmation') == 1){
                    if($userInfo->userStatus == 0){
                        DB::table('medewerker')
                        ->where('userId', '=', $id)
                        ->update([
                            'userStatus' => 1
                        ]);
                    } else if($userInfo->userStatus == 1){
                        DB::table('medewerker')
                        ->where('userId', '=', $id)
                        ->update([
                            'userStatus' => 0
                        ]);
                    }
                    
                    return redirect('/users');
                } else if($request->get('confirmation') == 2){
                    return redirect('/users');
                }
            }
        }else {
            return redirect('/forbidden');
        }
    }

    function overzicht(Request $request){
        $userType = $request->session()->get('userType');

        if($userType == "admin"){
            if($request->isMethod('GET')){
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
                ->where('medewerker.userStatus', '=', 0)
                ->get();

                $nietGeregistreerdeUsers = DB::table('medewerker')
                ->join('useraccounttype', 'medewerker.userAccountTypeId', '=', 'useraccounttype.userAccountTypeId')
                ->select(['medewerker.*', 'useraccounttype.userAccountDescription'])->where('userFirstLogin', '=', 0)
                ->get();

                $archivedUsers = DB::table('medewerker')
                ->select()->where('userStatus', '=', 1)->get();

                $userInfoArray = json_decode(json_encode($userInfo->toArray()), true);
                return view('user.overzicht', [
                    'userInfo'=>$userInfoArray,
                    'nietGeregistreerdeUsers'=>$nietGeregistreerdeUsers,
                    'archivedUsers'=>$archivedUsers,
                    'userType'=>'admin'
                ]);
            }
        } else {
            return redirect('/forbidden');
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
