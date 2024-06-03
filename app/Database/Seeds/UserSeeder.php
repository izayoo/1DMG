<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('users')->insert([
            'name' => 'Kristoffer Cuevas',
            'username' => 'izayoo',
            'email' => 'cuevas.toffer@gmail.com',
            'password' => password_hash('P@ssw0rd678%%$', PASSWORD_DEFAULT),
        ]);
    }
}
