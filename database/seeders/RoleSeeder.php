<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Admin => todo
        standar => dashboard
        */
        $admin = Role::create(['name'=>'Admin']);
        $client = Role::create(['name'=>'Client']);

        Permission::create(['name'=>'user.index'])->syncRoles([$admin]);
        Permission::create(['name'=>'category.index'])->syncRoles([$admin]);
        Permission::create(['name'=>'product.index'])->syncRoles([$admin]);

        Permission::create(['name'=>'order.report'])->syncRoles([$admin]);

        Permission::create(['name'=>'dashboard'])->syncRoles([$client]);
    }
}
