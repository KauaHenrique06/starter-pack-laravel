<?php

namespace App\Services\Address;

use Illuminate\Support\Facades\DB;

class AddressService {

    public function store(array $data) {

        DB::transaction(function() use ($data) {
            //
        });

    }

}
