<?php

namespace App\Database\Seeds;

use App\Entities\User;
use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $user = new UserModel();
        $user->insert(new User([
            'username' => "Admin Tiket",
            'email'    => "super@admin.com",
            'password' => "adminsuper",
            'role'     => "super"
        ]));
    }
}