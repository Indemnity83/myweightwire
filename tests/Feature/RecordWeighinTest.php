<?php

namespace Tests\Feature;

use App\User;
use App\Weighin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecordWeighinTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function a_user_can_record_a_weighin()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->post('/weighins', [
            'weight' => 185.3,
        ]);

        $response->assertRedirect('/weighins');
        tap(Weighin::first(), function ($weighin) use ($user) {
            $this->assertEquals($user->id, $weighin->user_id);
            $this->assertTrue(today()->eq($weighin->weighed_at));
            $this->assertEquals(185.3, $weighin->weight);
        });
    }

    /** @test **/
    public function users_must_be_logged_in_to_record_weight()
    {
        $response = $this->post('/weighins', [
            'weight' => 185.3,
        ]);

        $response->assertRedirect('/login');
        $this->assertCount(0, Weighin::all());
    }

    /** @test **/
    public function users_account_must_be_approved_to_record_weight()
    {
        $user = factory(User::class)->state('unapproved')->create();
        $this->actingAs($user);

        $response = $this->post('/weighins', [
            'weight' => 185.3,
        ]);

        $response->assertRedirect('/account/approval');
        $this->assertCount(0, Weighin::all());
    }

    /** @test **/
    public function users_account_must_be_verified_to_record_weight()
    {
        $user = factory(User::class)->state('unverified')->create();
        $this->actingAs($user);

        $response = $this->post('/weighins', [
            'weight' => 185.3,
        ]);

        $response->assertRedirect('/email/verify');
        $this->assertCount(0, Weighin::all());
    }

    /** @test **/
    public function only_one_weighin_per_day_per_user()
    {
        $user = factory(User::class)->create();
        factory(Weighin::class)->create([
            'user_id' => $user->id,
            'weighed_at' => today(),
            'weight' => 150.0,
        ]);

        $this->actingAs($user);
        $this->from('/weighins');

        $response = $this->post('/weighins', [
            'weight' => 185.3,
        ]);

        $response->assertRedirect('/weighins');
        $this->assertCount(1, Weighin::all());
        tap(Weighin::first(), function ($weighin) use ($user) {
            $this->assertTrue(today()->eq($weighin->weighed_at));
            $this->assertEquals(185.3, $weighin->weight);
        });
    }

    /** @test **/
    public function weight_is_required()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
        $this->from('/weighins');

        $response = $this->post('/weighins', [
            'weight' => '',
        ]);

        $response->assertRedirect('/weighins');
        $response->assertSessionHasErrors('weight');
        $this->assertCount(0, Weighin::all());
    }

    /** @test **/
    public function weight_is_numeric()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
        $this->from('/weighins');

        $response = $this->post('/weighins', [
            'weight' => 'beefcake',
        ]);

        $response->assertRedirect('/weighins');
        $response->assertSessionHasErrors('weight');
        $this->assertCount(0, Weighin::all());
    }

    /** @test **/
    public function weight_is_greater_than_100()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
        $this->from('/weighins');

        $response = $this->post('/weighins', [
            'weight' => 99,
        ]);

        $response->assertRedirect('/weighins');
        $response->assertSessionHasErrors('weight');
        $this->assertCount(0, Weighin::all());
    }

    /** @test **/
    public function weight_is_less_than_300()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
        $this->from('/weighins');

        $response = $this->post('/weighins', [
            'weight' => 301,
        ]);

        $response->assertRedirect('/weighins');
        $response->assertSessionHasErrors('weight');
        $this->assertCount(0, Weighin::all());
    }
}
