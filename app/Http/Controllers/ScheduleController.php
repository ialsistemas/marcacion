<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
//MODELS
use App\Models\Users;
use App\Models\HorarioEmpleados;

class ScheduleController extends Controller
{   

    public function manage(){

        return view('pages.schedule.manage')
                    ->with("scripts" , array('src/js/pages/schedule/manage.js'));
                    
    }

    public function manageCreateEdit(){

        $validar = \Validator::make( request()->all() , [ 
            "id" => ['required'],
            "nombre" => ['required'],
            "horaEntrada" => ['required'],
            "horaSalida" => ['required'],
            "umbralInicio1" => ['required'],
            "umbralInicio2" => ['required'],
            "umbralSalida1" => ['required'],
            "umbralSalida2" => ['required']
        ]);
        
        if ($validar->fails())
        {
            return response()->json([
                "response" => "warning",
                "validate" => $validar->errors() 
            ]);
        }
        
        $data = array(
            request()->id,
            request()->nombre,
            "01-01-1900 ".request()->horaEntrada,
            "01-01-1900 ".request()->horaSalida,
            "01-01-1900 ".request()->umbralInicio1,
            "01-01-1900 ".request()->umbralInicio2,
            "01-01-1900 ".request()->umbralSalida1,
            "01-01-1900 ".request()->umbralSalida2
        );

        $accion = DB::select('JCEHorariosGrabar ?,?,?,?,?,?,?,?' , $data );

        return response()->json([
            "response" => "success",
            "msj" => request()->id
        ]);
    
    }

    public function manageLoad(){
        
        $select = DB::select('JCEHorariosBuscar');

        return response()->json([
            "response" => "success",
            "horarios" => $select
        ]);

    }

    public function assignment(){

        return view('pages.schedule.assignment')
                    ->with("scripts" , array('src/js/pages/schedule/assignment.js'));
                    
    }

    public function assignmentLoad(){
        
        $tu = "tblMarcacionUsuario";
        $users = Users::select("tblMarcacionUsuario.*","tblMarcacionTipoUsuario.TipoUsuario")
                    ->join('tblMarcacionTipoUsuario','tblMarcacionUsuario.Tipo',"=","tblMarcacionTipoUsuario.Id")
                    ->where("tblMarcacionUsuario.Tipo","<>","1")
                    ->where("tblMarcacionUsuario.Estado","=","1");

        return response()->json([
            "response" => "success",
            "data" => $users->get()
        ]);

    }

    public function assignmentCreate(){
  
        $validar = \Validator::make( request()->all() , [ 
            "id_horarios" => ['required'],
            "id_empleados" => ['required'],
            'PeriodoDesde' => ['required'],
            'PeriodoHasta' => ['required']
        ]);
        
        if ($validar->fails())
        {
            return response()->json([
                "response" => "warning",
                "validate" => $validar->errors() 
            ]);
        }

        //return response()->json(request()->all());

        foreach ( request()->id_empleados as $key => $id_emp ){

            foreach ( request()->id_horarios as $key2 => $id_hor ){
                
                $verify = HorarioEmpleados::where('IdHorario' , $id_hor)->where('IdUsuario' , $id_emp);

                if( count($verify->get()) < 1 ){
                    HorarioEmpleados::create([
                        'IdHorario' => $id_hor,
                        'IdUsuario'=> $id_emp,
                        'PeriodoDesde' => date( 'd-m-Y' , strtotime(request()->PeriodoDesde) ),
                        'PeriodoHasta' => date( 'd-m-Y' , strtotime(request()->PeriodoHasta) ),
                        'FechaReg' => date("d-m-Y H:i:s"),
                        'UsuarioReg' => auth()->user()->Usuario,
                    ]);
                }

            }

        }

        return response()->json([
            "response" => "success"
        ]);

    }

    public function usersBySchedule(){

        return view('pages.schedule.usersBySchedule')
            ->with("scripts" , array('src/js/pages/schedule/usersBySchedule.js')); 

    }

    public function usersByScheduleLoad(){
        
        $t1 = "tblMarcacionHorarioXEmp";
        $t2 = "tblHorarios"; 
        $t3 = "tblMarcacionUsuario"; 
        
        $data = HorarioEmpleados::select("$t1.PeriodoDesde","$t1.PeriodoHasta","$t2.Nombre as NombreHorario","$t2.HoraEntrada","$t2.HoraSalida","$t3.Dni","$t3.Nombres","$t3.Apellidos")
                    ->join( $t2 , $t1.".IdHorario" , "=" , "$t2.ID" )
                    ->join( $t3 , $t1.".IdUsuario" , "=" , "$t3.Id" )
                    ->where( $t3.".Estado" , "=" ,"1" );
                    //->whereBetween( $t1.'.PeriodoDesde', [request()->PeriodoDesde , request()->PeriodoHasta] )
                    //->whereBetween( $t1.'.PeriodoHasta', [request()->PeriodoDesde , request()->PeriodoHasta] );

        return response()->json( $data->get() );

    }

}