<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [ 'Remessa Parcial', 'Remessa' ];
        
        foreach($categories as $category) {
            $categoryModel = new Category();
            $categoryModel->name = $category;
            $categoryModel->save();
        }
    }
}
