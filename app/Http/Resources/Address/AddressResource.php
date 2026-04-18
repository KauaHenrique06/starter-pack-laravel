<?php

namespace App\Http\Resources\Address;

use App\Http\Resources\Auth\AuthResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'street' => $this->street,
            'neighborhood' => $this->neighborhood,
            'number' => $this->number,
            'city' => $this->city,
            'state' => $this->state,
            'referente' => $this->reference,
            'complement' => $this->complement,
            'zip_code' => $this->zip_code,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'user' => new AuthResource($this->whenLoaded('user'))
        ];
    }
}
