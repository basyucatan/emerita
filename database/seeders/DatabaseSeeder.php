<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CatsBasicosSeeder::class);
        $this->call(CatsRestoSeeder::class);
        $this->call(CatsMatsModsSeeder::class);
        $this->call(CostosVariosSeeder::class);
        $this->call(CostosCuprumSeeder::class);
        $this->call(CostosAluplastSeeder::class);
        $this->call(MovsSeeder::class);
    }
}
