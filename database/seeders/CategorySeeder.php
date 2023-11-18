<?php

namespace Database\Seeders;

use App\Models\Admin;
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
        $admin = Admin::factory()->create();
        $admin->categories()->firstOrCreate(['name' => 'Linkedin']);
        $admin->categories()->firstOrCreate(['name' => 'Resume']);
        $admin->categories()->firstOrCreate(['name' => 'Cover letter']);
        $admin->categories()->firstOrCreate(['name' => 'Portfolio Website']);
    }
}
