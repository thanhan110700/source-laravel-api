<?php

namespace App\Models\Traits\Method;

/**
 * Trait UserMethod.
 */
trait UserMethod
{
    /**
     * @return mixed
     */
    public function isAdmin(): bool
    {
        return $this->type === self::TYPE_ADMIN;
    }

    /**
     * @return mixed
     */
    public function isUser(): bool
    {
        return $this->type === self::TYPE_USER;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function isVerified(): bool
    {
        return $this->email_verified_at !== null;
    }

    /**
     * @param  bool  $size
     * @return mixed|string
     *
     * @throws \Creativeorange\Gravatar\Exceptions\InvalidEmailException
     */
    public function getAvatar($size = null)
    {
        return 'https://gravatar.com/avatar/'.md5(strtolower(trim($this->email))).'?s='.config('boilerplate.avatar.size', $size).'&d=mp';
    }
}
