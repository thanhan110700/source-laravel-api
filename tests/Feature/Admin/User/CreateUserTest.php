<?php

namespace Tests\Feature\Admin\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

/**
 * Class CreateUserTest.
 */
class CreateUserTest extends TestCase
{
    /** @test */
    public function create_user_requires_login()
    {
        $response = $this->json('POST', '/api/v1/users');
        $this->checkAuthenticationExceptionResponse($response);
    }

    /** @test */
    public function create_user_requires_validation()
    {
        $this->loginAsAdmin();
        $response = $this->json('POST', '/api/v1/users');
        $response->assertStatus(400);
        $this->checkValidationErrors($response, ['type', 'name', 'email']);
    }

    /** @test */
    public function user_email_needs_to_be_unique()
    {
        $this->loginAsAdmin();
        User::factory()->create(['email' => 'bill@example.com']);

        $response = $this->post('/api/v1/users', [
            'email' => 'bill@example.com',
        ]);
        $response->assertJsonValidationErrors('email');
        $this->checkValidationErrors($response, ['email']);
    }

    /** @test */
    public function create_user_with_invalid_data()
    {
        $this->loginAsAdmin();
        User::factory()->create(['email' => 'bill@example.com']);

        $response = $this->post('/api/v1/users', []);
        $this->checkValidationErrors($response, ['type', 'name', 'email']);
    }

    /** @test */
    public function admin_can_create_new_user()
    {
        Event::fake();
        $this->loginAsAdmin();
        $payload = [
            'type' => User::TYPE_ADMIN,
            'name' => 'Bill',
            'email' => 'bill@example.com',
            'password' => 'OC4Nzu270N!QBVi%U%qX',
            'password_confirmation' => 'OC4Nzu270N!QBVi%U%qX',
            'active' => '1',
        ];

        $response = $this->post('/api/v1/users', $payload);
        $response->assertStatus(200);
        $this->assertDatabaseHas(
            'users',
            [
                'type'   => $payload['type'],
                'name'   => $payload['name'],
                'email'  => $payload['email'],
                'active' => true,
            ]
        );
        // Event::assertDispatched(UserCreated::class);
    }
}
