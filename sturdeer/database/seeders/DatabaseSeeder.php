<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Trend;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $trends = [
            'Most Commented',
            'Most Liked',
            'Newest',
        ];

        foreach ($trends as $trend) {
            Trend::create(['name' => $trend]);
        }

        Blog::factory(10)->create();

    }
}