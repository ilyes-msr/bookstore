<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'ريادة الأعمال']);
        Category::create(['name' => 'العمل الحر']);
        Category::create(['name' => 'التصميم']);
        Category::create(['name' => 'البرمجة']);
        Category::create(['name' => 'التسويق والمبيعات']);
    }
}
