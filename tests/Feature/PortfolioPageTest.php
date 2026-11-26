<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Project;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PortfolioPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_renders_navigation_targets_and_github_activity(): void
    {
        $this->fakeGithubApi(
            repositories: [[
                'html_url' => 'https://github.com/Nazwarrrr/example',
                'name' => 'example',
                'stargazers_count' => 12,
                'description' => 'Example repository',
                'language' => 'PHP',
            ]],
        );

        $response = $this->get(route('home'));

        $response->assertOk()
            ->assertSee('id="skills"', false)
            ->assertSee('id="contact"', false)
            ->assertSee(route('contact.store'), false)
            ->assertSee('href="mailto:nazwarmakarim818@gmail.com"', false)
            ->assertSee('href="https://wa.me/6289509306601?text=Halo%20Nazwar,%20saya%20tertarik%20dengan%20portofolio%20Anda"', false)
            ->assertSee('Example repository')
            ->assertSee('example');
    }

    public function test_homepage_renders_project_fallback_and_hides_empty_categories(): void
    {
        $this->fakeGithubApi();
        $iotCategory = Category::create(['name' => 'IoT & Robotics', 'slug' => 'iot-robotics']);
        Category::create(['name' => 'Mobile App', 'slug' => 'mobile-app']);
        Project::create([
            'category_id' => $iotCategory->id,
            'title' => 'WALL-Z',
            'description' => 'Assistive smart vest and watch.',
            'tech_stack' => 'ESP32, C++',
            'image' => null,
        ]);

        $response = $this->get(route('home'));

        $response->assertOk()
            ->assertSee('project-placeholder', false)
            ->assertSee('aspect-[16/10]', false)
            ->assertSee('WALL-Z')
            ->assertSee('data-copy-value="nazwarmakarim818@gmail.com"', false)
            ->assertSee('data-copy-value="+62 895-0930-6601"', false)
            ->assertSee('Unit &amp; Feature Testing', false)
            ->assertDontSee('Mobile App');
    }

    public function test_homepage_filters_projects_by_category(): void
    {
        $this->fakeGithubApi();
        $webCategory = Category::create(['name' => 'Web Development', 'slug' => 'web-development']);
        $iotCategory = Category::create(['name' => 'IoT', 'slug' => 'iot']);
        Project::create([
            'category_id' => $webCategory->id,
            'title' => 'Visible project',
            'description' => 'A web project',
            'tech_stack' => 'Laravel, PHP',
        ]);
        Project::create([
            'category_id' => $iotCategory->id,
            'title' => 'Hidden project',
            'description' => 'An IoT project',
            'tech_stack' => 'ESP32',
        ]);

        $response = $this->get(route('home', ['category' => 'web-development']));

        $response->assertOk()
            ->assertSee('Visible project')
            ->assertDontSee('Hidden project');
    }

    public function test_homepage_does_not_render_placeholder_project_links(): void
    {
        $this->fakeGithubApi();
        $category = Category::create(['name' => 'Web Development', 'slug' => 'web-development']);
        Project::create([
            'category_id' => $category->id,
            'title' => 'Project with placeholder links',
            'description' => 'A demo project',
            'tech_stack' => 'Laravel',
            'demo_url' => '#',
            'github_url' => 'https://github.com',
        ]);

        $response = $this->get(route('home'));

        $response->assertOk()
            ->assertDontSee('href="#"', false)
            ->assertDontSee('href="https://github.com"', false);
    }

    public function test_project_card_shows_live_and_github_actions_when_links_exist(): void
    {
        $this->fakeGithubApi();
        $category = Category::create(['name' => 'Web Development', 'slug' => 'web-development']);
        Project::create([
            'category_id' => $category->id,
            'title' => 'Linked project',
            'description' => 'A project with external links.',
            'tech_stack' => 'Laravel',
            'demo_url' => 'https://demo.example.com',
            'github_url' => 'https://github.com/Nazwarrrr/linked-project',
        ]);

        $response = $this->get(route('home'));

        $response->assertOk()
            ->assertSee('href="https://demo.example.com"', false)
            ->assertSee('aria-label="Buka Live Demo Linked project"', false)
            ->assertSee('Demo ↗')
            ->assertSee('href="https://github.com/Nazwarrrr/linked-project"', false)
            ->assertSee('aria-label="Buka GitHub Linked project"', false)
            ->assertSee('Kode ↗');
    }

    public function test_contact_form_stores_a_valid_message(): void
    {
        $this->fakeGithubApi();
        $message = [
            'sender_name' => 'Ada Lovelace',
            'sender_email' => 'ada@example.com',
            'message' => 'I would like to discuss a project.',
        ];

        $response = $this->from(route('home'))
            ->post(route('contact.store'), $message);

        $response->assertRedirect(route('home'))
            ->assertSessionHas('success');
        $this->assertDatabaseHas('messages', $message);
    }

    public function test_contact_form_rejects_an_invalid_email_without_storing_a_message(): void
    {
        $this->fakeGithubApi();

        $response = $this->from(route('home'))->post(route('contact.store'), [
            'sender_name' => 'Ada Lovelace',
            'sender_email' => 'not-an-email',
            'message' => 'Please contact me.',
        ]);

        $response->assertSessionHasErrors(['sender_email']);
        $this->assertDatabaseCount('messages', 0);
    }

    public function test_homepage_still_renders_when_github_is_unavailable(): void
    {
        Http::preventStrayRequests();
        Http::fake([
            'api.github.com/users/Nazwarrrr' => Http::response([], 503),
            'api.github.com/users/Nazwarrrr/repos*' => Http::response([], 503),
        ]);

        $response = $this->get(route('home'));

        $response->assertOk()
            ->assertSee('Aktivitas GitHub belum dapat dimuat.');
    }

    public function test_project_creation_rejects_non_http_urls(): void
    {
        $admin = User::factory()->create();
        $category = Category::create(['name' => 'Web Development', 'slug' => 'web-development']);

        $response = $this->actingAs($admin)->post(route('admin.projects.store'), [
            'title' => 'Unsafe project',
            'category_id' => $category->id,
            'description' => 'A test project',
            'tech_stack' => 'Laravel',
            'demo_url' => 'javascript:alert(1)',
        ]);

        $response->assertSessionHasErrors(['demo_url']);
        $this->assertDatabaseCount('projects', 0);
    }

    public function test_database_seeder_can_run_more_than_once(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseCount('categories', 3);
        $this->assertDatabaseCount('projects', 3);
    }

    public function test_project_detail_page_renders_successfully(): void
    {
        $category = Category::create(['name' => 'Web Development', 'slug' => 'web-development']);
        $project = Project::create([
            'category_id' => $category->id,
            'title' => 'EduCore Platform',
            'description' => 'Comprehensive school management system.',
            'tech_stack' => 'Laravel, MySQL',
            'demo_url' => 'https://educore.example.com',
        ]);

        $response = $this->get(route('projects.show', $project));

        $response->assertOk()
            ->assertSee('EduCore Platform')
            ->assertSee('Web Development')
            ->assertSee('https://educore.example.com');
    }

    public function test_admin_can_create_and_delete_category(): void
    {
        $admin = User::factory()->create();

        $createResponse = $this->actingAs($admin)->post(route('admin.categories.store'), [
            'name' => 'Machine Learning',
        ]);

        $createResponse->assertRedirect(route('admin.projects.index'))
            ->assertSessionHas('success');
        $this->assertDatabaseHas('categories', ['name' => 'Machine Learning', 'slug' => 'machine-learning']);

        $category = Category::where('slug', 'machine-learning')->first();
        $deleteResponse = $this->actingAs($admin)->delete(route('admin.categories.destroy', $category));

        $deleteResponse->assertRedirect(route('admin.projects.index'))
            ->assertSessionHas('success');
        $this->assertDatabaseMissing('categories', ['name' => 'Machine Learning']);
    }

    public function test_admin_cannot_delete_category_with_projects(): void
    {
        $admin = User::factory()->create();
        $category = Category::create(['name' => 'Robotics', 'slug' => 'robotics']);
        Project::create([
            'category_id' => $category->id,
            'title' => 'RoboArm',
            'description' => 'Robotic arm controller.',
            'tech_stack' => 'ESP32, C++',
        ]);

        $response = $this->actingAs($admin)->delete(route('admin.categories.destroy', $category));

        $response->assertRedirect(route('admin.projects.index'))
            ->assertSessionHas('error');
        $this->assertDatabaseHas('categories', ['id' => $category->id]);
    }

    public function test_login_is_rate_limited_after_five_attempts(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post(route('login.post'), [
                'email' => 'attacker@example.com',
                'password' => 'wrong-password',
            ])->assertSessionHasErrors('email');
        }

        $this->post(route('login.post'), [
            'email' => 'attacker@example.com',
            'password' => 'wrong-password',
        ])->assertStatus(429);
    }

    public function test_contact_honeypot_silently_drops_spam(): void
    {
        $response = $this->from(route('home'))->post(route('contact.store'), [
            'sender_name' => 'Bot',
            'sender_email' => 'bot@example.com',
            'message' => 'Buy crypto now!',
            'website' => 'https://spam.example.com',
        ]);

        $response->assertRedirect(route('home'))
            ->assertSessionHas('success');
        $this->assertDatabaseCount('messages', 0);
    }

    public function test_security_headers_are_present(): void
    {
        $this->fakeGithubApi();

        $response = $this->get(route('home'));

        $response->assertHeader('X-Content-Type-Options', 'nosniff')
            ->assertHeader('X-Frame-Options', 'DENY')
            ->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');

        $loginResponse = $this->get(route('login'));
        $this->assertStringContainsString('no-store', (string) $loginResponse->headers->get('Cache-Control'));
    }

    public function test_public_api_projects_returns_json(): void
    {
        $category = Category::create(['name' => 'Web Development', 'slug' => 'web-development']);
        Project::create([
            'category_id' => $category->id,
            'title' => 'API Project',
            'description' => 'Exposed via API',
            'tech_stack' => 'Laravel',
        ]);

        $response = $this->getJson(route('api.projects'));

        $response->assertOk()
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('total', 1)
            ->assertJsonPath('data.0.title', 'API Project')
            ->assertJsonPath('data.0.category', 'Web Development');
    }

    public function test_project_detail_and_admin_dashboard_use_alpine_toggle_theme(): void
    {
        $admin = User::factory()->create();
        $category = Category::create(['name' => 'Web Development', 'slug' => 'web-development']);
        $project = Project::create([
            'category_id' => $category->id,
            'title' => 'Theme Test',
            'description' => 'Testing theme button',
            'tech_stack' => 'Laravel',
        ]);

        $this->get(route('projects.show', $project))
            ->assertOk()
            ->assertSee('@click="toggleTheme()"', false)
            ->assertDontSee('toggleAppTheme');

        $this->actingAs($admin)->get(route('admin.projects.index'))
            ->assertOk()
            ->assertSee('@click="toggleTheme()"', false)
            ->assertDontSee('toggleAppTheme');
    }

    /**
     * @param  array<string, mixed>|null  $profile
     * @param  array<int, array<string, mixed>>  $repositories
     */
    private function fakeGithubApi(?array $profile = null, array $repositories = []): void
    {
        Http::preventStrayRequests();
        Http::fake([
            'api.github.com/users/Nazwarrrr' => Http::response($profile ?? [
                'avatar_url' => 'https://avatars.githubusercontent.com/u/583231',
                'name' => 'Nazwar',
                'login' => 'Nazwarrrr',
                'bio' => 'Full-Stack Web & IoT Developer',
                'public_repos' => 8,
                'followers' => 100,
            ]),
            'api.github.com/users/Nazwarrrr/repos*' => Http::response($repositories),
        ]);
    }
}
