<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       // return parent::toArray($request);

       return [
        "id"=> $this->id,
        'customer_name' => $this->customer_name,
        'company' => $this->company,
        'email' => $this->email,
        'country' => $this->country,
        'firstAddress'=> $this->firstAddress,
        'secondAddress'=> $this->secondAddress,
        'created_at'=> $this->created_at->format('Y-m-d H:i:s')
        ];
    }
}


