<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class AdminSeeder extends Seeder
{
    //app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123456'),
            'height' => '155',
            'weight' => '55',
            'goal' => '48',
            'age'=>'25'
            // 'role' => 'admin',
        ]);



    //   // إنشاء الأدوار
    // $adminRole = Role::create(['name' => 'Admin']);
    // $userRole = Role::create(['name' => 'User']);

    // // إنشاء الصلاحيات
    // Permission::create(['name' => 'manage roles']);        // صلاحية لإدارة الأدوار والصلاحيات
    // Permission::create(['name' => 'manage users']);        // صلاحية لإدارة المستخدمين
    // Permission::create(['name' => 'access dashboard']);    // صلاحية للوصول إلى لوحة التحكم
    // Permission::create(['name' => 'view profile']);        // صلاحية لعرض ملف التعريف
    // Permission::create(['name' => 'edit profile']);        // صلاحية لتعديل ملف التعريف

    // // إسناد الصلاحيات إلى الأدوار

    // // صلاحيات Admin
    // $adminRole->givePermissionTo([
    //     'manage roles',
    //     'manage users',
    //     'access dashboard',
    //     'view profile',
    //     'edit profile',
    // ]);

    // // صلاحيات User
    // $userRole->givePermissionTo([
    //     'access dashboard',
    //     'view profile',
    //     'edit profile',
    // ]);
    
    }
}
