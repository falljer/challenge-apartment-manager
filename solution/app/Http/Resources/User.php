<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // Populate Roles List
        try {
            $roles = $this->roles;
            $role_names = [];
            foreach ($roles as $role)
                $role_names[] = $role->name;

            // Return object
            return [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'roles' => $role_names,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ];
        } catch(\Exception $e) {
            return [];
        }


    }
}
