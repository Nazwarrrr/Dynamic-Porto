<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Message;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

        $githubUsername = config('services.github.username', 'octocat');
        $githubProfile = null;
        $githubRepos = [];

        try {
            $profileResponse = Http::connectTimeout(3)
                ->timeout(5)
                ->get("https://api.github.com/users/{$githubUsername}");
            $reposResponse = Http::connectTimeout(3)
                ->timeout(5)
                ->get("https://api.github.com/users/{$githubUsername}/repos", [
                    'sort' => 'updated',
                    'per_page' => 4,
                ]);

            if ($profileResponse->successful() && is_array($profileResponse->json())) {
                $githubProfile = $profileResponse->json();
            }
            if ($reposResponse->successful() && is_array($reposResponse->json())) {
                $githubRepos = $reposResponse->json();
            }
            if (! $profileResponse->successful() || ! $reposResponse->successful()) {
                Log::warning('GitHub API returned an unsuccessful response.', [
                    'username' => $githubUsername,
                    'profile_status' => $profileResponse->status(),
                    'repositories_status' => $reposResponse->status(),
                ]);
            }
        } catch (ConnectionException $exception) {
            Log::warning('Unable to connect to the GitHub API.', [
                'username' => $githubUsername,
                'exception' => $exception->getMessage(),
            ]);
        }

        return view('welcome', compact('categories', 'projects', 'githubProfile', 'githubRepos', 'githubUsername'));
    }

    public function storeMessage(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'sender_name' => 'required|string|max:100',
            'sender_email' => 'required|email|max:100',
            'message' => 'required|string|max:1000',
        ]);

        Message::create($validated);

        return back()->with('success', 'Pesan berhasil terkirim ke database!');
    }
}
