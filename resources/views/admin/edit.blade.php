@extends('layouts.app')

@section('title', 'Edit Proyek — ' . $project->title . ' | Admin')

@section('content')

    <div class="min-h-screen flex items-center justify-center p-4 py-12">
        <div class="w-full max-w-2xl glass rounded-3xl p-6 sm:p-8 space-y-6 shadow-2xl border border-teal-500/20 dark:border-cyanGlow/20">
            <div class="flex items-center justify-between pb-4 border-b border-slate-200/60 dark:border-white/10">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-amber-500/10 text-amber-500 flex items-center justify-center">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold">Edit Proyek</h1>
                        <p class="text-xs font-mono text-slate-500 dark:text-slate-400">Perbarui data atau foto thumbnail</p>
                    </div>
                </div>
                <a href="{{ route('admin.projects.index') }}" class="text-xs font-mono text-slate-500 hover:text-teal-600 dark:hover:text-cyanGlow flex items-center gap-1">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                    <span>Kembali</span>
                </a>
            </div>

            @if($errors->any())
                <div class="p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-xs font-mono space-y-1">
                    <p class="font-bold">Terjadi kesalahan validasi:</p>
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-mono mb-1 font-medium">Judul Proyek *</label>
                    <input type="text" name="title" value="{{ old('title', $project->title) }}" maxlength="150" required
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-100/70 dark:bg-slate-900/80 border border-slate-200 dark:border-white/10 text-sm focus:outline-none focus:border-cyanGlow">
                </div>

                <div>
                    <label class="block text-xs font-mono mb-1 font-medium">Kategori *</label>
                    <select name="category_id" required class="w-full px-3.5 py-2.5 rounded-xl bg-slate-100/70 dark:bg-slate-900/80 border border-slate-200 dark:border-white/10 text-sm focus:outline-none focus:border-cyanGlow">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $project->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-mono mb-1 font-medium">Tech Stack (pisahkan koma) *</label>
                    <input type="text" name="tech_stack" value="{{ old('tech_stack', $project->tech_stack) }}" maxlength="200" required
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-100/70 dark:bg-slate-900/80 border border-slate-200 dark:border-white/10 text-sm focus:outline-none focus:border-cyanGlow">
                </div>

                <div>
                    <label class="block text-xs font-mono mb-1 font-medium">Ganti Thumbnail (Opsional, Max 2MB)</label>
                    <input type="file" name="image" id="edit-image-input" accept="image/*"
                        class="w-full px-3 py-2 rounded-xl bg-slate-100/70 dark:bg-slate-900/80 border border-slate-200 dark:border-white/10 text-xs">
                    
                    <!-- Current / New Thumbnail Preview -->
                    <div class="mt-2 flex items-center gap-3">
                        @if($project->image)
                            <div id="current-image-preview">
                                <span class="text-[10px] font-mono text-slate-400 block mb-1">Foto Saat Ini:</span>
                                <img src="{{ asset('storage/' . $project->image) }}" alt="Current Image" class="h-16 rounded-lg object-cover border border-white/10">
                            </div>
                        @endif
                        <div id="new-image-preview-wrapper" class="hidden">
                            <span class="text-[10px] font-mono text-emerald-400 block mb-1">Foto Baru Terpilih:</span>
                            <img id="new-image-preview" src="#" alt="New Image" class="h-16 rounded-lg object-cover border border-emerald-500/40">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-mono mb-1 font-medium">Link Live Demo</label>
                    <input type="url" name="demo_url" value="{{ old('demo_url', $project->demo_url) }}" maxlength="255" placeholder="https://..."
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-100/70 dark:bg-slate-900/80 border border-slate-200 dark:border-white/10 text-sm focus:outline-none focus:border-cyanGlow">
                </div>

                <div>
                    <label class="block text-xs font-mono mb-1 font-medium">Link GitHub Repo</label>
                    <input type="url" name="github_url" value="{{ old('github_url', $project->github_url) }}" maxlength="255" placeholder="https://github.com/..."
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-100/70 dark:bg-slate-900/80 border border-slate-200 dark:border-white/10 text-sm focus:outline-none focus:border-cyanGlow">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-mono mb-1 font-medium">Deskripsi Lengkap *</label>
                    <textarea name="description" rows="4" maxlength="5000" required
                        class="w-full px-3.5 py-2.5 rounded-xl bg-slate-100/70 dark:bg-slate-900/80 border border-slate-200 dark:border-white/10 text-sm focus:outline-none focus:border-cyanGlow">{{ old('description', $project->description) }}</textarea>
                </div>

                <div class="md:col-span-2 flex items-center justify-end gap-3 pt-2">
                    <a href="{{ route('admin.projects.index') }}" class="px-5 py-2.5 rounded-xl glass text-xs font-mono font-medium hover:opacity-80">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-teal-600 dark:bg-cyanGlow text-white dark:text-navy font-bold text-sm hover:opacity-90 transition shadow-md flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    const editImageInput = document.getElementById('edit-image-input');
    const newImageWrapper = document.getElementById('new-image-preview-wrapper');
    const newImagePreview = document.getElementById('new-image-preview');

    if (editImageInput && newImageWrapper && newImagePreview) {
        editImageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    newImagePreview.src = e.target.result;
                    newImageWrapper.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                newImageWrapper.classList.add('hidden');
            }
        });
    }
</script>
@endpush
