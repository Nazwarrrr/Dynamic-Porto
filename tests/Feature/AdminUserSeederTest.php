<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminUserSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_credentials_are_updated_for_the_existing_admin(): void
    {
        $admin = User::factory()->create([
            'email' => 'old-admin@example.test',
            'password' => 'old-test-password',
        ]);
        config()->set('services.admin.email', 'new-admin@example.test');
        config()->set('services.admin.password', 'new-test-password');

        $this->seed(AdminUserSeeder::class);

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', [
            'id' => $admin->id,
            'email' => 'new-admin@example.test',
        ]);
        $this->assertTrue(Hash::check('new-test-password', $admin->fresh()->password));
    }

    public function test_admin_credentials_are_preserved_when_no_runtime_values_are_configured(): void
    {
        $admin = User::factory()->create([
            'email' => 'existing-admin@example.test',
            'password' => 'existing-test-password',
        ]);
        config()->set('services.admin.email', null);
        config()->set('services.admin.password', null);

        $this->seed(AdminUserSeeder::class);

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', [
            'id' => $admin->id,
            'email' => 'existing-admin@example.test',
        ]);
        $this->assertTrue(Hash::check('existing-test-password', $admin->fresh()->password));
    }
}
