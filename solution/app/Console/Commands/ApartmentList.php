<?php

namespace App\Console\Commands;

use App\Apartment;
use Illuminate\Console\Command;

class ApartmentList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apartment:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List Apartments';

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
        // List Apartments
        $this->line('');
        $this->line('[List Apartments]');

        // Collect Data
        $headers = ['ID', 'Name', 'Description', 'SqFt', 'Price', 'Rooms', 'Created'];
        $apartments = Apartment::all(['id', 'name', 'description', 'floor_area_size', 'price_per_month', 'number_of_rooms', 'created_at'])
            ->toArray();

        // Display Data
        $this->table($headers, $apartments);
    }
}
