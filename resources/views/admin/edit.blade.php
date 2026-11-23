<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Proyek — NMM.admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .glass { background: rgba(15, 23, 42, 0.65); backdrop-filter: blur(16px); border: 1px solid rgba(146, 238, 255, 0.14); }
    </style>
</head>
<body class="bg-[#0B1120] text-slate-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-2xl glass rounded-2xl p-6 space-y-5">
        <div class="flex items-center justify-between">
            <h1 class="text-lg font-bold">Edit Proyek</h1>
            <a href="{{ route('admin.projects.index') }}" class="text-xs font-mono text-slate-400 hover:text-[#92EEFF]">← Batal</a>
        </div>

        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-mono text-slate-300 mb-1">Judul Proyek</label>
                <input type="text" name="title" value="{{ $project->title }}" maxlength="150" required class="w-full px-3.5 py-2 rounded-xl bg-slate-900/80 border border-white/10 text-sm">
            </div>
            <div>
                <label class="block text-xs font-mono text-slate-300 mb-1">Kategori</label>
                <select name="category_id" required class="w-full px-3.5 py-2 rounded-xl bg-slate-900/80 border border-white/10 text-sm">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $project->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-mono text-slate-300 mb-1">Tech Stack</label>
                <input type="text" name="tech_stack" value="{{ $project->tech_stack }}" maxlength="200" required class="w-full px-3.5 py-2 rounded-xl bg-slate-900/80 border border-white/10 text-sm">
            </div>
            <div>
                <label class="block text-xs font-mono text-slate-300 mb-1">Ganti Thumbnail (Opsional)</label>
                <input type="file" name="image" accept="image/*" class="w-full px-3 py-1.5 rounded-xl bg-slate-900/80 border border-white/10 text-xs">
            </div>
            <div>
                <label class="block text-xs font-mono text-slate-300 mb-1">Link Live Demo</label>
                <input type="url" name="demo_url" value="{{ $project->demo_url }}" maxlength="255" class="w-full px-3.5 py-2 rounded-xl bg-slate-900/80 border border-white/10 text-sm">
            </div>
            <div>
                <label class="block text-xs font-mono text-slate-300 mb-1">Link GitHub Repo</label>
                <input type="url" name="github_url" value="{{ $project->github_url }}" maxlength="255" class="w-full px-3.5 py-2 rounded-xl bg-slate-900/80 border border-white/10 text-sm">
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-mono text-slate-300 mb-1">Deskripsi</label>
                <textarea name="description" rows="3" maxlength="5000" required class="w-full px-3.5 py-2 rounded-xl bg-slate-900/80 border border-white/10 text-sm">{{ $project->description }}</textarea>
            </div>
            <div class="md:col-span-2">
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#92EEFF] text-[#0B1120] font-bold text-sm hover:opacity-90 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

</body>
</html>
