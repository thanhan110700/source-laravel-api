<?php

namespace App\Services;

use App\Services\BaseService;
use App\Repositories\UserRepository;

class UserService extends BaseService
{
    /**
     * Model
     *
     * @return string
     */
    public function repo()
    {
        return UserRepository::class;
    }
}
