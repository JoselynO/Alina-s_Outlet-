<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * La clase Category representa una categoria de productos en la aplicacion.
 *
 * @package App\Models
 * @author Joselyn Carolina Obando Fernandez <cariharvey@hotmail.com>
 */
class Category extends Model{
    use HasFactory;

    /**
     * URL de la imagen por defecto para la categoria.
     *
     * @var string
     */
    public static string $IMAGE_DEFAULT = 'https://graziamagazine.com/us/wp-content/uploads/sites/15/2023/05/dua-lipa-versace-collection-bts-1.jpg';

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'isDeleted',
    ];

    /**
     * Obtiene el nombre de la categoria por su ID.
     *
     * @param int $id El ID de la categoria.
     * @return string|null El nombre de la categoria o null si no se encuentra.
     */
    public static function getNameById($id){
        $category = self::find($id);
        return $category ? $category->id : null;
    }

    /**
     * Obtiene el ID de la categoria por su nombre.
     *
     * @param string $name El nombre de la categoria.
     * @return int|null El ID de la categoria o null si no se encuentra.
     */
    public static function getIdByName($name){
        $category = self::where('name', $name)->first();
        return $category ? $category->id : null;
    }

    /**
     * Obtiene una lista de nombres de todas las categorias.
     *
     * @return \Illuminate\Support\Collection Una coleccion de nombres de categorias.
     */
    public static function getNames(){
        return self::pluck('name');
    }

    /**
     * Actualiza los productos que no tienen categoria.
     *
     * @param int $id El ID de la categoria que se va a eliminar.
     * @return void
     */
    public function updateProductWithOutCategory($id){
        $products = Product::where('category_id', $id)->get();

        if ($products->count() > 0) {
            foreach ($products as $product) {
                $product->category_id = 1;
                $product->save();
            }
        }
    }

    /**
     * Alcance para buscar categorias basado en un termino de busqueda.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query La consulta de Eloquent.
     * @param string|null $search El termino de busqueda.
     * @return \Illuminate\Database\Eloquent\Builder La consulta de Eloquent modificada.
     */
    public function scopeSearch($query, $search){
        return $query->whereRaw('LOWER(name) LIKE ?', ["%" . strtolower($search) . "%"]);
        if ($category && $category->id != 1) {
            $query->where('category_id', $category);
        }
        return $query;
    }

    /**
     * Obtiene los productos asociados con la categoria.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany La relaciosn de uno a muchos con los productos.
     */
    public function products(){
        return $this->hasMany(Product::class);
    }

}
