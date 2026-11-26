<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Message;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PortfolioController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::all();

        $projects = Project::with('category')
            ->when($request->category, function ($query, $slug) {
                $query->whereHas('category', function ($q) use ($slug) {
                    $q->where('slug', $slug);
                });
            })
            ->latest()
            ->get();

        $githubUsername = config('services.github.username', 'Nazwarrrr');
        $cacheKey = 'github_portfolio_'.$githubUsername;

        $githubData = Cache::get($cacheKey);
        if (! is_array($githubData)) {
            $githubData = $this->fetchGithub($githubUsername);
            $ttl = $githubData['profile'] ? now()->addMinutes(30) : now()->addMinutes(3);
            Cache::put($cacheKey, $githubData, $ttl);
        }

        $githubProfile = $githubData['profile'] ?? null;
        $githubRepos = $githubData['repos'] ?? [];

        return view('welcome', compact('categories', 'projects', 'githubProfile', 'githubRepos', 'githubUsername'));
    }

    public function show(Project $project): View
    {
        $project->load('category');

        return view('projects.show', compact('project'));
    }

    public function storeMessage(Request $request): RedirectResponse
    {
        if ($request->filled('website')) {
            return back()->with('success', 'Terima kasih, pesan Anda sudah masuk. Saya akan membalas lewat email.');
        }

        $validated = $request->validate([
            'sender_name' => 'required|string|max:100',
            'sender_email' => 'required|email|max:100',
            'message' => 'required|string|max:1000',
        ]);

        Message::create($validated);

        return back()->with('success', 'Terima kasih, pesan Anda sudah masuk. Saya akan membalas lewat email.');
    }

    public function api(): JsonResponse
    {
        $projects = Project::with('category:id,name,slug')
            ->latest()
            ->get()
            ->map(fn (Project $project) => [
                'id' => $project->id,
                'title' => $project->title,
                'description' => $project->description,
                'tech_stack' => $project->tech_stack,
                'demo_url' => $project->demo_url,
                'github_url' => $project->github_url,
                'category' => $project->category?->name,
                'created_at' => $project->created_at?->toISOString(),
            ]);

        return response()->json([
            'status' => 'success',
            'total' => $projects->count(),
            'data' => $projects,
        ]);
    }

    /**
     * @return array{profile: array<string, mixed>|null, repos: array<int, array<string, mixed>>}
     */
    private function fetchGithub(string $username): array
    {
        $profile = null;
        $repos = [];

        try {
            $token = config('services.github.token');
            $http = Http::connectTimeout(2)->timeout(3);
            if (is_string($token) && $token !== '') {
                $http = $http->withToken($token);
            }

            $profileResponse = $http->get("https://api.github.com/users/{$username}");
            $reposResponse = $http->get("https://api.github.com/users/{$username}/repos", [
                'sort' => 'updated',
                'per_page' => 4,
            ]);

            if ($profileResponse->successful() && is_array($profileResponse->json())) {
                $profile = $profileResponse->json();
            }
            if ($reposResponse->successful() && is_array($reposResponse->json())) {
                $repos = $reposResponse->json();
            }
            if (! $profileResponse->successful() || ! $reposResponse->successful()) {
                Log::warning('GitHub API returned an unsuccessful response.', [
                    'username' => $username,
                    'profile_status' => $profileResponse->status(),
                    'repositories_status' => $reposResponse->status(),
                ]);
            }
        } catch (ConnectionException $exception) {
            Log::warning('Unable to connect to the GitHub API.', [
                'username' => $username,
                'exception' => $exception->getMessage(),
            ]);
        }

        return [
            'profile' => $profile,
            'repos' => $repos,
        ];
    }
}
