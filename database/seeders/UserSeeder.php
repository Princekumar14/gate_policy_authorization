<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(path:'database/json/users.json');

        $users = collect(json_decode($json));
    
        $users->each(function($user){
            User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => bcrypt($user->password),
                'role' => $user->role
            ]);
        });
    }
}
