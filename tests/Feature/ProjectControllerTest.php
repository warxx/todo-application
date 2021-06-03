<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */


    public function test_create()
    {
        $register_credential = [
            'name' => 'ivan',
            'email' => 'ivan@nexpur.com',
            'password' => 'start123',
            'password_confirmation' => 'start123',
        ];

        $credential = [
            'email' => 'ivan@nexpur.com',
            'password' => 'start123'
        ];
        
        $this->post('register',$register_credential)
        ->assertRedirect('/');


        $this->post('login',$credential)
             ->assertRedirect('/');

        $user = Auth::user();

        $params = [
            'name' => 'test-project',
            'description' => 'some test description...',
        ];
        
        $response = $this->post(route('projects.create'), $params);

        $response->assertStatus(200);
        $response->assertSessionHasNoErrors();
    }
}
