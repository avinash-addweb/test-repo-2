<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\JsonSerializable|Arrayable
    {
        return [
            //'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => (($this?->roles[0])?->name)??"",
            'stripe_customer_id' => ($this?->stripe_id)??"",
            //'token' => ($request?->bearerToken())??""
        ];
    }
}