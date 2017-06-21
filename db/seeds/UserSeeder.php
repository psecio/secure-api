<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run()
    {
        $users = $this->table('users');
        $users->truncate();

        $defaultUsers = [
            [
                'username' => 'user1',
                'password' => password_hash('test1234', PASSWORD_DEFAULT),
                'name' => 'Active User #1',
                'email' => 'user1@example.com',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'password_reset_date' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'user2',
                'password' => password_hash('test5678', PASSWORD_DEFAULT),
                'name' => 'Active User #2',
                'email' => 'user2@example.com',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'password_reset_date' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'user3',
                'password' => password_hash('test9012', PASSWORD_DEFAULT),
                'name' => 'Inactive User #1',
                'email' => 'user3@example.com',
                'status' => 'disabled',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'password_reset_date' => date('Y-m-d H:i:s')
            ]
        ];

        $users->insert($defaultUsers)->save();
    }
}
