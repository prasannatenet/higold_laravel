<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@higold.com',
            'password' => Hash::make('TenetiHG@121'),
            'is_admin' => true,
        ]);
    }
}
