@extends('layouts.app')

@section('title', 'Panel Admin — Nazwar Makarim')

@section('content')

<header class="sticky top-0 z-40 border-b border-line bg-bg/90 backdrop-blur-md">
    <nav class="mx-auto flex h-16 max-w-6xl items-center justify-between px-5">
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" class="font-display text-lg font-semibold tracking-tight">Nazwar Makarim</a>
            <span class="text-sm text-muted">/ Admin</span>
        </div>

        <div class="flex items-center gap-5 text-sm sm:gap-7">
            <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer" class="ulink text-muted hover:text-ink">Lihat web ↗</a>
            <button type="button" onclick="toggleAppTheme()" aria-label="Ganti tema" class="grid size-11 place-items-center rounded-full text-muted hover:text-ink">
                <svg class="hidden size-5 dark:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
                <svg class="size-5 dark:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/></svg>
            </button>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="ulink py-2 font-medium text-red-700 dark:text-red-300">Keluar</button>
            </form>
        </div>
    </nav>
</header>

<main class="mx-auto w-full max-w-6xl flex-1 space-y-12 px-5 py-12">

    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="text-sm font-medium text-accent">Panel Admin</p>
            <h1 class="mt-1 font-display text-3xl font-semibold tracking-tight sm:text-4xl">Kelola Portofolio</h1>
        </div>
        <a href="{{ route('api.projects') }}" target="_blank" rel="noopener noreferrer" class="ulink font-mono text-sm text-muted hover:text-ink">GET /api/projects ↗</a>
    </div>

    @if(session('success'))
        <div role="status" class="flex items-center justify-between gap-4 rounded-sm border border-line bg-surface px-5 py-3.5 text-sm">
            <span>{{ session('success') }}</span>
            <button type="button" onclick="this.parentElement.remove()" class="ulink text-xs text-muted hover:text-ink">Tutup</button>
        </div>
    @endif

    @if(session('error'))
        <div role="alert" class="flex items-center justify-between gap-4 rounded-sm border border-red-500/30 bg-red-500/10 px-5 py-3.5 text-sm text-red-700 dark:text-red-300">
            <span>{{ session('error') }}</span>
            <button type="button" onclick="this.parentElement.remove()" class="ulink text-xs">Tutup</button>
        </div>
    @endif

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

    <!-- Ringkasan Statistik -->
    <dl class="grid divide-y divide-line border-y border-line sm:grid-cols-3 sm:divide-x sm:divide-y-0">
        <div class="py-6 sm:pr-6">
            <dt class="text-sm text-muted">Total Proyek</dt>
            <dd class="mt-2 font-display text-4xl font-semibold tabular-nums text-accent">{{ $projects->count() }}</dd>
        </div>
        <div class="py-6 sm:px-6">
            <dt class="text-sm text-muted">Kategori Aktif</dt>
            <dd class="mt-2 font-display text-4xl font-semibold tabular-nums text-ink">{{ $categories->count() }}</dd>
        </div>
        <div class="py-6 sm:pl-6">
            <dt class="text-sm text-muted">Pesan Masuk</dt>
            <dd class="mt-2 font-display text-4xl font-semibold tabular-nums text-ink">{{ $messages->total() }}</dd>
        </div>
    </dl>

    <!-- Tab Navigasi -->
    <div class="flex flex-wrap gap-6 border-b border-line text-sm" id="admin-tabs">
        <button type="button" data-tab="tab-projects" class="tab-btn -mb-px border-b-2 border-accent pb-3 font-medium text-ink">
            Proyek ({{ $projects->count() }})
        </button>
        <button type="button" data-tab="tab-categories" class="tab-btn -mb-px border-b-2 border-transparent pb-3 text-muted hover:text-ink">
            Kategori ({{ $categories->count() }})
        </button>
        <button type="button" data-tab="tab-messages" class="tab-btn -mb-px border-b-2 border-transparent pb-3 text-muted hover:text-ink">
            Pesan Masuk ({{ $messages->total() }})
        </button>
    </div>

    <!-- ================= TAB 1: KELOLA PROYEK ================= -->
    <div id="tab-projects" class="tab-content space-y-12">
        <section class="rounded-sm border border-line bg-surface p-6 sm:p-8 space-y-6">
            <div class="flex items-center justify-between border-b border-line pb-4">
                <h2 class="font-display text-xl font-semibold">Tambah Proyek Baru</h2>
                <span class="text-xs text-muted">* Wajib diisi</span>
            </div>

            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="grid gap-5 md:grid-cols-2">
                @csrf
                <div>
                    <label class="block text-sm text-muted">Judul Proyek *</label>
                    <input type="text" name="title" value="{{ old('title') }}" maxlength="150" required placeholder="Contoh: WALL-Z — Assistive Smart Vest" class="input-box">
                </div>

                <div>
                    <label class="block text-sm text-muted">Kategori *</label>
                    <select name="category_id" required class="input-box">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm text-muted">Tech Stack (pisahkan dengan koma) *</label>
                    <input type="text" name="tech_stack" value="{{ old('tech_stack') }}" maxlength="200" required placeholder="Laravel, React, MySQL" class="input-box">
                </div>

                <div>
                    <label class="block text-sm text-muted">Foto Thumbnail (Opsional, maks. 2MB)</label>
                    <input type="file" name="image" id="project-image-input" accept="image/*" class="input-box text-sm file:mr-3 file:rounded-sm file:border-0 file:bg-ink file:px-3 file:py-1.5 file:text-xs file:font-medium file:text-bg">
                    <div id="image-preview-wrapper" class="mt-3 hidden">
                        <img id="image-preview" src="#" alt="Pratinjau Gambar" class="h-28 rounded-sm border border-line object-cover">
                    </div>
                </div>

                <div>
                    <label class="block text-sm text-muted">Link Live Demo (Opsional)</label>
                    <input type="url" name="demo_url" value="{{ old('demo_url') }}" maxlength="255" placeholder="https://..." class="input-box">
                </div>

                <div>
                    <label class="block text-sm text-muted">Link GitHub Repo (Opsional)</label>
                    <input type="url" name="github_url" value="{{ old('github_url') }}" maxlength="255" placeholder="https://github.com/..." class="input-box">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm text-muted">Deskripsi &amp; Studi Kasus *</label>
                    <textarea name="description" rows="4" maxlength="5000" required placeholder="Jelaskan latar belakang masalah, solusi teknis, dan hasil yang dicapai..." class="input-box resize-y">{{ old('description') }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <button type="submit" class="btn">Simpan Proyek</button>
                </div>
            </form>
        </section>

        <section class="space-y-4">
            <h3 class="font-display text-xl font-semibold">Daftar Proyek Tersimpan</h3>

            <div class="overflow-x-auto rounded-sm border border-line bg-surface">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-line text-xs text-muted">
                        <tr>
                            <th class="px-5 py-3.5 font-medium">Judul Proyek</th>
                            <th class="px-5 py-3.5 font-medium">Kategori</th>
                            <th class="px-5 py-3.5 font-medium">Tech Stack</th>
                            <th class="px-5 py-3.5 text-right font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @forelse($projects as $project)
                            <tr>
                                <td class="px-5 py-4 font-medium text-ink">
                                    <a href="{{ route('projects.show', $project) }}" target="_blank" class="ulink">
                                        {{ $project->title }}
                                    </a>
                                </td>
                                <td class="px-5 py-4 text-muted">{{ $project->category->name }}</td>
                                <td class="max-w-xs truncate px-5 py-4 font-mono text-xs text-muted">{{ $project->tech_stack }}</td>
                                <td class="space-x-4 whitespace-nowrap px-5 py-4 text-right">
                                    <a href="{{ route('projects.show', $project) }}" target="_blank" class="ulink text-muted hover:text-ink">Lihat</a>
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="ulink font-medium text-accent">Edit</a>
                                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus proyek ini secara permanen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ulink text-red-700 dark:text-red-300">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-10 text-center text-muted">
                                    Belum ada proyek. Tambahkan melalui formulir di atas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <!-- ================= TAB 2: KELOLA KATEGORI ================= -->
    <div id="tab-categories" class="tab-content hidden">
        <div class="grid gap-8 md:grid-cols-12">
            <div class="rounded-sm border border-line bg-surface p-6 space-y-5 md:col-span-5 self-start">
                <h3 class="font-display text-xl font-semibold">Tambah Kategori</h3>
                <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm text-muted">Nama Kategori *</label>
                        <input type="text" name="name" required maxlength="100" placeholder="Misal: Mobile App" class="input-box">
                    </div>
                    <button type="submit" class="btn w-full justify-center">Tambah Kategori</button>
                </form>
            </div>

            <div class="rounded-sm border border-line bg-surface p-6 space-y-4 md:col-span-7">
                <h3 class="font-display text-xl font-semibold">Kategori Tersedia</h3>
                <div class="divide-y divide-line">
                    @foreach($categories as $category)
                        <div class="flex items-center justify-between gap-4 py-3.5">
                            <div>
                                <p class="font-medium text-ink">{{ $category->name }}</p>
                                <p class="font-mono text-xs text-muted">{{ $category->slug }} · {{ $category->projects_count ?? $category->projects->count() }} proyek</p>
                            </div>
                            <div>
                                @if(($category->projects_count ?? $category->projects->count()) == 0)
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ulink text-sm text-red-700 dark:text-red-300">Hapus</button>
                                    </form>
                                @else
                                    <span class="text-xs text-muted">Dipakai proyek</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- ================= TAB 3: PESAN MASUK ================= -->
    <div id="tab-messages" class="tab-content hidden space-y-6">
        <div class="divide-y divide-line rounded-sm border border-line bg-surface">
            @forelse($messages as $msg)
                <div class="flex flex-col justify-between gap-4 p-6 sm:flex-row sm:items-start">
                    <div class="flex-1 space-y-1.5">
                        <div class="flex flex-wrap items-baseline gap-x-3 gap-y-1">
                            <span class="font-medium text-ink">{{ $msg->sender_name }}</span>
                            <span class="font-mono text-xs text-muted">{{ $msg->sender_email }}</span>
                            <span class="text-xs text-accent">· {{ $msg->created_at ? $msg->created_at->diffForHumans() : 'Baru saja' }}</span>
                        </div>
                        <p class="whitespace-pre-line text-sm leading-relaxed text-muted">{{ $msg->message }}</p>
                    </div>

                    <div class="flex shrink-0 items-center gap-5 text-sm">
                        <a href="mailto:{{ $msg->sender_email }}?subject=Balasan%20Pesan%20dari%20Nazwar%20Makarim%20Mahardhika" class="ulink font-medium text-accent">Balas email</a>
                        <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ulink text-red-700 dark:text-red-300">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="p-10 text-center text-sm text-muted">
                    Belum ada pesan masuk dari formulir kontak.
                </div>
            @endforelse
        </div>

        @if($messages->hasPages())
            <div>{{ $messages->links() }}</div>
        @endif
    </div>

</main>

<footer class="border-t border-line">
    <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-3 px-5 py-8 text-sm text-muted">
        <p>© {{ date('Y') }} Nazwar Makarim Mahardhika</p>
        <a href="{{ route('home') }}" class="ulink">Halaman utama</a>
    </div>
</footer>

@endsection

@push('scripts')
<script>
    const tabButtons = document.querySelectorAll('#admin-tabs .tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetTab = btn.getAttribute('data-tab');

            tabButtons.forEach(b => {
                b.className = 'tab-btn -mb-px border-b-2 border-transparent pb-3 text-muted hover:text-ink';
            });
            btn.className = 'tab-btn -mb-px border-b-2 border-accent pb-3 font-medium text-ink';

            tabContents.forEach(content => {
                content.classList.toggle('hidden', content.id !== targetTab);
            });
        });
    });

    const imageInput = document.getElementById('project-image-input');
    const previewWrapper = document.getElementById('image-preview-wrapper');
    const imagePreview = document.getElementById('image-preview');

    if (imageInput && imagePreview && previewWrapper) {
        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    previewWrapper.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                previewWrapper.classList.add('hidden');
            }
        });
    }
</script>
@endpush
