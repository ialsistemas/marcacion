<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
//MODELS
use App\Models\Users;
//use App\Models\Attendance;
use App\Models\TblMarcacionHorario;
use App\Models\Auth as ModelAuth;

class UsersController extends Controller
{
    
    public function searchUsers(){

        return response()->json([
            "response" => "success",
            "users" => DB::select('sp_buscador_empleados ?,?' , [ request()->usuario , request()->estado ])
        ]);

    }

    public function manage(){

        return view('pages.users.manage')
                    ->with( "tipo_usuarios" , DB::table('tblMarcacionTipoUsuario')->get() )
                    ->with( "scripts" , array('src/js/pages/users/manage.js' )
                );

    }

    public function manageCreate(){

        $validar = \Validator::make( request()->all() , [ 
            'Tipo' => ['required'],
            'Dni' =>  ['required','max:8','min:8'],
            'Nombres' => ['required'],
            'Apellidos' => ['required'],
            'Password' => ['required','min:5'],
            'Usuario' => ['required','min:5']        
        ]);

        if ($validar->fails())
        {
            return response()->json([
                "response" => "warning",
                "message" => "Valide que la información ingrresada sea la correcta"//$validar->errors() 
            ]);
        }

        $dni = Users::where('Dni', request()->Dni )->orWhere('Usuario', request()->Usuario);
        if(count($dni->get()) > 0){
            return response()->json([
                "response" => "warning",
                "message" => "El Usuario ya ha sido registrado."
            ]); 
        }

        Users::create(
            ['Tipo' => request()->Tipo ,
             'Dni' => trim(request()->Dni) , 
             'Nombres' => trim(request()->Nombres) ,
             'Apellidos' => trim(request()->Apellidos) ,
             'Usuario' => trim(request()->Usuario) ,
             'Password' => Hash::make(trim(request()->Password)) ,
             'Estado' => 1,
             'FechaReg' => date("d-m-Y H:i:s") ,
             'Usuarioreg' => auth()->user()->Id
            ]
        );

        $latest = ModelAuth::latest('Id')->first();

        if(request()->Tipo === "1"){
            $latest->assignRole('administrador');
        }else{
            $latest->assignRole('empleado');
        }

        return response()->json([
            "response" => "success"
        ]);

    }

    public function manageEdit(){

        $update = Users::where('Cod_emp', request()->id )
                        ->update(['Password' => Hash::make(trim(request()->password)) , "Estado" => trim(request()->estado) ]);              

        return response()->json([
            "response" => "success",
            "res" => $update
        ]);

    }

    public function manageLoad(){

        if(request()->tipousuario == "0"){
            $users = Users::select("tblMarcacionUsuario.*","tblMarcacionTipoUsuario.TipoUsuario")
                    ->join('tblMarcacionTipoUsuario','tblMarcacionUsuario.Tipo',"=","tblMarcacionTipoUsuario.Id")
                    //->where("tblMarcacionUsuario.Tipo","<>","1")
                    ->where("tblMarcacionUsuario.Estado","=","1");
        }else{
            $users = Users::select("tblMarcacionUsuario.*","tblMarcacionTipoUsuario.TipoUsuario")
                    ->join('tblMarcacionTipoUsuario','tblMarcacionUsuario.Tipo',"=","tblMarcacionTipoUsuario.Id")
                    ->where("tblMarcacionUsuario.Tipo","=",request()->tipousuario)
                    ->where("tblMarcacionUsuario.Estado","=","1");
        }
                        
        return response()->json([
            "response" => "success",
            "users" => $users->get()
        ]);


        $users = Users::select("tblMarcacionUsuario.*","datper.*")
                        ->join('datper','tblMarcacionUsuario.Cod_emp',"=","datper.cod_emp");


    }

    public function schedule(){

        return view('pages.users.schedule')
                    ->with("scripts" , array('src/js/pages/users/schedule.js'));

    }

    public function scheduleLoad(){

        $horarios = DB::select('JCEHorarioXEmpBuscar ?' , [ trim(request()->codigo)]);

        return response()->json([
            "response" => "success",
            "horarios" => $horarios
        ]);

    }


    public function inbox(){

        $marcaciones = TblMarcacionHorario::where( "Id" , auth()->user()->Id )
                                    ->orderbyDesc("id");

        return view('pages.users.inbox')
                    ->with( "scripts" , array('src/js/pages/users/inbox.js'))
                    ->with( "marcaciones" , $marcaciones );

    }

    public function inboxLoad(){

        /**$marcaciones = DB::select('JCEMarcacionHorarioBuscar ?,?,?,?' , [ 
            date("d-m-Y", strtotime(request()->desde)),
            date("d-m-Y", strtotime(request()->hasta)),
            auth()->user()->Id,
            1
        ]);**/

        return response()->json([
            "response" => "success",
            "marcaciones" => []
        ]);

    }

    /**public function create(Request $request){

        $validator = \Validator::make( request()->all() , [ 
            'apellidos' => ['required'],
            'nombres' => ['required'],
            'documento' => ['required','min:8'],
            'password' => ['required','min:6'],
            'usuario' => ['required','min:5'],
            'rol' => ['required']
        ]);
        
        if ($validator->fails())
        {
            return response()->json([
                "success" => false,
                "validate" => $validator->errors() 
            ]);
        }
        
        return response()->json([
            "success" => true,
            "validate" => request()->all()
        ]);

    }**/
}