<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::firstOrCreate(['name' => 'Linkedin']);
        Category::firstOrCreate(['name' => 'Resume']);
        Category::firstOrCreate(['name' => 'Cover letter']);
        Category::firstOrCreate(['name' => 'Portfolio Website']);
    }
}
