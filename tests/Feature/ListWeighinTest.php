<?php

namespace Tests\Feature;

use App\User;
use App\Weighin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListWeighinTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function a_user_can_see_create_weighin_page()
    {
        $user = factory(User::class)->create();
        $weighinA = factory(Weighin::class)->create(['user_id' => $user->id]);
        $weighinB = factory(Weighin::class)->create(['user_id' => $user->id]);
        $weighinC = factory(Weighin::class)->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $response = $this->get('/weighins');

        $response->assertStatus(200);
        $response->assertViewIs('weighins.index');
        $this->assertTrue($response->viewData('weighins')->contains($weighinA));
        $this->assertTrue($response->viewData('weighins')->contains($weighinB));
        $this->assertTrue($response->viewData('weighins')->contains($weighinC));
    }

    /** @test **/
    public function a_user_can_not_see_other_users_weighins()
    {
        $userA = factory(User::class)->create();
        $userB = factory(User::class)->create();
        $weighinForUserB = factory(Weighin::class)->create(['user_id' => $userB->id]);

        $this->actingAs($userA);

        $response = $this->get('/weighins');

        $response->assertStatus(200);
        $response->assertViewIs('weighins.index');
        $this->assertFalse($response->viewData('weighins')->contains($weighinForUserB));
    }

    /** @test **/
    public function users_must_be_logged_in_to_see_page()
    {
        $response = $this->get('/weighins');

        $response->assertRedirect('/login');
    }

    /** @test **/
    public function users_account_must_be_approved_to_see_page()
    {
        $user = factory(User::class)->state('unapproved')->create();
        $this->actingAs($user);

        $response = $this->get('/weighins');

        $response->assertRedirect('/account/approval');
    }

    /** @test **/
    public function users_account_must_be_verified_to_see_page()
    {
        $user = factory(User::class)->state('unverified')->create();
        $this->actingAs($user);

        $response = $this->get('/weighins');

        $response->assertRedirect('/email/verify');
    }
}
