<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class UserUnsuspend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:unsuspend {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Unsuspend User';

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
        // Unsuspend a User
        $this->line('');
        $this->line('[Unsuspend a User]');

        // Collect Data
        $user_id = $this->argument('user_id');
        $user = User::find($user_id);
        if(!$user) {
            $this->error("Couldn't find user with ID={$user_id}");
            return;
        }

        // Unsuspend User

        // TODO: Add suspend field and save

        // Output Success
        $this->info('Successfully unsuspended user with ID=' . $user->id);
    }
}
