<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class BasicTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $credential = [
            'email' => 'ivan@nexpur.com',
            'password' => 'start123'
        ];
         
        $this->post('login',$credential)
             ->assertRedirect('/')
             ->get('/login')
             ->assertRedirect('/');

        $user = Auth::user();

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
