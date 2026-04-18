<?php

namespace App\Services\Address;

use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AddressService {

    public function index() {

        // $authUser = Auth::user();
        // $user = User::where('id', $authUser->id);
        $data = Http::get("https://brasilapi.com.br/api/cep/v2/12722810");

        return $data->json();

    }

    public function store(array $data) {

        $authUser = Auth::user();

        return DB::transaction(function() use ($data, $authUser) {

            $cep = Http::get("https://brasilapi.com.br/api/cep/v2/{$data['zip_code']}");
            $cep->json();

            $coordinates = $cep['location']['coordinates'] ?? null;

            $address = Address::create([
                'street' => $cep['street'],
                'number' => $data['number'],
                'neighborhood' => $cep['neighborhood'],
                'state' => $cep['state'],
                'city' => $cep['city'],
                'reference' => $data['reference'],
                'complement' => $data['complement'],
                'zip_code' => $data['zip_code'],
                'latitude' => $coordinates['latitude'] ?? null,
                'longitude' => $coordinates['longitude'] ?? null,
                'user_id' => $authUser->id
            ]);

            return $address->load(['user']);

        });

    }

}

