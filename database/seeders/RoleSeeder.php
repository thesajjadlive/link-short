<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminPersmissions = Permission::all();
        Role::updateOrCreate( [
            'name'      => 'Super Admin',
            'slug'      => 'super-admin',
            'deletable' => false,
        ] )->permissions()->sync( $adminPersmissions->pluck( 'id' ) );
        Role::updateOrCreate( [
            'name'      => 'Admin',
            'slug'      => 'admin',
            'deletable' => false,
        ] );
    }
}
