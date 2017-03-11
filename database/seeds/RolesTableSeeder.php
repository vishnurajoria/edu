<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected static $roles = [
        'admin' => 'Adminu la tot',
        'editor' => 'Editor',
        'teacher' => 'Teacher',
        'student' => 'Student',
    ];
    public function run()
    {
        foreach(self::$roles as $key=>$role){
            $new_role = new App\Role;

            $new_role->name = $key;
            $new_role->label = $role;

            $new_role->save();
//          Add all permissions to admin role
            if($new_role->name === 'admin'){
                $permissions_array = PermissionsTableSeeder::get_permissions();
                foreach($permissions_array as $key=>$permission){
                    $new_role->addPermission(App\Permission::where('name', $key)->first());
                }
//              Set the admin user
                App\User::find(1)->addRole($new_role);
            }
        }
    }
}
