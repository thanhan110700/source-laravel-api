<?php

namespace Tests\Feature\Admin\User;

use App\Models\User;
use Tests\TestCase;

class ListUsersTest extends TestCase
{
    private $responseFields = [
        'id',
        'type',
        'name',
        'email',
        'active',
    ];

    /** @test */
    public function list_users_requires_login()
    {
        $response = $this->get('/api/v1/users');
        $this->checkAuthenticationExceptionResponse($response);
    }

    /** @test */
    public function should_list_all_users(): void
    {
        $this->loginAsAdmin();
        $users = User::factory()->times(30)->create();
        $response = $this->get('/api/v1/users');
        $response->assertStatus(200);
        $response->assertJsonCount(25, 'data');
        $this->checkSuccessResponseResourceList($response, $this->responseFields);
        $response->assertJsonFragment([
            'type' => $users[0]->type,
            'name' => $users[0]->name,
            'email' => $users[0]->email,
        ]);
    }

    /** @test */
    public function should_list_all_users_page2(): void
    {
        $this->loginAsAdmin();
        $perPage = 25;
        $users = User::factory()->times(30)->create();
        $response = $this->get('/api/v1/users?page=2');
        $response->assertStatus(200);
        $response->assertJsonCount(30 - $perPage + $this->totalDefaultUser, 'data');
        $this->checkSuccessResponseResourceList($response, $this->responseFields);
        $response->assertJsonFragment([
            'type' => $users[26]->type,
            'name' => $users[26]->name,
            'email' => $users[26]->email,
        ]);
    }
}
