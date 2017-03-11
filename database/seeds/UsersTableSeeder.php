<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//      Seed the admin - To be removed later!
        $faker = Faker\Factory::create();

        $admin_user = new App\User;

        $admin_user->name = $faker->name;
        $admin_user->email = 'admin'.'@admin.com';
        $admin_user->password = bcrypt('121212');
        $admin_user->remember_token = str_random(10);

        $admin_user->save();

//      Seed 10 users, each one of them being author to a course
        factory(App\User::class, 10)->create()->each(function ($u) {
            $course = factory(App\Course::class)->make();
//            dd($course);
            $u->courses()->save($course);
//          Also enroll them to their courses;
            $u->enrollToCourse($course);
        });

//      Enroll 5 random users(except admin) to 5 random courses
        $user_ids = DB::table('users')->orderBy('id', 'asc')->pluck('id');
        $course_ids = DB::table('courses')->orderBy('id', 'asc')->pluck('id');
//        dd($user_ids);
        for ($i=0; $i <= 5; $i++){
            $random_user_id = $user_ids[rand(1, count($user_ids)-1)];
            $random_course_id = $course_ids[rand(0, count($course_ids)-1)];

            App\User::find($random_user_id)->enrollToCourse(App\Course::find($random_course_id));

        }
    }
}
