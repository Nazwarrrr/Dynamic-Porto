<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — Kelola Portofolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .glass {
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(146, 238, 255, 0.14);
        }
    </style>
</head>
<body class="bg-[#0B1120] text-slate-100 min-h-screen">

    <nav class="border-b border-white/10 bg-slate-900/60 backdrop-blur-md sticky top-0 z-40">
        <div class="max-w-6xl mx-auto px-4 py-3.5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="font-mono font-bold text-[#92EEFF]">NMM.admin</span>
                <span class="text-xs font-mono px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-300 border border-emerald-500/20">Eloquent CRUD</span>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="text-xs font-mono text-slate-300 hover:text-[#92EEFF]">Lihat Web</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-rose-500/15 text-rose-300 border border-rose-500/30 text-xs font-mono hover:bg-rose-500/25 transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-8 space-y-8">

        @if(session('success'))
            <div class="glass border-emerald-500/40 text-emerald-300 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
                <i data-lucide="check-circle" class="w-4 h-4"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="glass border-rose-500/40 text-rose-300 px-4 py-3 rounded-xl text-xs font-mono">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form Create Project -->
        <section class="glass rounded-2xl p-6 space-y-4">
            <h2 class="text-lg font-bold flex items-center gap-2">
                <i data-lucide="plus-circle" class="w-5 h-5 text-[#92EEFF]"></i> Tambah Proyek Baru
            </h2>

            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-4">
                @csrf
                <div>
                    <label class="block text-xs font-mono text-slate-300 mb-1">Judul Proyek *</label>
                    <input type="text" name="title" maxlength="150" required placeholder="Contoh: EduCore — Smart School Platform" class="w-full px-3.5 py-2 rounded-xl bg-slate-900/80 border border-white/10 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-300 mb-1">Kategori *</label>
                    <select name="category_id" required class="w-full px-3.5 py-2 rounded-xl bg-slate-900/80 border border-white/10 text-sm">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-300 mb-1">Tech Stack (pisahkan koma) *</label>
                    <input type="text" name="tech_stack" maxlength="200" required placeholder="Laravel, Tailwind CSS, MySQL" class="w-full px-3.5 py-2 rounded-xl bg-slate-900/80 border border-white/10 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-300 mb-1">Thumbnail Gambar (Opsional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full px-3 py-1.5 rounded-xl bg-slate-900/80 border border-white/10 text-xs">
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-300 mb-1">Link Live Demo</label>
                    <input type="url" name="demo_url" maxlength="255" placeholder="https://..." class="w-full px-3.5 py-2 rounded-xl bg-slate-900/80 border border-white/10 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-mono text-slate-300 mb-1">Link GitHub Repo</label>
                    <input type="url" name="github_url" maxlength="255" placeholder="https://github.com/..." class="w-full px-3.5 py-2 rounded-xl bg-slate-900/80 border border-white/10 text-sm">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-mono text-slate-300 mb-1">Deskripsi Proyek *</label>
                    <textarea name="description" rows="2" maxlength="5000" required placeholder="Jelaskan fungsi utama dan solusi dari proyek ini..." class="w-full px-3.5 py-2 rounded-xl bg-slate-900/80 border border-white/10 text-sm"></textarea>
                </div>
                <div class="md:col-span-2">
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#92EEFF] text-[#0B1120] font-bold text-sm hover:opacity-90 transition">
                        Simpan Proyek
                    </button>
                </div>
            </form>
        </section>

        <!-- Tabel Daftar Proyek (Read, Update, Delete) -->
        <section class="glass rounded-2xl p-6 space-y-4">
            <h2 class="text-lg font-bold">Daftar Proyek ({{ $projects->count() }})</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="text-xs font-mono text-slate-400 border-b border-white/10">
                        <tr>
                            <th class="py-3 px-2">Judul</th>
                            <th class="py-3 px-2">Kategori</th>
                            <th class="py-3 px-2">Tech Stack</th>
                            <th class="py-3 px-2 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($projects as $project)
                            <tr>
                                <td class="py-3 px-2 font-semibold">{{ $project->title }}</td>
                                <td class="py-3 px-2 font-mono text-xs text-[#92EEFF]">{{ $project->category->name }}</td>
                                <td class="py-3 px-2 font-mono text-xs text-slate-400">{{ $project->tech_stack }}</td>
                                <td class="py-3 px-2 text-right space-x-2">
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="inline-block px-3 py-1 rounded-lg bg-amber-500/15 text-amber-300 border border-amber-500/30 text-xs font-mono">Edit</a>
                                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus proyek ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 rounded-lg bg-rose-500/15 text-rose-300 border border-rose-500/30 text-xs font-mono">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Tabel Pesan Masuk dari Pengunjung (Tabel ke-4: messages) -->
        <section class="glass rounded-2xl p-6 space-y-4">
            <h2 class="text-lg font-bold">Pesan Masuk ({{ $messages->count() }})</h2>
            <div class="space-y-3">
                @forelse($messages as $msg)
                    <div class="p-4 rounded-xl bg-slate-900/60 border border-white/5 flex items-start justify-between gap-4">
                        <div>
                            <p class="font-semibold text-sm">{{ $msg->sender_name }} <span class="font-mono text-xs text-slate-400">({{ $msg->sender_email }})</span></p>
                            <p class="text-xs text-slate-300 mt-1">{{ $msg->message }}</p>
                        </div>
                        <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs font-mono text-rose-400 hover:underline">Hapus</button>
                        </form>
                    </div>
                @empty
                    <p class="text-xs font-mono text-slate-400">Belum ada pesan masuk dari form kontak.</p>
                @endforelse
            </div>
        </section>

    </main>

    <script>lucide.createIcons();</script>
</body>
</html>
