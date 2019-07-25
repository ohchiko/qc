<?php

namespace App\API\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
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
            'id'            => (int) $this->id,
            'customer'      => (string) $this->cust_name,
            'description'   => (string) $this->description,
            'estDelivery'   => (string) $this->est_delivery->toDateTimeString(),
            'status'        => (string) $this->status,
            'user'          => new UserResource($this->user),
            'createdAt'     => (string) $this->created_at ?? $this->created_at->toDateTimeString(),
            'updatedAt'     => (string) $this->updated_at ?? $this->updated_at->toDateTimeString()
        ];
    }
}
