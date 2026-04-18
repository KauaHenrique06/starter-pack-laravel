<?php

namespace App\Http\Controllers\Address;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\StoreAddressRequest;
use App\Services\Address\AddressService;
use App\Support\ApiResponse;

class AddressController extends Controller
{

    public function __construct(protected AddressService $addressService) {}

    public function store(StoreAddressRequest $request) {

        $data = $this->addressService->store($request->validated());
        return ApiResponse::success(
            $data,
            'Address stored with success!',
            201
        );

    }
}
