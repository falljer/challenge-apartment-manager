<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
use App\Http\Resources\User as UserResource;

class Apartment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // Return object
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'floor_area_size' => $this->floor_area_size,
            'price_per_month' => $this->price_per_month,
            'number_of_rooms' => $this->number_of_rooms,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'realtor' => new UserResource(User::find($this->realtor_id)),
            'realtors' => User::whereHas('roles', function(Builder $query) {
                $query->where('name', 'realtor');
            })->get(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
