<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class UserDetailResource extends UserListResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $resource = parent::toArray($request);
        // todo

        return $resource;
    }
}
