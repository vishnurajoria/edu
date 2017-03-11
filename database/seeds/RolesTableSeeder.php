<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static $roles = [
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
//          Add all permissions to admin
            if($new_role->name === 'admin'){
                $permissions_array = PermissionsTableSeeder::$permissions_array;
                foreach($permissions_array as $key=>$permission){
                    $new_role->addPermission(App\Permission::where('name', $key)->first());
                }

            }
        }
    }
}
