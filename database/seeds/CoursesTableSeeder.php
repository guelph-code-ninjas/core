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
        factory(App\Course::class, 5)->create()
            ->each(function ($c) {
                $persons = factory(App\User::class, 10)->create();
                $c->register($persons[0], 'instructor');
                $c->register($persons[1], 'instructor');
                $c->register($persons[2], 'assistant');
                $c->register($persons[3], 'assistant');
                $c->register($persons[4], 'assistant');
                $persons->splice(5)
                ->each( function ($u) use($c) {
                    $c->register($u, 'student');
                });
            });

        factory(App\Course::class, 2)->create();
                    
    }
}
