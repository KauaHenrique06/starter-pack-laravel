<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\StorePermissionRequest;
use App\Http\Resources\Permission\PermissionResource;
use App\Services\Permission\PermissionService;
use App\Support\ApiResponse;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct(protected PermissionService $permissionService) {}

    public function store(StorePermissionRequest $request) {

        $data = $this->permissionService->store($request->validated());
        return ApiResponse::success(
            new PermissionResource($data),
            'Permissions created with success!',
            201
        );
    }
}
