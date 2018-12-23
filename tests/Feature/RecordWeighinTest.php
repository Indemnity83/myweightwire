<?php

namespace Tests\Feature;

use App\User;
use App\Weighin;
use Carbon\Carbon;
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
            'weighed_at' => '2018-07-22',
            'weight' => 185.3,
        ]);

        $response->assertRedirect('/weighins');
        tap(Weighin::first(), function ($weighin) use ($user) {
            $this->assertEquals($user->id, $weighin->user_id);
            $this->assertTrue(Carbon::parse('2018-07-22')->eq($weighin->weighed_at));
            $this->assertEquals(185.3, $weighin->weight);
        });
    }

    /** @test **/
    public function users_must_be_logged_in_to_record_weight()
    {
        $response = $this->post('/weighins', [
            'weighed_at' => '2018-07-22',
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
            'weighed_at' => '2018-07-22',
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
            'weighed_at' => '2018-07-22',
            'weight' => 185.3,
        ]);

        $response->assertRedirect('/email/verify');
        $this->assertCount(0, Weighin::all());
    }

    /** @test **/
    public function weighed_at_is_required()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
        $this->from('/weighins');

        $response = $this->post('/weighins', [
            'weighed_at' => '',
            'weight' => 185.3,
        ]);

        $response->assertRedirect('/weighins');
        $response->assertSessionHasErrors('weighed_at');
        $this->assertCount(0, Weighin::all());
    }

    /** @test **/
    public function weighed_at_is_a_date()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
        $this->from('/weighins');

        $response = $this->post('/weighins', [
            'weighed_at' => 'Not-a-date',
            'weight' => 185.3,
        ]);

        $response->assertRedirect('/weighins');
        $response->assertSessionHasErrors('weighed_at');
        $this->assertCount(0, Weighin::all());
    }

    /** @test **/
    public function weighed_at_cannot_be_in_the_future()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
        $this->from('/weighins');

        $response = $this->post('/weighins', [
            'weighed_at' => now()->addDay(),
            'weight' => 185.3,
        ]);

        $response->assertRedirect('/weighins');
        $response->assertSessionHasErrors('weighed_at');
        $this->assertCount(0, Weighin::all());
    }

    /** @test **/
    public function only_one_weighin_per_day_per_user()
    {
        $user = factory(User::class)->create();
        factory(Weighin::class)->create([
            'user_id' => $user->id,
            'weighed_at' => '2018-07-22 00:00:00',
        ]);

        $this->actingAs($user);
        $this->from('/weighins');

        $response = $this->post('/weighins', [
            'weighed_at' => '2018-07-22 00:00:00',
            'weight' => 185.3,
        ]);

        $response->assertRedirect('/weighins');
        $response->assertSessionHasErrors('weighed_at');
        $this->assertCount(1, Weighin::all());
    }

    /** @test **/
    public function weight_is_required()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
        $this->from('/weighins');

        $response = $this->post('/weighins', [
            'weighed_at' => '2018-07-22',
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
            'weighed_at' => '2018-07-22',
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
            'weighed_at' => '2018-07-22',
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
            'weighed_at' => '2018-07-22',
            'weight' => 301,
        ]);

        $response->assertRedirect('/weighins');
        $response->assertSessionHasErrors('weight');
        $this->assertCount(0, Weighin::all());
    }
}
