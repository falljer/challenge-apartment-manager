<?php

namespace App\Console\Commands;

use App\Role;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UserUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update User';

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
        // Update a User
        $this->line('');
        $this->line('[Update a User]');

        // Collect Data
        $user_id = $this->ask('User ID?');
        $user = User::find($user_id);
        if(!$user) {
            $this->error("Couldn't find user with ID={$user_id}");
            return;
        }

        // Update with model
        $user->name = $this->ask('Name (string):', $user->name);
        $user->email = $this->ask('Email (string):', $user->email);
        $password = $this->secret('Password: (blank to not update):');
        if($password) $user->password = bcrypt($password);
        $user->save();

        // Roles
        $roles = explode(', ', $this->ask('Roles? Comma separate like: admin, realtor, client'));
        DB::table('role_user')->where('user_id', $user_id)->delete();
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
        $this->info('Successfully update user with ID=' . $user->id);
    }
}
