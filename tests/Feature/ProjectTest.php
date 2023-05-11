<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{

    use RefreshDatabase;

    public function test_ok_request()
    {
        $response = $this->get('project');
        $response->assertStatus(200);
    }

    public function test_h1_ok()
    {
        $view = $this->get('/project');

        $view->assertSee('<h1>Liste des projets</h1>', $escaped = false);
    }

    public function test_new_project()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);

        $response = $this->get('/project');

        $this->assertModelExists($project);
        $response->assertSee(e($project->project_name));

    }

    public function test_show_project_title()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);

        $response = $this->get(route('project.show', ['project'=>$project]));

        $response->assertSee(e($project->project_name));
    }

    public function test_show_project_author()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);

        $response = $this->get(route('project.show', ['project'=>$project]));

        $response->assertSee(e($user->name));
    }

    public function test_auth_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('project.store'), [
            'project_name' => 'My project',
            'description' => 'Hello this is a new project for tdd module',
        ]);

        $response->assertRedirect(route('project.index'));
        $this->assertDatabaseHas('projects', [
            'project_name' => 'My project',
            'description' => 'Hello this is a new project for tdd module',
            'user_id' => $user->id,
        ]);

    }

    public function test_auth_user_edit()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $response = $this->put(route('project.update', $project), [
            'project_name' => 'My project',
            'description' => 'Hello this is a new project for tdd module',
        ]);

        $response->assertRedirect(route('project.index'));
        $this->assertDatabaseHas('projects', [
            'project_name' => 'My project',
            'description' => 'Hello this is a new project for tdd module',
            'user_id' => $user->id,
        ]);

    }


}