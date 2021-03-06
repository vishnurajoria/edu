<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected static $permissions_array = [
        'add-task' => 'Add tasks',
        'edit-task' => 'Edit tasks',
        'delete-task' => 'Delete tasks',
        'add-course' => 'Add courses',
        'edit-course' => 'Edit courses',
        'delete-course' => 'Delete courses',
    ];

    public static function get_permissions(){
        return static::$permissions_array;
    }

    public function run()
    {


        foreach(self::$permissions_array as $key=>$permission){
            $new_permission = new App\Permission;

            $new_permission->name = $key;
            $new_permission->label = $permission;

            $new_permission->save();
        }
    }
}
