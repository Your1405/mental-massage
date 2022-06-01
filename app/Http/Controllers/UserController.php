<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medewerker;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Translation\Provider\NullProvider;

class UserController extends Controller
{
    function login(Request $request){
        if($request->isMethod('post')){
            $email = $request->input('email');
            $password = $request->input('password');

            $userAccount = DB::table('medewerker')->where('userEmail', '=', $email)->get()->toArray();
            var_dump($userAccount);
            if($email == $userAccount[0]){
                if ($password == $userAccount['userPassword']){
                    if($userAccount['userTypeId'] == 1){
                        session(['userType'=>'admin']);
                        return redirect('/dashboard');
                    } else if ($userAccount['userTypeId'] == 2){
                        session(['userType'=>'specialist']);
                        return redirect('/dashboard');
                    }
                } else {
                    return view('login', ['loginError'=>'password']);
                }
            } else {
                return view('login', ['loginError'=>'email']);
            }
        }
        else if($request->isMethod('get')){
            return view('login', ['loginError'=>null]);
        }
    }

    function useradd(Request $request){
        if($request->isMethod('get')){
            return view('user.add', [
                'userId'=> null,
                'insertStatus'=> null
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
                    'userPassword' => $password,
                ]);

                $userId = DB::table('medewerker')->select('userId')->where('userEmail', '=', $email)->get();
                return view('user.add', [
                    'userId'=>$userId,
                    'insertStatus'=>'success'
                ]);
           } else {
            return view('user.add', [
                'userId'=>null,
                'insertStatus'=>'userExists'
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

    function user(){
        return view('user.view');
    }

    function logout(Request $request){
        
        $request->session()->flush();
        return view ('login');
    }
}
