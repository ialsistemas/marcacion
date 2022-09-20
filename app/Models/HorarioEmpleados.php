<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioEmpleados extends Model
{

    use HasFactory;

    protected $table = 'tblMarcacionHorarioXEmp';
    protected $primaryKey = 'Id';
    public $timestamps = false;
    
    protected $fillable = [
        'Id',
        'IdHorario',
        'IdUsuario',
        'PeriodoDesde',
        'PeriodoHasta',
        'FechaReg',
        'UsuarioReg'
    ];

    protected $hidden = [
        //'Password',
        //'FechaReg'
    ];

    protected $casts = [
        //'Tipo' => 'integer'
        //'FechaHora' => 'datetime'
    ];

}
