<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class UserControllerShowTest extends TestCase
{
    public function test_successful_show()
    {
        $user = User::factory()->create();

        $response = $this->get("/users/{$user->id}");

        $response->assertStatus(200);
        $response->assertJsonStructure($this->getValidJsonResourceStructure());
    }

    protected function getValidJsonResourceStructure(): array
    {
        return [
            'data' => [
                'id',
                'name',
                'email',
                'lat',
                'lng',
                'weather'
            ]
        ];
    }

    public function test_not_found_resource()
    {
        $user = User::factory()->create();
        $id = $user->id;
        $user->delete();

        $response = $this->get("/users/{$id}");

        $response->assertNotFound();
    }
}