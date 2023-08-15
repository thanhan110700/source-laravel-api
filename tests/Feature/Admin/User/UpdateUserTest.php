<?php

namespace Tests\Feature\Admin\User;

use App\Models\User;
use Tests\TestCase;

class UpdateUserTest extends TestCase
{

    /** @test */
    public function update_user_requires_login()
    {
        $response = $this->patch("/api/v1/users/1", []);
        $this->checkAuthenticationExceptionResponse($response);
    }

    /** @test */
    public function a_user_can_be_updated(): void
    {
        $this->loginAsAdmin();
        $user = User::factory()->create();
        $dataUpdate = [
            'name' => 'bill001',
            'email' => 'bill001@example.com',
            'type' => User::TYPE_ADMIN,
        ];
        $response = $this->patch("/api/v1/users/{$user->id}", $dataUpdate);
        $response->assertStatus(200);
        $this->assertDatabaseHas(
            'users',
            [
                'type' => $dataUpdate['type'],
                'name' => $dataUpdate['name'],
                'email' => $dataUpdate['email'],
            ]
        );
    }
}
