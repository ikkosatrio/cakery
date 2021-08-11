<?php

use Illuminate\Database\Seeder;
use App\Model\Home;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Home::insert([
            'section1' => '',
            'section2' => '',
        ]);
    }
}
