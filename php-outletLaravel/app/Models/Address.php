<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Address
 *
 * La clase Address representa una direccion en la aplicacion.
 *Una direccion esta asociada con un usuario especifico.
 *
 * @package App\Models
 * @author Joselyn Carolina Obando Fernandez <cariharvey@hotmail.com>
 */
class Address extends Model{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'addresses';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'lastName',
        'dni',
        'street',
        'number',
        'city',
        'province',
        'country',
        'postCode',
        'additionalInfo'
    ];

    /**
     * Obtiene el usuario asociado con la direccion.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo La relacion de pertenencia al usuario.
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
