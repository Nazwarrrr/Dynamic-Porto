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
                'html_url' => 'https://github.com/octocat/example',
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
            ->assertSee('Example repository')
            ->assertSee('example');
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
            'api.github.com/users/octocat' => Http::response([], 503),
            'api.github.com/users/octocat/repos*' => Http::response([], 503),
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

    /**
     * @param  array<string, mixed>|null  $profile
     * @param  array<int, array<string, mixed>>  $repositories
     */
    private function fakeGithubApi(?array $profile = null, array $repositories = []): void
    {
        Http::preventStrayRequests();
        Http::fake([
            'api.github.com/users/octocat' => Http::response($profile ?? [
                'avatar_url' => 'https://avatars.githubusercontent.com/u/583231',
                'name' => 'The Octocat',
                'login' => 'octocat',
                'bio' => 'GitHub mascot',
                'public_repos' => 8,
                'followers' => 100,
            ]),
            'api.github.com/users/octocat/repos*' => Http::response($repositories),
        ]);
    }
}
