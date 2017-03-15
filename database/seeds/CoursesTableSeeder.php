<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = factory(App\Course::class, 5)->create();

        //Case where course has no assignments
        $c = $courses[0];

        $persons = factory(App\User::class, 10)->create();
        $c->register($persons[0], 'instructor');
        $c->register($persons[1], 'instructor');
        $c->register($persons[2], 'assistant');
        $c->register($persons[3], 'assistant');
        $c->register($persons[4], 'assistant');

        //Case where course has only one assignment
        $c = $courses[1];
        
        $persons = factory(App\User::class, 10)->create();
        $c->register($persons[0], 'instructor');
        $c->register($persons[1], 'instructor');
        $c->register($persons[2], 'assistant');
        $c->register($persons[3], 'assistant');
        $c->register($persons[4], 'assistant');

        $assignment = factory(App\Assignment::class, 1)->make();
        $c->newAssignment($assignment[0]);
        
        //Case where courses have many assignments
        $courses->splice(2)
            ->each(function ($c) {
                $persons = factory(App\User::class, 10)->create();
                $assignments = factory(App\Assignment::class, 5)->make();

                $c->register($persons[0], 'instructor');
                $c->register($persons[1], 'instructor');
                $c->register($persons[2], 'assistant');
                $c->register($persons[3], 'assistant');
                $c->register($persons[4], 'assistant');

                $persons->splice(5)->each( function ($u) use($c) {
                    $c->register($u, 'student');
                });

                $assignments->each(function ($a) use($c) {
                    $c->newAssignment($a);
                });


            });

        factory(App\Course::class, 2)->create();
    }
}
