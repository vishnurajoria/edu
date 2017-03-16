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
            if($new_role->name === 'student'){
                App\User::find(2)->addRole($new_role);
            }
            if($new_role->name === 'teacher'){
                App\User::find(3)->addRole($new_role);
            }
        }

        $students = App\User::orderBy('id', 'asc')->skip(3)->take(5)->get();
        $teachers = App\User::orderBy('id', 'asc')->skip(8)->take(3)->get();
        $editors = App\User::orderBy('id', 'asc')->skip(11)->take(2)->get();

        $teachers->each(function ($item, $key) {
            $course = factory(App\Course::class)->make();

            $item->addRole(App\Role::find(3));
//          Publish a course for teachers.
            $item->courses()->save($course);
//          Also enroll them to their courses;
            $item->enrollToCourse($course);
        });

        $students->each(function ($item, $key) {
            $course_id = $key ? $key < 4 : 0;
            $course = App\Course::find($course_id+1);
            $item->addRole(App\Role::find(4));
//            dd($course);
            $item->enrollToCourse($course);
        });

        $editors->each(function ($item, $key) {
            return $item->addRole(App\Role::find(2));
        });

    }
}
