<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Resources\Role\RoleResource;
use App\Services\Role\RoleService;
use App\Support\ApiResponse;

class RoleController extends Controller
{

    public function __construct(protected RoleService $roleService) {}

    public function index() {

        $data = $this->roleService->index();
        return ApiResponse::success(
            RoleResource::collection($data),
            'Roles indexed with success!',
            200
        );
    }
}
