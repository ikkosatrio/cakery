<?php

use Illuminate\Database\Seeder;
use App\Model\Group_user;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group_user::insert([
            'name' => 'admin',
            'description' => 'admin@gmail.com',
        ]);
    }
}
