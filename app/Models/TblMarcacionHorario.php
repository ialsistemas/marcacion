<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblMarcacionHorario extends Model
{

    use HasFactory;

    protected $table = 'tblMarcacionHorario';
    protected $primaryKey = 'Id';
    public $timestamps = false;
    
    protected $fillable = [
        'Id',
        'IdUsuario',
        'TipoMarcacion',
        'FechaHora',
        'UsuarioReg',
        'FechaReg'
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
