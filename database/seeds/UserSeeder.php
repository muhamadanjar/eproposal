<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Role::insert([
            ['name' => 'admin'],
            ['name' => 'manager'],
            ['name' => 'user'],
        ]);
    
        // Basic permissions data
        App\Permission::insert([
            ['name' => 'access.backend'],
            ['name' => 'create.user'],
            ['name' => 'edit.user'],
            ['name' => 'delete.user'],

            ['name' => 'create.usulan'],
            ['name' => 'edit.usulan'],
            ['name' => 'delete.usulan'],

            ['name' => 'create.pengecekan'],
            ['name' => 'edit.pengecekan'],
            ['name' => 'delete.pengecekan'],
        ]);
    
        // Add a permission to a role
        $role = App\Role::where('name', 'admin')->first();
        $role->addPermission('access.backend');
        $role->addPermission('create.user');
        $role->addPermission('edit.user');    
        $role->addPermission('delete.user');
        // ... Add other role permission if necessary
    
        // Create a user, and give roles
        $user = App\User::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'name' => 'Admin Aja',
            'password' => bcrypt('password'),
        ]);
    
        $user->assignRole('admin');

        $biasa = App\User::create([
            'username' => 'manajer',
            'email' => 'manajer@example.com',
            'name' => 'Manajer Aja',
            'password' => bcrypt('password'),
        ]);
    
        $biasa->assignRole('manager');

        $biasa = App\User::create([
            'username' => 'user',
            'email' => 'user@example.com',
            'name' => 'User Aja',
            'password' => bcrypt('password'),
        ]);
    
        $biasa->assignRole('user');
    }
}
