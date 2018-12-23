<?php

namespace Tests\Feature;

use App\User;
use App\Weighin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteWeighinTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function a_user_can_delete_a_weighin()
    {
        $user = factory(User::class)->create();
        $weighin = factory(Weighin::class)->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $response = $this->delete("/weighins/{$weighin->id}");

        $response->assertRedirect('/weighins');
        $this->assertDatabaseMissing('weighins', ['id' => $weighin->id]);
    }

    /** @test **/
    public function users_must_be_logged_in_to_delete_weight()
    {
        $weighin = factory(Weighin::class)->create();

        $response = $this->delete("/weighins/{$weighin->id}");

        $response->assertRedirect('/login');
        $this->assertDatabaseHas('weighins', ['id' => $weighin->id]);
    }

    /** @test **/
    public function users_account_must_be_approved_to_delete_weight()
    {
        $user = factory(User::class)->state('unapproved')->create();
        $weighin = factory(Weighin::class)->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $response = $this->delete("/weighins/{$weighin->id}");

        $response->assertRedirect('/account/approval');
        $this->assertDatabaseHas('weighins', ['id' => $weighin->id]);
    }

    /** @test **/
    public function users_account_must_be_verified_to_delete_weight()
    {
        $user = factory(User::class)->state('unverified')->create();
        $weighin = factory(Weighin::class)->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $response = $this->delete("/weighins/{$weighin->id}");

        $response->assertRedirect('/email/verify');
        $this->assertDatabaseHas('weighins', ['id' => $weighin->id]);
    }

    /** @test **/
    public function user_must_own_weighin()
    {
        $userA = factory(User::class)->create();
        $userB = factory(User::class)->create();
        $weighin = factory(Weighin::class)->create(['user_id' => $userB->id]);

        $this->actingAs($userA);

        $response = $this->delete("/weighins/{$weighin->id}");

        $response->assertStatus(403);
        $this->assertDatabaseHas('weighins', ['id' => $weighin->id]);
    }
}
