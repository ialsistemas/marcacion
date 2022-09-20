<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use App\Models\Attendance;
use App\Models\TblMarcacionHorario;

class AttendanceController extends Controller
{
    
    public function index(){

        return view('pages.attendance.index')
                    ->with("scripts" , array('src/js/pages/attendance/register.js'));
                   
    }

    public function register(){

        /**try{**/

            /**DB::select('JCEMarcacionHorarioGrabar ?,?,?,?' , [ 
                request()->id,
                auth()->user()->Cod_emp,
                request()->tipo,
                auth()->user()->Cod_emp
            ]);**/

            TblMarcacionHorario::create([
                'IdUsuario' => auth()->user()->Id,
                'TipoMarcacion' => request()->tipo, 
                'FechaHora' => date("d-m-Y H:i:s"),
                'UsuarioReg' => auth()->user()->Id,
                'FechaReg' => date("d-m-Y H:i:s")
            ]);

            return response()->json([
                "response" => "success",
                "data" => "HORA DE INGRESO REGISTRADO CON ÉXITO.",
                "latest" => TblMarcacionHorario::latest('Id')->select("FechaHora")->first()
            ]);

        /**} catch (\Illuminate\Database\QueryException  $exception) {

            return response()->json([
                "response" => "error",
                "error" => $exception
            ]);

        }**/

    } 

}