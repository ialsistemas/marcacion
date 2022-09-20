<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Auth extends Authenticatable
{
    
    use HasFactory;
    use HasRoles;

    protected $table = 'tblMarcacionUsuario';
    protected $primaryKey = 'Id';
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
    */
    protected $fillable = [
        'Tipo',
        'Cod_emp',
        'Usuario',
        'Password',
        'Estado',
        'FechaReg',
        'Usuarioreg'
    ];

    /**protected $hidden = [
        'Password',
        'FechaReg'
    ];**/

    protected $casts = [
        'FechaReg' => 'datetime'
    ];

}