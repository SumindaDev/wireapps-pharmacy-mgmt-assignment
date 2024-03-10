<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks = 0");
        DB::table('role_has_permissions')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();

        //creating permissions
        $ownerPermissions = array(
            "view_medication",
            "edit_medication",
            "add_medication",
            "temp_delete_medication",
            "delete_medication",
            "view_customers",
            "edit_customers",
            "add_customers",
            "temp_delete_customers",
            "delete_customers",
        );

        $managerPermissions = array(
            "view_medication",
            "edit_medication",
            "temp_delete_medication",
            "view_customers",
            "edit_customers",
            "temp_delete_customers",
        );

        $cashierPermissions = array(
            "view_medication",
            "edit_medication",
            "view_customers",
            "edit_customers",
        );

        //inserting permissions to database
        foreach($ownerPermissions as $ownerPermission){

            DB::table('permissions')->insert([

                "name" => $ownerPermission,
                "guard_name" => "web"
                
            ]);
        } 
        

        //create roles
        $ownerRole = Role::create(['name' => 'Owner']);
        $managerRole = Role::create(['name' => 'Manager']);
        $cashierRole = Role::create(['name' => 'Cashier']);

        //assign permissions
        $ownerRole->givePermissionTo($ownerPermissions);
        $managerRole->givePermissionTo($managerPermissions);
        $cashierRole->givePermissionTo($cashierPermissions);

    }
}
