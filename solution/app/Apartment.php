<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    public function realtor()
    {
        return $this->belongsTo('App\User', 'realtor_id');
    }

    public function lookupGeoLocation($address)
    {
        $this->latitude = 0;
        $this->longitude = 0;
    }
}
