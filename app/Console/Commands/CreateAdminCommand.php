<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $user['name'] = $this->ask('Name of the user');
        $user['email'] = $this->ask('Email of the user');
        $user['password'] = $this->secret('Password of the user');

        $validator = Validator::make($user, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email', 'unique:'.Admin::class],
            'password' => ['required', Password::defaults()],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return -1;
        }


        DB::transaction(function () use ($user) {
            $user['password'] = Hash::make($user['password']);
            $user = Admin::create($user);
//            $role = Role::where('name', RoleEnum::ADMIN)->first();
//            $user->roles()->attach($role);
        });

        $this->info('Admin '.$user['email'].' created successfully');

        return 0;
    }
}
