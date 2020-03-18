<?php

namespace App\Console\Commands;

use App\Apartment;
use Illuminate\Console\Command;

class ApartmentUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apartment:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Apartment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Update an Apartment
        $this->line('');
        $this->line('[Update an Apartment]');

        // Collect Data
        $apartment_id = $this->ask('Apartment ID?');
        $apartment = Apartment::find($apartment_id);
        if(!$apartment) {
            $this->error("Couldn't find apartment with ID={$apartment_id}");
            return;
        }

        // Update with model
        $apartment->name = $this->ask('Name (string):', $apartment->name);
        $apartment->description = $this->ask('Description (string):', $apartment->description);
        $apartment->floor_area_size = $this->ask('Floor Area Size (integer, sqft):', $apartment->floor_area_size);
        $apartment->price_per_month = $this->ask('Price Per Month (integer): $', $apartment->price_per_month);
        $apartment->number_of_rooms = $this->ask('Number of Rooms (integer):', $apartment->number_of_rooms);
        $apartment->realtor_id = $this->ask('Realtor ID (integer):', $apartment->realtor_id);
        $address = $this->ask('Apartment Address (all one line, blank to not change):');
        if($address) $apartment->lookupGeoLocation($address);
        $apartment->save();

        // Output Success
        $this->info('Successfully updated apartment with ID=' . $apartment->id);
    }
}
