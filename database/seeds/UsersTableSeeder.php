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

            $task = factory(App\Task::class)->make();
            $u->tasks()->save($task);
        });

    }
}
