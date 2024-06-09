<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model{
    use HasFactory;

    public static string $IMAGE_DEFAULT = 'https://graziamagazine.com/us/wp-content/uploads/sites/15/2023/05/dua-lipa-versace-collection-bts-1.jpg';

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'image',
        'isDeleted',
    ];

    public static function getNameById($id){
        $category = self::find($id);
        return $category ? $category->id : null;
    }

    public static function getIdByName($name){
        $category = self::where('name', $name)->first();
        return $category ? $category->id : null;
    }

    public static function getNames(){
        return self::pluck('name');
    }

    public function updateProductWithOutCategory($id){
        $products = Product::where('category_id', $id)->get();

        if ($products->count() > 0) {
            foreach ($products as $product) {
                $product->category_id = 1;
                $product->save();
            }
        }
    }

    public function scopeSearch($query, $search){
        return $query->whereRaw('LOWER(name) LIKE ?', ["%" . strtolower($search) . "%"]);
        if ($category && $category->id != 1) {
            $query->where('category_id', $category);
        }
        return $query;
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

}