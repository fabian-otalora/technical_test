<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SecurityPrice;
use App\Models\SecurityType;
use App\Models\Security;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        SecurityType::insert([
            ['slug' => 'mutual_funds', 'name' => 'Mutual Funds'],
        ]);

        Security::insert([
            ['security_type_id' => '1', 'symbol' => 'APPL'],
            ['security_type_id' => '1', 'symbol' => 'NVDA'],
            ['security_type_id' => '1', 'symbol' => 'TSLA'],
            ['security_type_id' => '1', 'symbol' => 'META'],
            ['security_type_id' => '1', 'symbol' => 'MSFT'],
        ]);

        SecurityPrice::insert([
            ['security_id' => '1', 'last_price' => '391.53', 'as_of_date' => '2024-10-23 23:12:02'],
            ['security_id' => '2', 'last_price' => '139.56', 'as_of_date' => '2024-10-23 23:12:02'],
            ['security_id' => '3', 'last_price' => '213.65', 'as_of_date' => '2024-10-23 23:12:02'],
            ['security_id' => '4', 'last_price' => '567.35', 'as_of_date' => '2024-10-23 23:12:02'],
            ['security_id' => '5', 'last_price' => '424.24', 'as_of_date' => '2024-10-23 23:12:02'],
        ]);

    }
}
