<?php

namespace Tests\Feature\App\Http\Controllers\Api;

use App\Models\Task;
use Tests\Traits\UtilsTrait;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use UtilsTrait;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_task_with_user_unauthenticated() 
    {
        $response = $this->postJson('/tasks',[]); 

        $response->assertStatus(401);
    }

    public function test_create_task_with_user_authenticated() 
    {
        $payload = [
            'title' => 'Title Test',
            'description' => 'Description Test',
        ];
        $response = $this->postJson('/tasks',$payload,$this->defaultHeaders()); 
        $response->assertStatus(201);
    }

    public function test_validations_task()
    {
        $payload = [];
        $response = $this->postJson('/tasks',$payload,$this->defaultHeaders()); 
        
        $response->assertStatus(422);
        
        $response->assertJsonPath('errors.title.0','The title field is required.');
        
        $response->assertJsonPath('errors.description.0','The description field is required.');
    }

   

}
