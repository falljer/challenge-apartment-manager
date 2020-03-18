<?php

namespace App\Console\Commands;

use App\Apartment;
use Illuminate\Console\Command;

class ApartmentRemove extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apartment:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove Apartment';

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
        // Remove an Apartment
        $this->line('');
        $this->line('[Remove an Apartment]');

        // Collect Data
        $apartment_id = $this->ask('Apartment ID?');
        $apartment = Apartment::find($apartment_id);
        if(!$apartment) {
            $this->error("Couldn't find apartment with ID={$apartment_id}");
            return;
        }

        // Verify
        $headers = ['ID', 'Name', 'Description', 'SqFt', 'Price', 'Rooms', 'Created'];
        $apartments = Apartment::all(['id', 'name', 'description', 'floor_area_size', 'price_per_month', 'number_of_rooms', 'created_at'])
            ->where('id', $apartment_id)
            ->toArray();
        $this->table($headers, $apartments);
        $response = $this->choice('Are you sure you want to remove this?', ['Yes', 'No']);

        // Perform Delete
        if($response == 'Yes') {
            $apartment->delete();
            $this->info('Successfully removed apartment with ID=' . $apartment_id);
        } else {
            $this->info('Canceled!');
        }
    }
}
