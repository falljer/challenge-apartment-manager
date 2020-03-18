<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UserRemove extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove User';

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
        // Remove a User
        $this->line('');
        $this->line('[Remove a User]');

        // Collect Data
        $user_id = $this->ask('User ID?');
        $user = User::find($user_id);
        if(!$user) {
            $this->error("Couldn't find user with ID={$user_id}");
            return;
        }

        // Verify
        $headers = ['ID', 'Name', 'Email', 'Created'];
        $users = User::all(['id', 'name', 'email', 'created_at'])
            ->where('id', $user_id)
            ->toArray();
        $this->table($headers, $users);
        $response = $this->choice('Are you sure you want to remove this?', ['Yes', 'No']);

        // Perform Delete
        if($response == 'Yes') {
            DB::table('role_user')->where('user_id', $user_id)->delete();
            $user->delete();
            $this->info('Successfully removed user with ID=' . $user_id);
        } else {
            $this->info('Canceled!');
        }
    }
}
