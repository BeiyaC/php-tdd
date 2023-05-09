<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProjectTest extends TestCase
{
    public function test_ok_request()
    {
        $response = $this->get('project');
        $response->assertStatus(200);
    }

    public function test_h1_ok()
    {
        $view = $this->view('project');

        $view->assertSee('<h1>Liste des projets</h1>');
    }

    public function connect_to_db()
    {

        $this->assertDatabaseHas('users', [
            'email' => 'sally@example.com'
        ]);
    }

}