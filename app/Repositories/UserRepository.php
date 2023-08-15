<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    /**
     * Model
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }
}
