<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request) : array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'login' => $this->login
        ];
    }
}
