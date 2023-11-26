<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AssignSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:assign-super-admin {userId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign the super admin role to a user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->argument('userId');
        $user = User::where('id', $userId)->first();

        if ($user) {
            // Обновление роли пользователя
            User::where('id', $userId)->update(['role' => 'super admin']);
            $this->info("User with ID $userId has been assigned the super admin role.");
        } else {
            $this->error("User with ID $userId not found.");
        }
    }
}
