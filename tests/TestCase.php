<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\TestResponse;

abstract class TestCase extends BaseTestCase
{
    public $totalDefaultUser = 2;

    use CreatesApplication, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('db:seed');
    }

    protected function getMasterAdmin()
    {
        return User::find(1);
    }

    protected function loginAsAdmin($admin = false)
    {
        if (!$admin) {
            $admin = $this->getMasterAdmin();
        }

        $this->actingAs($admin);
        // Sanctum::actingAs($admin);

        return $admin;
    }

    protected function logout()
    {
        return auth()->logout();
    }

    protected function checkSuccessResponse($res)
    {
        $res->assertStatus(200);
        $response = $res->json();
        // $this->assertObjectHasAttribute('success', $response);
        $this->assertTrue($response->success);
    }

    protected function checkValidationErrors(TestResponse $response, array $hasFields, array $notHasFields = [])
    {
        $response->assertStatus(400);
        $response->assertJsonValidationErrors($hasFields);
        $response->assertJsonMissingValidationErrors($notHasFields);
    }

    protected function checkAuthenticationExceptionResponse(TestResponse $response)
    {
        $response->assertStatus(401);
        $data = $response->json();
        $this->assertArrayHasKey('message', $data);
        $this->assertEquals($data['message'], 'Unauthenticated.');
    }

    protected function checkResponseResourceDetail(TestResponse $response, array $fields)
    {
        $response->assertJsonStructure($fields);
    }

    protected function checkSuccessResponseResourceList(TestResponse $response, array $fields)
    {
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => $fields,
            ],
        ]);
    }

    protected function checkDatabaseHas(string $table, array $data)
    {
        $this->assertDatabaseHas(
            $table,
            $data,
        );
    }
}
