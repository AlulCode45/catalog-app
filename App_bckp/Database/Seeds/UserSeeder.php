<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            "username" => "admin",
            "name" => "Super Admin",
            "email"=> "admin@localhost",
            "isAdmin" => 1,
            "password" => password_hash("123456", PASSWORD_BCRYPT)
        ];

        $this->db->table("users")->insert($data);
    }
}
