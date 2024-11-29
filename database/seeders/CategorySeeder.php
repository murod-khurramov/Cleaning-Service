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
    public function run()
    {
        Category::create(['name' => 'Web design']);
        Category::create(['name' => 'Web development']);
        Category::create(['name' => 'Online marketing']);
        Category::create(['name' => 'Keyword Research']);
        Category::create(['name' => 'Email Marketing']);
    }
}
