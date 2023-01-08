<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'nip' => '00001',
            'password' => Hash::make('password'),
            'roles' => 'admin'
        ]);
    }
}
