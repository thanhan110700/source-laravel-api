<?php

namespace Tests\Feature\Admin\User;

use App\Models\User;
use Tests\TestCase;

class GetUserTest extends TestCase
{
    /** @test */
    public function get_user_requires_login()
    {
        $response = $this->get("/api/v1/users/1");
        $this->checkAuthenticationExceptionResponse($response);
    }

    /** @test */
    public function should_show_a_specific_user(): void
    {
        $this->loginAsAdmin();
        $user = User::factory()->create();
        $response = $this->get("/api/v1/users/{$user->id}");
        $response->assertStatus(200);
        $response->assertJson([
            'id'    => $user->id,
            'name'  => $user->name,
            'email' => $user->email,
        ]);
        $this->checkResponseResourceDetail($response, ['id', 'name', 'email',]);
    }

    /** @test */
    public function should_return_error_not_found(): void
    {
        $this->loginAsAdmin();
        $response = $this->get("/api/v1/users/9999999999");
        $response->assertStatus(404);
    }
}
