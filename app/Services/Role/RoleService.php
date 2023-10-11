<?php

namespace App\Services\Role;

use App\Models\Role;

class RoleService
{
    public function store(string $request): Role
    {
        return Role::create($request);
    }
}