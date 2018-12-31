<?php

use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    use \Illuminate\Foundation\Testing\WithFaker;

    /**
     * DemoSeeder constructor.
     */
    public function __construct()
    {
        $this->setUpFaker();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(\App\User::class, 8)->create();
        $competition = factory(\App\Competition::class)->create([
            'starts_on' => today()->subWeeks(3),
            'duration' => 6,
        ]);
        $competition->users()->attach($users->pluck('id')->all());
        $competition->generateRandomMatchups();

        $users->each(function ($user) {
            // Initial Weight
            $weight = $this->faker->randomFloat(1, 150, 275);
            $user->weighins()->create([
                'weighed_at' => today()->subWeeks(3),
                'weight' => $weight,
            ]);

            // Week 1 weight
            $weight -= $this->faker->randomFloat(1, -0.3, 2);
            $user->weighins()->create([
                'weighed_at' => today()->subWeeks(2),
                'weight' => $weight,
            ]);

            // Week 2 weight
            $weight -= $this->faker->randomFloat(1, -0.3, 2);
            $user->weighins()->create([
                'weighed_at' => today()->subWeeks(1),
                'weight' => $weight,
            ]);

            // Week 3 weight
            $weight -= $this->faker->randomFloat(1, -0.3, 2);
            $user->weighins()->create([
                'weighed_at' => today(),
                'weight' => $weight,
            ]);
        });
    }
}
