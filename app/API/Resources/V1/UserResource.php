<?php

namespace App\API\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($request->query('includes')) {
            $this->load(explode(',', $request->query('includes')));
        }

        return [
            'id'            => (int) $this->id,
            'name'          => (string) $this->name,
            'email'         => (string) $this->email,
            'roles'         => RoleResource::collection($this->whenLoaded('roles')),
            'permissions'   => PermissionResource::collection($this->whenLoaded('permissions')),
            'createdAt'     => (string) $this->created_at ?? $this->created_at->toDateTimeString(),
            'updatedAt'     => (string) $this->updated_at ?? $this->updated_at->toDateTimeString(),
            'deletedAt'     => (string) $this->deleted_at ?? $this->deleted_at->toDateTimeString()
        ];
    }
}
