<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * La clase Product representa los productos en la aplicacion.
 *
 * @package App\Models
 * @author Joselyn Carolina Obando Fernandez <cariharvey@hotmail.com>
 */

class Product extends Model{

    /**
     * Indica si la clave principal es autoincrementada.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * El tipo de la clave principal.
     *
     * @var string
     */
    protected $keyType = 'string';

    use HasFactory;

    /**
     * URL de la imagen por defecto para el producto.
     *
     * @var string
     */
    public static string $IMAGE_DEFAULT = 'https://graziamagazine.com/us/wp-content/uploads/sites/15/2023/05/dua-lipa-versace-collection-bts-1.jpg';

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'sex',
        'name',
        'price',
        'price_before',
        'stock',
        'image',
        'category_id',
        'isDeleted'
    ];

    /**
     * Obtiene la categoria asociada con el producto.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo La relacion de pertenencia a categoria del producto.
     */
    public function category(){
        return $this->belongsTo(Category::class);
    }

    /**
     * Obtiene la imagen del producto asociada.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo La relacion de pertenencia a imagen del producto.
     */
    public function productImage(){
        return $this->belongsTo(ProductImage::class);
    }

    /**
     * Alcance para filtrar productos basado en una busqueda y una categoria.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query La consulta de Eloquent.
     * @param string|null $search El termino de busqueda.
     * @param int|null $category El ID de la categoria.
     * @return \Illuminate\Database\Eloquent\Builder La consulta de Eloquent modificada.
     */
    public function scopeFiltrar($query, $search, $category){
        $query->whereRaw('LOWER(name) LIKE ?', ["%" . strtolower($search) . "%"]);
        if($category && $category != 1){
            $query->where('category_id', $category);
        }
        return $query;
    }
}
