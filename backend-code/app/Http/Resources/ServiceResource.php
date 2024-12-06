<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'department' => DepartmentResource::make($this->whenLoaded('department')),
            'name' => $this->name,
            'description' => $this->description,
            'amount' => $this->amount,
            'type' => $this->type,
        ];
    }
}
