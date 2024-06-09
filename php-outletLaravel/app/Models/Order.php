<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 *
 * La clase Order representa un pedido en la aplicacion.
 *Un pedido esta asociado con un usuario y contiene multiples lineas de pedido.
 *
 * @package App\Models
 * @author Joselyn Carolina Obando Fernandez <cariharvey@hotmail.com>
 */
class Order extends Model{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'totalItems',
        'totalPrice',
        'tax',
        'total'
    ];

    /**
     * Obtiene el usuario asociado con el pedido.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo La relacion de pertenencia al usuario.
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Obtiene las lineas de pedido asociadas con el pedido.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany La relacion de uno a muchos con las lineas de pedido.
     */
    public function orderLines(){
        return $this->hasMany(OrderLine::class);
    }

}
