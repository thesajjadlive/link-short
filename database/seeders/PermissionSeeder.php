<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleDashboard = Module::updateOrCreate( ['name' => 'Dashboard'] );
        Permission::updateOrCreate( [
            'module_id' => $moduleDashboard->id,
            'name'      => 'Access Dashboard',
            'slug'      => 'app.dashboard',
        ] );

        /*Role module Permission*/
        $moduleRole = Module::updateOrCreate( ['name' => 'Role Management'] );
        Permission::updateOrCreate( [
            'module_id' => $moduleRole->id,
            'name'      => 'Access Role',
            'slug'      => 'app.roles.index',
        ] );
        Permission::updateOrCreate( [
            'module_id' => $moduleRole->id,
            'name'      => 'Create Role',
            'slug'      => 'app.roles.create',
        ] );
        Permission::updateOrCreate( [
            'module_id' => $moduleRole->id,
            'name'      => 'Edit Role',
            'slug'      => 'app.roles.edit',
        ] );
        Permission::updateOrCreate( [
            'module_id' => $moduleRole->id,
            'name'      => 'Delete Role',
            'slug'      => 'app.roles.destroy',
        ] );

        /*User Module Permission*/
        $moduleUser = Module::updateOrCreate( ['name' => 'User Management'] );

        Permission::updateOrCreate( [
            'module_id' => $moduleUser->id,
            'name'      => 'Access User',
            'slug'      => 'app.users.index',
        ] );
        Permission::updateOrCreate( [
            'module_id' => $moduleUser->id,
            'name'      => 'Create User',
            'slug'      => 'app.users.create',
        ] );
        Permission::updateOrCreate( [
            'module_id' => $moduleUser->id,
            'name'      => 'Edit User',
            'slug'      => 'app.users.edit',
        ] );
        Permission::updateOrCreate( [
            'module_id' => $moduleUser->id,
            'name'      => 'Delete User',
            'slug'      => 'app.users.destroy',
        ] );

        /*Setting Module Permission*/
        $appSettingModule = Module::updateOrCreate( ['name' => 'App Settings'] );
        Permission::updateOrCreate( [
            'module_id' => $appSettingModule->id,
            'name'      => 'Access setting module',
            'slug'      => 'app.setting.index',
        ] );





    }
}
