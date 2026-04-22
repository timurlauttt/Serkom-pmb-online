<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure existing users have a role (migration defaults to admin, but just in case)
        $users = User::whereNull('role')->get();
        foreach ($users as $user) {
            $user->update(['role' => 'admin']);
        }

        // Create Admin PPDB
        $ppdbUser = User::where('name', 'admin_ppdb')->first();
        if (!$ppdbUser) {
            User::create([
                'name' => 'admin_ppdb',
                'email' => 'ppdb@smktamansiswa.sch.id',
                'password' => Hash::make('password'),
                'role' => 'adminPPDB',
            ]);
            $this->command->info('User admin_ppdb created successfully.');
        } else {
             $ppdbUser->update(['role' => 'adminPPDB']);
             $this->command->info('User admin_ppdb updated to role adminPPDB.');
        }
    }
}
