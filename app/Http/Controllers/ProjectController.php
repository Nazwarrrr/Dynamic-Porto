<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Message;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::with('category')->latest()->get();
        $categories = Category::all();
        $messages = Message::latest()->get();

        return view('admin.dashboard', compact('projects', 'categories', 'messages'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string|max:5000',
            'tech_stack' => 'required|string|max:200',
            'demo_url' => 'nullable|url:http,https|max:255',
            'github_url' => 'nullable|url:http,https|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil ditambahkan!');
    }

    public function edit(Project $project): View
    {
        $categories = Category::all();

        return view('admin.edit', compact('project', 'categories'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string|max:5000',
            'tech_stack' => 'required|string|max:200',
            'demo_url' => 'nullable|url:http,https|max:255',
            'github_url' => 'nullable|url:http,https|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $previousImage = $project->image;
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($validated);

        if (isset($validated['image']) && $previousImage) {
            Storage::disk('public')->delete($previousImage);
        }

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil diperbarui!');
    }

    public function destroy(Project $project): RedirectResponse
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil dihapus!');
    }

    public function destroyMessage(Message $message): RedirectResponse
    {
        $message->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Pesan berhasil dihapus!');
    }
}
