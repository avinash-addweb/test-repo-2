<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Carbon;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $users = [
            [
                'adminId' => 'EMP1',
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'mobile_number' => '9999999999',
                'status' => '1',
            ]
        ];

        foreach ($users as $user) {
            Admin::updateOrCreate(['email' => $user['email']], $user);
        }

        // create permissions
        $permissions = [
            [
                "name" => 'User Management',
                'guard_name' => 'web',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ],
            [
                "name" => 'Login Entry',
                'guard_name' => 'web',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ],
            [
                "name" => 'Login Marking',
                'guard_name' => 'web',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ],
            [
                "name" => 'Credit Report Marking',
                'guard_name' => 'web',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ],
            [
                "name" => 'PD Process',
                'guard_name' => 'web',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ],
            [
                "name" => 'SV Process',
                'guard_name' => 'web',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ],
            [
                "name" => 'CAM Inward',
                'guard_name' => 'web',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ],
            [
                "name" => 'CAM Checking',
                'guard_name' => 'web',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ],
            [
                "name" => 'Loan Agreement',
                'guard_name' => 'web',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ],
            [
                "name" => 'Nach',
                'guard_name' => 'web',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ],
            [
                "name" => 'CAM Marking',
                'guard_name' => 'web',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ],
            [
                "name" => 'Disbursement',
                'guard_name' => 'web',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ],
            [
                "name" => 'Repayment',
                'guard_name' => 'web',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission['name']], $permission);
        }
//        create roles and assign existing permissions
        $roles = [
            [
                'name' => 'Super Admin',
                'guard_name' => 'web',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
                'is_for_admin' => 1,
                'is_for_client' => 0
            ],
            [
                'name' => 'Coordinator',
                'guard_name' => 'web',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
                'is_for_admin' => 1,
                'is_for_client' => 0
            ],
            [
                'name' => 'Relationship Officer',
                'guard_name' => 'web',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
                'is_for_admin' => 0,
                'is_for_client' => 1
            ],
            [
                'name' => 'Credit Officer',
                'guard_name' => 'web',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
                'is_for_admin' => 0,
                'is_for_client' => 1
            ],
            [
                'name' => 'Site Visit Executive',
                'guard_name' => 'web',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
                'is_for_admin' => 0,
                'is_for_client' => 1
            ],
            [
                'name' => 'Credit Manager',
                'guard_name' => 'web',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
                'is_for_admin' => 0,
                'is_for_client' => 1
            ],
            [
                'name' => 'Account Officer',
                'guard_name' => 'web',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
                'is_for_admin' => 0,
                'is_for_client' => 1
            ],
            [
                'name' => 'State Head',
                'guard_name' => 'web',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
                'is_for_admin' => 0,
                'is_for_client' => 1
            ]
        ];
        foreach ($roles as $role) {
            $role1 = Role::updateOrCreate(['name' => $role['name']], $role);
            $existingUser = Admin::where("email", "admin@gmail.com")->first();
            if(empty($existingUser)){
                $user = Admin::factory()->create([
                    'name' => 'Super Admin',
                    'email' => 'admin@gmail.com',
                    'password'=> Hash::make('password'),
                    'is_for_admin' => 1,
                    'is_for_client' => 0
                ]);
                $user->assignRole($role1);
//                foreach ($permissions as $permission) {
//                    $role1->givePermissionTo($permission);
//                }
            }
            $existingUser->assignRole($role1);
        }
        // gets all permissions via Gate::before rule; see AuthServiceProvider
        // create demo users

        //call other seeders
        $this->call([
            SettingSeeder::class
        ]);
    }
}
