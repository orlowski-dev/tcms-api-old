<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "user_id" => $this->user_id,
            'phoneNumber' => $this->phone_number,
            'address' => $this->address,
            'city' => $this->city,
            'postalCode' => $this->postal_code
        ];
    }
}