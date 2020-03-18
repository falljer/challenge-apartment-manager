<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class UserList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List Users';

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
        // List Users
        $this->line('');
        $this->line('[List Users]');

        // Collect Data
        $headers = ['ID', 'Name', 'Email', 'Created'];
        $users = User::all(['id', 'name', 'email', 'created_at'])
            ->toArray();

        // Display Data
        $this->table($headers, $users);
    }
}
