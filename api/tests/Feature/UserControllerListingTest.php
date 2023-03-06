<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserControllerListingTest extends TestCase
{
    public function test_successful_index()
    {
        $response = $this->get('/users');

        $response->assertStatus(200);
        $response->assertJsonStructure($this->getValidCollectionStructure());
    }

    protected function getValidCollectionStructure(): array
    {
        return [
            'data' => [
                "*" => [
                    'id',
                    'name',
                    'email',
                    'lat',
                    'lng'
                ]
            ]
        ];
    }
}