<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model{
    public $incrementing = false;

    protected $keyType = 'string';

    use HasFactory;
    public static string $IMAGE_DEFAULT = 'https://graziamagazine.com/us/wp-content/uploads/sites/15/2023/05/dua-lipa-versace-collection-bts-1.jpg';
    protected $table = 'products';

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

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function productImage(){
        return $this->belongsTo(ProductImage::class);
    }

    public function scopeFiltrar($query, $search, $category){
        $query->whereRaw('LOWER(name) LIKE ?', ["%" . strtolower($search) . "%"]);
        if($category && $category != 1){
            $query->where('category_id', $category);
        }
        return $query;
    }
}
