<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Apartment extends Model
{
    public function realtor()
    {
        return $this->belongsTo('App\User', 'realtor_id');
    }

    public function lookupGeoLocation($address)
    {
        // Lookup address with Google Geocoding service
        $address = urlencode($address);
        $api_key = env('GOOGLE_API_KEY');
        $service_url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key={$api_key}";

        $response = Http::get($service_url);
        if(!$response || !$response->json() || isset($response->json()['error_message'])) {
            Log:error("Service Error: " . $response->json()['error_message']);
            return;
        }

        // Read results from response and save to model
        $results = $response->json()['results'];

        try {
            if ($results) {
                $this->latitude = $results[0]['geometry']['location']['lat'];
                $this->longitude = $results[0]['geometry']['location']['lng'];
            }
        } catch (\Exception $e) {
            Log::error('Error while Geocoding address in Apartment model: ' . $e->getMessage());
        }
    }
}
