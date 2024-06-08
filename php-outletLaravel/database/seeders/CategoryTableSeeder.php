<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::truncate();
        DB::table('categories')->insert([
            ['name' => 'NOT CATEGORY',
                'image' => 'https://as1.ftcdn.net/v2/jpg/01/06/81/50/1000_F_106815012_XS82FPKIZDRDiCs4HJmUElRLTRW9HIvf.jpg'],
            ['name' => 'BAGS',
                'image' => 'images/general/bags.jpg'
            ],
            ['name' => 'SUNGLASSES',
                'image' => 'images/general/sunglasses.jpg'
            ],
            ['name' => 'WATCHES',
                'image' => 'images/general/watch.jpg'
            ],
            ['name' => 'ACCESSORIES',
                'image' => 'images/general/acceso.jpg'
            ]
        ]);
    }
}
