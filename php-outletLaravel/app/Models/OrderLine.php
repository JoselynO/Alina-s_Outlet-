<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderLine
 *
 * La clase OrderLine representa una linea de pedidos en la aplicacion.
 *Cada linea de pedido esta asociada con un pedido y un producto especificos.
 *
 * @package App\Models
 * @author Joselyn Carolina Obando Fernandez <cariharvey@hotmail.com>
 */
class OrderLine extends Model{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'order_lines';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'stock',
        'unitPrice',
        'linePrice'
    ];

    /**
     * Obtiene el pedido asociado con la linea de pedido.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo La relaciOon de pertenencia al pedido.
     */
    protected function order(){
        return $this->belongsTo(Order::class);
    }

    /**
     * Obtiene el producto asociado con la lInea de pedido.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo La relacion de pertenencia al producto.
     */
    protected function product(){
        return $this->belongsTo(Product::class);
    }
}
