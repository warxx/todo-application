<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */


    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpUser();
    }
     
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
