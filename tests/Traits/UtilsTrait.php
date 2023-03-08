<?php

namespace Tests\Traits; 

use App\Models\User;


trait UtilsTrait 
{
    public function createTokenUser($user = null)
    {
        $user =  User::factory()->create();
        $payload = [
            'email' => $user->email,
            'password' => 'password',
        ];
        $response = $this->postJson('/login', $payload);
        $token = $response->json();
        return $token['token'];
    }

    public function defaultHeaders()
    {
        $token = $this->createTokenUser();
        return [
            'Authorization' => "Bearer {$token}"
        ];
    }
}
