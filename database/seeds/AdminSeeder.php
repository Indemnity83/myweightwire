<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Kyle Klaus',
            'email' => 'kklaus@indemnity83.com',
            'password' => str_random(),
            'email_verified_at' => now(),
            'approved_at' => now(),
            'is_admin' => true,
        ]);
    }
}
