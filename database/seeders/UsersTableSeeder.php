<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class UsersTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'type' => User::TYPE_ADMIN,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'password' => bcrypt('secret'),
            ],
            [
                'id' => 2,
                'name' => 'Test User1',
                'email' => 'user@user.com',
                'email_verified_at' => now(),
                'password' => bcrypt('secret'),
            ],
        ];
        foreach ($data as $userItem) {
            User::updateOrCreate(Arr::only($userItem, ['id']), $userItem);
        }
    }
}
