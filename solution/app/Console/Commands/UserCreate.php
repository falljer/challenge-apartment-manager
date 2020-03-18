<?php

namespace App\Console\Commands;

use App\Role;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UserCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create User';

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
        // Create a User
        $this->line('');
        $this->line('[Create a User]');

        // Create with model
        $user = new User();
        $user->name = $this->ask('Name (string):');
        $user->email = $this->ask('Email (string):');
        $user->password = bcrypt($this->secret('Password:'));
        $user->save();

        // Roles
        $roles = explode(', ', $this->ask('Roles? Comma separate like: admin, realtor, client'));
        foreach($roles as $role_name) {
            $role = Role::where('name', $role_name)->first();
            if($role) {
                $now = date('Y-m-d h:i:s');
                DB::table('role_user')->insert([
                    'user_id' => $user->id,
                    'role_id' => $role->id,
                    'created_at' => $now,
                    'updated_at' => $now
                ]);
            }

        }

        // Output Success
        $this->info('Successfully created user with ID=' . $user->id);
    }
}
