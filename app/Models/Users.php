<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{

    use HasFactory;

    protected $table = 'tblMarcacionUsuario';
    protected $primaryKey = 'Id';
    public $timestamps = false;
    
    protected $fillable = [
        'Id',
        'Tipo',
        'Dni',
        'Nombres',
        'Apellidos',
        'Password',
        'Estado',
        'FechaReg',
        'Usuarioreg',
        'Usuario'
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