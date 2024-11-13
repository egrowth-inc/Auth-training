<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // パーミッションの作成（存在しない場合のみ）
        Permission::firstOrCreate(['name' => 'access admin dashboard']);
        Permission::firstOrCreate(['name' => 'edit articles']);
        Permission::firstOrCreate(['name' => 'delete articles']);
        Permission::firstOrCreate(['name' => 'publish articles']);
        Permission::firstOrCreate(['name' => 'unpublish articles']);

        // ロールの作成（存在しない場合のみ）
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $writerRole = Role::firstOrCreate(['name' => 'user']);

        // パーミッションの割り当て
        $adminRole->givePermissionTo(Permission::all());

        $writerRole->givePermissionTo('edit articles');
    }
}
