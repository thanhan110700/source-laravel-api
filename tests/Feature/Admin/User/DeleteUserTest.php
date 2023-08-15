<?php

namespace Tests\Feature\Admin\User;

use App\Models\User;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    /** @test */
    public function delete_user_requires_login()
    {
        $response = $this->delete("/api/v1/users/1");
        $this->checkAuthenticationExceptionResponse($response);
    }

    /** @test */
    public function only_admin_can_delete_users(): void
    {
        $this->loginAsAdmin();
        $user = User::factory()->create();
        $response = $this->delete("/api/v1/users/{$user->id}");
        $response->assertStatus(200);
        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }
}
