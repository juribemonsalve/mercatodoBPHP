<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        $admin = Role::create(['name'=>'admin']);
        $standard = Role::create(['name'=>'standard']);
        //admin
        Permission::create(['name'=>'admin.index'])->syncRoles([$admin]);
        //standard
        Permission::create(['name'=>'dashboard'])->syncRoles([$standard]);

    }
}
