<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

         //$this->call(SloganTableSeeder::class);
        //factory(App\Slogan::class)->make();
        factory('App\Slogan', 50)->create();

        Model::reguard();
    }
}
