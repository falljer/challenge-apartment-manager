<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class UserSuspend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:suspend {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Suspend User';

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
        // Suspend a User
        $this->line('');
        $this->line('[Suspend a User]');

        // Collect Data
        $user_id = $this->argument('user_id');
        $user = User::find($user_id);
        if(!$user) {
            $this->error("Couldn't find user with ID={$user_id}");
            return;
        }

        // Suspend User

        // TODO: Add suspend field and save

        // Output Success
        $this->info('Successfully suspended user with ID=' . $user->id);
    }
}
