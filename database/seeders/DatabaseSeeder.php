<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AdminDomain;
use App\Models\Role;
use App\Models\User;
use App\Models\Domain;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roleSuperAdmin = Role::create([
            'name' => 'SuperAdmin'
        ]);

        $superAdmin = User::create([
            'name' => 'AVOTRARIVO Nasandratra James',
            'email' => 'nageorgesdlj@gmail.com',
            'password' => Hash::make('super-admin')
        ]);

        $domainSuperAdmin = Domain::create([
            'url' => 'example.com'
        ]);

        AdminDomain::create([
            'role_id' => $roleSuperAdmin->id,
            'user_id' => $superAdmin->id,
            'domain_id' => $domainSuperAdmin->id
        ]);
        
        Role::create([
            'name' => 'Admin'
        ]);

        Role::create([
            'name' => 'User'
        ]);

        //Domain::factory(10)->create();

        User::factory(30)->create();
    }
}
