<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medewerker;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Translation\Provider\NullProvider;
use Illuminate\Support\Facades\Hash; 

class UserController extends Controller
{
    function login(Request $request){
        if($request->isMethod('post')){
            $email = $request->input('email');
            $password = $request->input('password');

            $userAccount = DB::table('medewerker')->where('userEmail', '=', $email)->get();

            $userAccountArray = json_decode(json_encode($userAccount->toArray()), true);
            if($email == $userAccountArray[0]['userEmail']){
                if (Hash::check($password, $userAccountArray[0]['userPassword'])){                
                    if($userAccountArray[0]['userAccountTypeId'] == 2){
                        session(['userType'=>'admin']);
                        return redirect('/dashboard');
                    } else if ($userAccountArray[0]['userAccountTypeId'] == 1){
                        session(['userType'=>'specialist']);
                        return redirect('/dashboard');
                    
                } else {
                    return view('login', ['loginError'=>'password']);
                }
            } else {
                return view('login', ['loginError'=>'email']);
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
        } else if ($request->isMethod('post')){
            $userInfo = $request->all();

            $email = $userInfo['userEmail'];
            $password = $userInfo['userPassword'];
            $acctype = $userInfo['userAccountType'];

            $existingUser = DB::table('medewerker')->where('userEmail', '=', $email)->get();
            if($existingUser->count() == 0){
                DB::table('medewerker')->insert([
                    'userAccountTypeId' => $acctype,
                    'userEmail' => $email,
                    'userPassword' => Hash::make($password),
                ]);

                $userId = DB::table('medewerker')->select('userId')->where('userEmail', '=', $email)->get();
                return view('user.add', [
                    'userId'=>$userId,
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
            ->select(['medewerker.userId', 'useraccounttype.userAccountDescription', 'medewerker.userEmail'])
            ->get();

            $userInfoArray = json_decode(json_encode($userInfo->toArray()), true);
            return view('user.overzicht', [
                'userInfo'=>$userInfoArray,
                'userType'=>'admin'
            ]);
        }
    }

    function view(){
        return view('user.view');
    }

    function logout(Request $request){
        $request->session()->flush();
        return redirect('/login');
    }
}
