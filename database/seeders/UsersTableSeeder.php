<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("SET foreign_key_checks = 0");
        DB::table('users')->truncate();

        //inserting owner
        $owner = User::create([
            'name' => "Owner",
            'email' => "owner@pharmacy.com",
            'username' => 'owner',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('owner@pharma'), // password
            'remember_token' => null,

        ]);

        $owner->assignRole('Owner');

        //inserting manager
        $manager = User::create([
            'name' => "Manager",
            'email' => "manager@pharmacy.com",
            'username' => 'manager',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('manager@pharma'), // password
            'remember_token' => null,

        ]);

        $manager->assignRole('Manager');

        //inserting cashier
        $cashier = User::create([
            'name' => "Cashier",
            'email' => "cashier@pharmacy.com",
            'username' => 'cashier',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('cashier@pharma'), // password
            'remember_token' => null,

        ]);

        $cashier->assignRole('Cashier');
    }
}
