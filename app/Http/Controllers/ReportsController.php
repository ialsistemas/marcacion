<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Exports\ReportsExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Users;
use App\Models\Attendance;

class ReportsController extends Controller
{

    public function recordsManagement(){

        return view('pages.reports.reportsManagement')
                    ->with("scripts" , array('src/js/pages/reports/reportsManagement.js'));

    }

    public function loadRecords(){

        $desde = date("d-m-Y", strtotime(request()->desde));
        $hasta = date("d-m-Y", strtotime(request()->hasta));
        $codigo = request()->codigo;

        return response()->json([
            "response" => "success",
            "registros" => DB::select('JCEMarcacionHorarioBuscar ?,?,?,?' , [ $desde , $hasta , $codigo , 1])
        ]);

    }

    public function downloadExcel($desde,$hasta,$codigo,$personal){
        
        $desde = date("d-m-Y", strtotime($desde));
        $hasta = date("d-m-Y", strtotime($hasta));

        if($codigo == "vacio"){
            $codigo = null;
            $personal = $personal == "vacio" ? null : $personal; 
        }else{
            $personal = null;
        }

        $collection = [["#","DNI","CÓD. EMPLEADO","EMPLEADO","FECHA/HORA","RELOJ","TIPO REGISTRO","ESTADO"]];
        $listado = DB::select('JCEMarcacionHorarioBuscar ?,?,?,?' , [ $desde , $hasta , $codigo , 1 ]);
        
        foreach ($listado as $key => $value) {
            $collection[] = [
                $key+1,
                $value->dni,
                $value->Cod_emp,
                $value->Empleado,
                substr( $value->FechaHora , 0 , 19),
                "Reloj Loayza (Portal del Trabajador)",
                $value->Tipo,
                $value->estado == "1" ? "Activo" : "Inactivo"
            ];
        }

        $registros = new ReportsExport( [$collection] , count($listado) );
        
        return response()->json([
            "response" => "success",
            "name" => "Registro_Asistencias.xlsx",
            "file" => "data:application/vnd.ms-excel;base64,".base64_encode(Excel::raw($registros, 'Xlsx'))
        ]);

    }

}