<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class DeleteUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:delete-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete user account if he neither verified nor social register ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       User::whereNull('email_verified_at')->WhereNull('google_id')->delete();
        
    }
}
