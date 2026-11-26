@extends('layouts.app')

@section('title', 'Edit Proyek — ' . $project->title . ' | Admin')

@section('content')

<header class="border-b border-line bg-bg">
    <nav class="mx-auto flex h-16 max-w-6xl items-center justify-between px-5">
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" class="font-display text-lg font-semibold tracking-tight">Nazwar Makarim</a>
            <span class="text-sm text-muted">/ Edit Proyek</span>
        </div>

        <div class="flex items-center gap-6 text-sm">
            <a href="{{ route('admin.projects.index') }}" class="ulink text-muted hover:text-ink">← Kembali ke panel</a>
            <button type="button" onclick="toggleAppTheme()" aria-label="Ganti tema" class="-mr-3 grid size-11 place-items-center rounded-full text-muted hover:text-ink">
                <svg class="hidden size-5 dark:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
                <svg class="size-5 dark:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/></svg>
            </button>
        </div>
    </nav>
</header>

<main class="mx-auto w-full max-w-3xl flex-1 px-5 py-12">
    <div class="space-y-8 rounded-sm border border-line bg-surface p-6 sm:p-10">
        <div class="border-b border-line pb-5">
            <p class="text-sm font-medium text-accent">Edit Proyek</p>
            <h1 class="mt-1 font-display text-2xl font-semibold tracking-tight sm:text-3xl">{{ $project->title }}</h1>
        </div>

        @if($errors->any())
            <div role="alert" class="rounded-sm border border-red-500/30 bg-red-500/10 p-4 text-sm text-red-700 dark:text-red-300 space-y-1">
                <p class="font-medium">Terjadi kesalahan validasi:</p>
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="grid gap-5 md:grid-cols-2">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm text-muted">Judul Proyek *</label>
                <input type="text" name="title" value="{{ old('title', $project->title) }}" maxlength="150" required class="input-box">
            </div>

            <div>
                <label class="block text-sm text-muted">Kategori *</label>
                <select name="category_id" required class="input-box">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $project->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm text-muted">Tech Stack (pisahkan dengan koma) *</label>
                <input type="text" name="tech_stack" value="{{ old('tech_stack', $project->tech_stack) }}" maxlength="200" required class="input-box">
            </div>

            <div>
                <label class="block text-sm text-muted">Ganti Thumbnail (Opsional, maks. 2MB)</label>
                <input type="file" name="image" id="edit-image-input" accept="image/*" class="input-box text-sm file:mr-3 file:rounded-sm file:border-0 file:bg-ink file:px-3 file:py-1.5 file:text-xs file:font-medium file:text-bg">

                <div class="mt-3 flex items-center gap-4">
                    @if($project->image)
                        <div id="current-image-preview">
                            <span class="mb-1 block text-xs text-muted">Saat ini:</span>
                            <img src="{{ asset('storage/' . $project->image) }}" alt="Current Image" onerror="this.style.display='none'" class="h-16 rounded-sm border border-line object-cover">
                        </div>
                    @endif
                    <div id="new-image-preview-wrapper" class="hidden">
                        <span class="mb-1 block text-xs text-accent">Foto baru:</span>
                        <img id="new-image-preview" src="#" alt="New Image" class="h-16 rounded-sm border border-accent object-cover">
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm text-muted">Link Live Demo</label>
                <input type="url" name="demo_url" value="{{ old('demo_url', $project->demo_url) }}" maxlength="255" placeholder="https://..." class="input-box">
            </div>

            <div>
                <label class="block text-sm text-muted">Link GitHub Repo</label>
                <input type="url" name="github_url" value="{{ old('github_url', $project->github_url) }}" maxlength="255" placeholder="https://github.com/..." class="input-box">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm text-muted">Deskripsi Lengkap *</label>
                <textarea name="description" rows="5" maxlength="5000" required class="input-box resize-y">{{ old('description', $project->description) }}</textarea>
            </div>

            <div class="flex items-center justify-end gap-6 pt-3 md:col-span-2">
                <a href="{{ route('admin.projects.index') }}" class="ulink text-sm text-muted hover:text-ink">Batal</a>
                <button type="submit" class="btn">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</main>

@endsection

@push('scripts')
<script>
    const editImageInput = document.getElementById('edit-image-input');
    const newImageWrapper = document.getElementById('new-image-preview-wrapper');
    const newImagePreview = document.getElementById('new-image-preview');

    if (editImageInput && newImageWrapper && newImagePreview) {
        editImageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    newImagePreview.src = e.target.result;
                    newImageWrapper.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                newImageWrapper.classList.add('hidden');
            }
        });
    }
</script>
@endpush
