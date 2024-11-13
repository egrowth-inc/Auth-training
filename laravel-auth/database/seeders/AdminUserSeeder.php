<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // 'admin' ロールを作成または取得
        $role = Role::firstOrCreate(['name' => 'admin']);

        // ユーザーを作成または取得
        $user = User::firstOrCreate(
            ['email' => 'admin@exampleaaa.com'],
            [
                'name' => '管理者',
                'password' => bcrypt('your_secure_password'), // 安全なパスワードを設定
            ]
        );

        // ロールを割り当て
        $user->assignRole($role);
    }
}
