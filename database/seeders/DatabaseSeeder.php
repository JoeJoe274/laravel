<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CreateBooksSeeder::class);
        $this->call(CreateBookReviewsSeeder::class);
        $this->call(CustomersSeeder::class);
        $this->call(OrderDetailsSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(UserSeeder::class);
    }
}
