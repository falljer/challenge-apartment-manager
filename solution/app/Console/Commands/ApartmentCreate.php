<?php

namespace App\Console\Commands;

use App\Apartment;
use Illuminate\Console\Command;

class ApartmentCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apartment:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an Apartment';

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
        // Create an Apartment
        $this->line('');
        $this->line('[Create an Apartment]');

        // Create with model
        $apartment = new Apartment();
        $apartment->name = $this->ask('Name (string):');
        $apartment->description = $this->ask('Description (string):');
        $apartment->floor_area_size = $this->ask('Floor Area Size (integer, sqft):');
        $apartment->price_per_month = $this->ask('Price Per Month (integer): $');
        $apartment->number_of_rooms = $this->ask('Number of Rooms (integer):');
        $apartment->realtor_id = $this->ask('Realtor ID (integer):');
        $address = $this->ask('Apartment Address (all one line):');
        $apartment->lookupGeoLocation($address);
        $apartment->save();

        // Output Success
        $this->info('Successfully created apartment with ID=' . $apartment->id);
    }
}
