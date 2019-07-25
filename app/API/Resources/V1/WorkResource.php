<?php

namespace App\API\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'        => (int) $this->id,
            'batch'     => (string) $this->batch,
            'description'   => (string) $this->description,
            'status'        => (string) $this->status,
            'purchase'      => new PurchaseResource($this->whenLoaded('purchase')),
            'user'          => new UserResource($this->user),
        ];
    }
}
