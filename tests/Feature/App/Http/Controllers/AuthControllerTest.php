<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Models\User;
use Tests\Traits\UtilsTrait;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use UtilsTrait;
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fail_authentication_if_email_or_password_is_wrong()
    {
       
        $response = $this->postJson('/login', []);

        $response->assertStatus(403);

        $response->assertJsonPath('erro','Usuário ou senha inválido!');
    }

    public function test_authentication_with_user_true()
    {
        $user = User::factory()->create();
        $payload = [
            'email' => $user->email,
            'password' => 'password',
        ];
       
        $response = $this->postJson('/login', $payload);
        $token = $response->json();

        $response->assertStatus(200);

        $response->assertJsonPath('token', $token['token']);
        
    }

    public function test_logout_if_user_not_authenticated()
    {
        $response = $this->postJson('/logout',[]);
        $response->assertStatus(401);
    }

    public function test_logout_with_user_logged()
    {
        $token = $this->createTokenUser();
        $response = $this->postJson('/logout',[],[
            'Authorization' => "Bearer {$token}"
        ]);
        $response->assertStatus(200);
    }


}
