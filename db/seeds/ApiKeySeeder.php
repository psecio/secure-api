<?php

use Phinx\Seed\AbstractSeed;

class ApiKeySeeder extends AbstractSeed
{
    public function run()
    {
        $apiKey = $this->table('api_key');
        $apiKey->truncate();

        // Build out 6 randomized tokens and assign them to users, two for each
        $users = $this->fetchAll('SELECT * FROM users');
        foreach ($users as $user) {
            for ($i = 0; $i < 2; $i++) {
                $apiKey->insert([
                    'key' => $this->generateToken(),
                    'description' => 'Random token #'.$i,
                    'user_id' => $user['id'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ])->save();
            }
        }
    }

    /**
     * Generate a randomized token
     * @return string Generated token
     */
    private function generateToken()
    {
        return hash('sha512', random_bytes(128));
    }
}
