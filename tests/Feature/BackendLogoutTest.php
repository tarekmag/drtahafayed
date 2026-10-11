<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BackendLogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_renders_logout_as_a_post_form(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('backend.dashboard'))
            ->assertOk()
            ->assertSee('action="'.e(route('backend.logout')).'"', false)
            ->assertSee('method="POST"', false)
            ->assertDontSee('href="'.e(route('backend.logout')).'"', false);
    }

    public function test_logout_via_post_logs_the_user_out(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('backend.logout'))
            ->assertRedirect();

        $this->assertGuest();
    }
}
