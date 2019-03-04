<?php

use Illuminate\Database\Seeder;

class AuthProviderSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('auth_providers')->insert(['name' => 'google']);
    }
}
