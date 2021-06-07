<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpUser();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_user()
    {
        $loginUser = Auth::user();
        
        $params = [
            'name' => 'test-project',
            'description' => 'some test description...',
        ];
        
        $response = $this->post(route('projects.store'),$params);
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();

        $project = Project::where('name', 'test-project')->where('description','some test description...')->where('user_id',$loginUser->id)->first();
        $this->assertNotNull($project);
    }

    // public function test_edit_user() {
    //     $project_name = 'test-project-edited';
    //     $project_description = 'some test description... edited';

    //     $loginUser = Auth::user();

    //     $params = [
    //         'name' => $project_name,
    //         'description' => $project_description
    //     ];

    //     $response = $this->put
    // }
}
