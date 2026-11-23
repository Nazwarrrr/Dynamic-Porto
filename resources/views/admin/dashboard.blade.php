@extends('layouts.app')

@section('title', 'Admin Dashboard — Nazwar Makarim M.')

@section('content')

    <!-- Top Admin Header Bar -->
    <header class="border-b border-white/10 bg-slate-900/80 backdrop-blur-md sticky top-0 z-40">
        <div class="max-w-6xl mx-auto px-4 py-3.5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="font-mono font-bold text-teal-600 dark:text-cyanGlow text-base">NMM.admin</span>
                <span class="text-xs font-mono px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-600 dark:text-emerald-300 border border-emerald-500/20">
                    Control Panel
                </span>
            </div>
            <div class="flex items-center gap-3">
                <button type="button" onclick="toggleAppTheme()" aria-label="Ganti Tema" class="p-1.5 rounded-lg glass text-slate-300 hover:text-cyanGlow transition">
                    <i data-lucide="sun" class="w-4 h-4 hidden dark:block text-cyanGlow"></i>
                    <i data-lucide="moon" class="w-4 h-4 block dark:hidden text-slate-700"></i>
                </button>
                <a href="{{ route('home') }}" target="_blank" class="text-xs font-mono text-slate-300 hover:text-cyanGlow flex items-center gap-1">
                    <i data-lucide="globe" class="w-3.5 h-3.5"></i>
                    <span>Lihat Web</span>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-rose-500/15 text-rose-300 border border-rose-500/30 text-xs font-mono hover:bg-rose-500/25 transition flex items-center gap-1.5">
                        <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-8 space-y-8">

        <!-- Flash Alerts -->
        @if(session('success'))
            <div class="glass border-emerald-500/40 text-emerald-700 dark:text-emerald-300 px-5 py-3.5 rounded-2xl text-sm flex items-center justify-between shadow-lg">
                <div class="flex items-center gap-2.5">
                    <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500 shrink-0"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-xs font-mono text-emerald-600 hover:underline">Tutup</button>
            </div>
        @endif

        @if(session('error'))
            <div class="glass border-rose-500/40 text-rose-300 px-5 py-3.5 rounded-2xl text-sm flex items-center justify-between shadow-lg">
                <div class="flex items-center gap-2.5">
                    <i data-lucide="alert-triangle" class="w-5 h-5 text-rose-500 shrink-0"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-xs font-mono text-rose-400 hover:underline">Tutup</button>
            </div>
        @endif

        @if($errors->any())
            <div class="glass border-rose-500/40 text-rose-300 p-4 rounded-2xl text-xs font-mono space-y-1">
                <p class="font-bold">Terjadi kesalahan validasi:</p>
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- 3 Summary Metrics Cards -->
        <section class="grid sm:grid-cols-3 gap-4">
            <div class="glass-card rounded-2xl p-5 flex items-center justify-between">
                <div>
                    <span class="text-xs font-mono text-slate-400 uppercase tracking-wider">Total Proyek</span>
                    <p class="text-3xl font-extrabold text-teal-600 dark:text-cyanGlow mt-1">{{ $projects->count() }}</p>
                    <span class="text-[11px] font-mono text-slate-500">Tersedia di web & API</span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-teal-500/10 text-teal-600 dark:text-cyanGlow flex items-center justify-center">
                    <i data-lucide="folder-git-2" class="w-6 h-6"></i>
                </div>
            </div>

            <div class="glass-card rounded-2xl p-5 flex items-center justify-between">
                <div>
                    <span class="text-xs font-mono text-slate-400 uppercase tracking-wider">Kategori Aktif</span>
                    <p class="text-3xl font-extrabold text-teal-600 dark:text-cyanGlow mt-1">{{ $categories->count() }}</p>
                    <span class="text-[11px] font-mono text-slate-500">Klasifikasi portofolio</span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-500 flex items-center justify-center">
                    <i data-lucide="tags" class="w-6 h-6"></i>
                </div>
            </div>

            <div class="glass-card rounded-2xl p-5 flex items-center justify-between">
                <div>
                    <span class="text-xs font-mono text-slate-400 uppercase tracking-wider">Pesan Masuk</span>
                    <p class="text-3xl font-extrabold text-teal-600 dark:text-cyanGlow mt-1">{{ $messages->count() }}</p>
                    <span class="text-[11px] font-mono text-slate-500">Dari formulir kontak</span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center">
                    <i data-lucide="inbox" class="w-6 h-6"></i>
                </div>
            </div>
        </section>

        <!-- Interactive Tabs Control -->
        <div class="flex flex-wrap gap-2 border-b border-slate-200/50 dark:border-white/10 pb-3" id="admin-tabs">
            <button type="button" data-tab="tab-projects" class="tab-btn px-4 py-2 rounded-xl font-mono text-xs font-semibold bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy transition flex items-center gap-1.5 shadow-sm">
                <i data-lucide="folder-git-2" class="w-4 h-4"></i>
                <span>Kelola Proyek ({{ $projects->count() }})</span>
            </button>
            <button type="button" data-tab="tab-categories" class="tab-btn px-4 py-2 rounded-xl font-mono text-xs transition glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50 flex items-center gap-1.5">
                <i data-lucide="tag" class="w-4 h-4"></i>
                <span>Kelola Kategori ({{ $categories->count() }})</span>
            </button>
            <button type="button" data-tab="tab-messages" class="tab-btn px-4 py-2 rounded-xl font-mono text-xs transition glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50 flex items-center gap-1.5">
                <i data-lucide="mail" class="w-4 h-4"></i>
                <span>Pesan Masuk ({{ $messages->count() }})</span>
            </button>
        </div>

        <!-- ================= TAB 1: KELOLA PROYEK ================= -->
        <div id="tab-projects" class="tab-content space-y-8">
            <!-- Form Tambah Proyek Baru -->
            <section class="glass rounded-2xl p-6 sm:p-8 space-y-6">
                <div class="flex items-center justify-between pb-3 border-b border-slate-200/60 dark:border-white/10">
                    <h2 class="text-lg font-bold flex items-center gap-2">
                        <i data-lucide="plus-circle" class="w-5 h-5 text-teal-600 dark:text-cyanGlow"></i>
                        <span>Tambah Proyek Baru</span>
                    </h2>
                    <span class="text-xs font-mono text-slate-400">* Wajib diisi</span>
                </div>

                <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-5">
                    @csrf
                    <div>
                        <label class="block text-xs font-mono mb-1 font-medium">Judul Proyek *</label>
                        <input type="text" name="title" value="{{ old('title') }}" maxlength="150" required placeholder="Contoh: EduCore — Smart School Platform"
                            class="w-full px-3.5 py-2.5 rounded-xl bg-slate-100/70 dark:bg-slate-900/80 border border-slate-200 dark:border-white/10 text-sm focus:outline-none focus:border-cyanGlow">
                    </div>

                    <div>
                        <label class="block text-xs font-mono mb-1 font-medium">Kategori *</label>
                        <select name="category_id" required class="w-full px-3.5 py-2.5 rounded-xl bg-slate-100/70 dark:bg-slate-900/80 border border-slate-200 dark:border-white/10 text-sm focus:outline-none focus:border-cyanGlow">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-mono mb-1 font-medium">Tech Stack (pisahkan dengan koma) *</label>
                        <input type="text" name="tech_stack" value="{{ old('tech_stack') }}" maxlength="200" required placeholder="Laravel 12, React, Tailwind CSS, MySQL"
                            class="w-full px-3.5 py-2.5 rounded-xl bg-slate-100/70 dark:bg-slate-900/80 border border-slate-200 dark:border-white/10 text-sm focus:outline-none focus:border-cyanGlow">
                    </div>

                    <div>
                        <label class="block text-xs font-mono mb-1 font-medium">Foto Thumbnail Proyek (Opsional, Max 2MB)</label>
                        <input type="file" name="image" id="project-image-input" accept="image/*"
                            class="w-full px-3 py-2 rounded-xl bg-slate-100/70 dark:bg-slate-900/80 border border-slate-200 dark:border-white/10 text-xs">
                        <!-- Live Image Preview Container -->
                        <div id="image-preview-wrapper" class="hidden mt-3">
                            <span class="text-[11px] font-mono text-slate-400 block mb-1">Preview Thumbnail:</span>
                            <img id="image-preview" src="#" alt="Pratinjau Gambar" class="h-28 rounded-xl object-cover border border-teal-500/30">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-mono mb-1 font-medium">Link Live Demo (Opsional)</label>
                        <input type="url" name="demo_url" value="{{ old('demo_url') }}" maxlength="255" placeholder="https://proyek-anda.vercel.app"
                            class="w-full px-3.5 py-2.5 rounded-xl bg-slate-100/70 dark:bg-slate-900/80 border border-slate-200 dark:border-white/10 text-sm focus:outline-none focus:border-cyanGlow">
                    </div>

                    <div>
                        <label class="block text-xs font-mono mb-1 font-medium">Link GitHub Repo (Opsional)</label>
                        <input type="url" name="github_url" value="{{ old('github_url') }}" maxlength="255" placeholder="https://github.com/username/repository"
                            class="w-full px-3.5 py-2.5 rounded-xl bg-slate-100/70 dark:bg-slate-900/80 border border-slate-200 dark:border-white/10 text-sm focus:outline-none focus:border-cyanGlow">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-mono mb-1 font-medium">Deskripsi Lengkap & Studi Kasus *</label>
                        <textarea name="description" rows="3" maxlength="5000" required placeholder="Jelaskan fitur utama, masalah yang dipecahkan, serta teknologi yang diterapkan..."
                            class="w-full px-3.5 py-2.5 rounded-xl bg-slate-100/70 dark:bg-slate-900/80 border border-slate-200 dark:border-white/10 text-sm focus:outline-none focus:border-cyanGlow">{{ old('description') }}</textarea>
                    </div>

                    <div class="md:col-span-2">
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy font-bold text-sm hover:opacity-90 transition shadow-md flex items-center gap-2">
                            <i data-lucide="save" class="w-4 h-4"></i>
                            <span>Simpan Proyek</span>
                        </button>
                    </div>
                </form>
            </section>

            <!-- Tabel Daftar Proyek -->
            <section class="glass rounded-2xl p-6 space-y-4">
                <h3 class="text-base font-bold flex items-center gap-2">
                    <i data-lucide="list" class="w-4 h-4 text-teal-600 dark:text-cyanGlow"></i>
                    <span>Daftar Proyek Tersimpan ({{ $projects->count() }})</span>
                </h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="text-xs font-mono text-slate-400 border-b border-slate-200 dark:border-white/10">
                            <tr>
                                <th class="py-3 px-3">Judul Proyek</th>
                                <th class="py-3 px-3">Kategori</th>
                                <th class="py-3 px-3">Tech Stack</th>
                                <th class="py-3 px-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200/50 dark:divide-white/5">
                            @forelse($projects as $project)
                                <tr>
                                    <td class="py-3 px-3 font-semibold text-slate-800 dark:text-slate-100">
                                        <a href="{{ route('projects.show', $project) }}" target="_blank" class="hover:text-teal-600 dark:hover:text-cyanGlow hover:underline">
                                            {{ $project->title }}
                                        </a>
                                    </td>
                                    <td class="py-3 px-3 font-mono text-xs text-teal-600 dark:text-cyanGlow">
                                        {{ $project->category->name }}
                                    </td>
                                    <td class="py-3 px-3 font-mono text-xs text-slate-500 dark:text-slate-400 max-w-xs truncate">
                                        {{ $project->tech_stack }}
                                    </td>
                                    <td class="py-3 px-3 text-right space-x-2 whitespace-nowrap">
                                        <a href="{{ route('projects.show', $project) }}" target="_blank" class="inline-block px-2.5 py-1 rounded-lg bg-teal-500/10 text-teal-600 dark:text-cyanGlow border border-teal-500/20 text-xs font-mono hover:opacity-80">
                                            Lihat
                                        </a>
                                        <a href="{{ route('admin.projects.edit', $project) }}" class="inline-block px-2.5 py-1 rounded-lg bg-amber-500/15 text-amber-500 border border-amber-500/30 text-xs font-mono hover:opacity-80">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus proyek ini secara permanen?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2.5 py-1 rounded-lg bg-rose-500/15 text-rose-400 border border-rose-500/30 text-xs font-mono hover:opacity-80">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-8 text-center text-xs font-mono text-slate-500">
                                        Belum ada data proyek. Silakan tambahkan pada formulir di atas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

        <!-- ================= TAB 2: KELOLA KATEGORI ================= -->
        <div id="tab-categories" class="tab-content hidden space-y-6">
            <div class="grid md:grid-cols-12 gap-6">
                <!-- Form Tambah Kategori -->
                <div class="md:col-span-5 glass rounded-2xl p-6 space-y-4">
                    <h3 class="font-bold text-base flex items-center gap-2">
                        <i data-lucide="tag" class="w-4 h-4 text-teal-600 dark:text-cyanGlow"></i>
                        <span>Tambah Kategori Baru</span>
                    </h3>
                    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-mono mb-1 font-medium">Nama Kategori *</label>
                            <input type="text" name="name" required maxlength="100" placeholder="Misal: Mobile App atau AI Model"
                                class="w-full px-3.5 py-2.5 rounded-xl bg-slate-100/70 dark:bg-slate-900/80 border border-slate-200 dark:border-white/10 text-sm focus:outline-none focus:border-cyanGlow">
                        </div>
                        <button type="submit" class="w-full py-2.5 rounded-xl bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy font-bold text-xs font-mono hover:opacity-90 transition">
                            Tambah Kategori
                        </button>
                    </form>
                </div>

                <!-- List Kategori Tersedia -->
                <div class="md:col-span-7 glass rounded-2xl p-6 space-y-4">
                    <h3 class="font-bold text-base flex items-center gap-2">
                        <i data-lucide="layers" class="w-4 h-4 text-teal-600 dark:text-cyanGlow"></i>
                        <span>Kategori Tersedia ({{ $categories->count() }})</span>
                    </h3>

                    <div class="divide-y divide-slate-200/50 dark:divide-white/5">
                        @foreach($categories as $category)
                            <div class="py-3 flex items-center justify-between">
                                <div>
                                    <p class="font-semibold text-sm">{{ $category->name }}</p>
                                    <span class="text-[11px] font-mono text-slate-400">Slug: {{ $category->slug }} • Digunakan oleh {{ $category->projects_count ?? $category->projects->count() }} proyek</span>
                                </div>
                                <div>
                                    @if(($category->projects_count ?? $category->projects->count()) == 0)
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2.5 py-1 rounded-lg bg-rose-500/15 text-rose-400 border border-rose-500/30 text-xs font-mono hover:opacity-80">
                                                Hapus
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-slate-200 dark:bg-slate-800 text-slate-400">
                                            Terkait Proyek
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= TAB 3: PESAN MASUK ================= -->
        <div id="tab-messages" class="tab-content hidden space-y-4">
            <section class="glass rounded-2xl p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-bold flex items-center gap-2">
                        <i data-lucide="inbox" class="w-4 h-4 text-teal-600 dark:text-cyanGlow"></i>
                        <span>Pesan Masuk dari Formulir Portofolio ({{ $messages->count() }})</span>
                    </h3>
                </div>

                <div class="space-y-3">
                    @forelse($messages as $msg)
                        <div class="p-4 sm:p-5 rounded-xl bg-slate-100/60 dark:bg-slate-900/60 border border-slate-200 dark:border-white/5 flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                            <div class="space-y-1.5 flex-1">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="font-bold text-sm">{{ $msg->sender_name }}</span>
                                    <span class="font-mono text-xs text-slate-500 dark:text-slate-400">({{ $msg->sender_email }})</span>
                                    <span class="text-[11px] font-mono text-teal-600 dark:text-cyanGlow">
                                        • {{ $msg->created_at ? $msg->created_at->diffForHumans() : 'Baru saja' }}
                                    </span>
                                </div>
                                <p class="text-xs sm:text-sm text-slate-700 dark:text-slate-300 leading-relaxed font-sans whitespace-pre-line">
                                    {{ $msg->message }}
                                </p>
                            </div>

                            <div class="flex items-center gap-2 shrink-0 pt-2 sm:pt-0 border-t sm:border-t-0 border-slate-200 dark:border-white/5">
                                <a href="mailto:{{ $msg->sender_email }}?subject=Balasan%20Pesan%20dari%20Nazwar%20Makarim%20Mahardhika"
                                   class="px-3 py-1.5 rounded-lg bg-teal-500/15 text-teal-600 dark:text-cyanGlow border border-teal-500/30 text-xs font-mono hover:opacity-80 transition flex items-center gap-1">
                                    <i data-lucide="reply" class="w-3.5 h-3.5"></i>
                                    <span>Balas Email</span>
                                </a>

                                <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1.5 rounded-lg bg-rose-500/15 text-rose-400 border border-rose-500/30 text-xs font-mono hover:opacity-80 transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-xs font-mono text-slate-500">
                            Belum ada pesan yang masuk dari pengunjung.
                        </div>
                    @endforelse
                </div>
            </section>
        </div>

    </main>

@endsection

@push('scripts')
<script>
    // Tab Switching Logic
    const tabButtons = document.querySelectorAll('#admin-tabs .tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetTab = btn.getAttribute('data-tab');

            // Set button styles
            tabButtons.forEach(b => {
                b.className = 'tab-btn px-4 py-2 rounded-xl font-mono text-xs transition glass hover:border-teal-500/50 dark:hover:border-cyanGlow/50 flex items-center gap-1.5';
            });
            btn.className = 'tab-btn px-4 py-2 rounded-xl font-mono text-xs font-semibold bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy transition flex items-center gap-1.5 shadow-sm';

            // Show target content
            tabContents.forEach(content => {
                if (content.id === targetTab) {
                    content.classList.remove('hidden');
                } else {
                    content.classList.add('hidden');
                }
            });
        });
    });

    // Live Thumbnail Image Preview
    const imageInput = document.getElementById('project-image-input');
    const previewWrapper = document.getElementById('image-preview-wrapper');
    const imagePreview = document.getElementById('image-preview');

    if (imageInput && imagePreview && previewWrapper) {
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    previewWrapper.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                previewWrapper.classList.add('hidden');
            }
        });
    }
</script>
@endpush
