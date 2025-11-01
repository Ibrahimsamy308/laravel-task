<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "image" => $this->image,
            "description" => $this->description,
            "category" => new CategoryResource($this->category),
            "vendor" => new VendorResource($this->vendor),
            "createdBy" => [
                    "id" => $this->createdBy?->id,
                    "name" => $this->createdBy?->name,
                ],
            "amount" => $this->amount,
            "date" => $this->date,

        ];
    }
}