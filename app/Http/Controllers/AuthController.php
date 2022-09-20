<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Auth as ModelAuth;

class AuthController extends Controller
{
    
    public function index(){

        return view('pages.auth.index')
                    ->with("scripts" , array('src/js/pages/auth/login.js'));
        
    }

    public function login(Request $request){

        $user = request('usuario');
        $password = request('password');
        
        $request->validate([
            'usuario' => ['required'],
            'password' => ['required']
        ]);

        $usuario = ModelAuth::where( 'Usuario' , trim($request->usuario) )
                                ->where( 'Estado' , 1 )
                                ->first();

        if( $usuario !== null){

            if( trim($usuario->Password) === trim($password) ){
               
                $usuario->update([ 'Password' => Hash::make(trim($request->password)) ]);

            }

            if(Hash::check( $password , trim($usuario->Password) )){                

                $auth = Auth::login($usuario);
                //$usuario->assignRole('administrador');
                //dd(Auth::User());
                
                $request->session()->regenerate();

                if( Auth::User()->Tipo == 1 ){

                    return redirect()->intended('reports/recordsManagement');

                }else{

                    return redirect()->intended('attendance');

                }
               
            }

        }
        
        throw ValidationException::withMessages([
            "error" => "El usuario o la contraseña no son correctos, vuelva a intentarlo."
        ]);
               
    }

    public function logout(){

        Auth::logout();  
        return redirect('/');

    }

    public function pagenotfound(){

        if(Auth::guest()){

            return redirect('/');

        }else{

            if(Auth::user()->hasRole('administrador')){
                return redirect('users/manage');
            }

            if(Auth::user()->hasRole('empleado')){
                return redirect('attendance');
            }

        }

    }

}