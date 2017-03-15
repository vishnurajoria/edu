<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Group::class, 5)->create()->each(function ($g, $i) {
//          Seed some users
            $students = App\User::whereHas('roles', function ($query) {
                $query->where('name', '=', 'student');
            })->inRandomOrder()->take($i)->get();

            $g->users()->saveMany($students);

//          Seed some teachers
            $teachers = App\User::whereHas('roles', function ($query) {
                $query->where('name', '=', 'teacher');
            })->inRandomOrder()->take(rand(1, 3))->get();

            $g->users()->saveMany($teachers);

//          Seed some courses
            $courses = App\Course::inRandomOrder()->take(rand(1, 3))->get();

            $g->courses()->saveMany($courses);

//            dd($courses);
        });
    }
}
