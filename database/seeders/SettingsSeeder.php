<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'open_registration' => 0,
            'mass_addition_by_mail' => 0,
            'confirm_each_new_registered_user' => 0,
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ]);
    }
}
