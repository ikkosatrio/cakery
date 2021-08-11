<?php

use Illuminate\Database\Seeder;
use App\Model\Profile;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::insert([
            'address' => 'LSP Broker Property Indonesia',
            'email' => 'lspbpn@gmail.com',
            'description' => 'desk',
            'phone' => "0831",
            'name' => "LSP Broker Property Indonesia",
        ]);
    }
}
