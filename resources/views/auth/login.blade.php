<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — NMM.dev</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .glass {
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(146, 238, 255, 0.16);
        }
    </style>
</head>
<body class="bg-[#0B1120] text-slate-100 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    <div class="absolute -top-24 -left-24 w-80 h-80 bg-teal-500/20 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -right-24 w-80 h-80 bg-[#92EEFF]/15 rounded-full blur-3xl"></div>

    <div class="w-full max-w-md glass rounded-2xl p-8 space-y-6 relative z-10 shadow-2xl">
        <div class="space-y-1 text-center">
            <div class="w-12 h-12 rounded-2xl bg-[#92EEFF]/10 border border-[#92EEFF]/30 flex items-center justify-center mx-auto mb-3">
                <i data-lucide="shield-check" class="w-6 h-6 text-[#92EEFF]"></i>
            </div>
            <h1 class="text-xl font-bold">Admin Portal Login</h1>
            <p class="text-xs font-mono text-slate-400">Middleware Auth Protected Area</p>
        </div>

        @if($errors->any())
            <div class="p-3 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-xs font-mono">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-mono text-slate-300 mb-1.5">Email Admin</label>
                <input type="email" name="email" value="{{ old('email', 'admin@nazwar.dev') }}" autocomplete="username" required class="w-full px-3.5 py-2.5 rounded-xl bg-slate-900/80 border border-white/10 text-sm focus:outline-none focus:border-[#92EEFF]">
            </div>
            <div>
                <label class="block text-xs font-mono text-slate-300 mb-1.5">Password</label>
                <input type="password" name="password" autocomplete="current-password" required class="w-full px-3.5 py-2.5 rounded-xl bg-slate-900/80 border border-white/10 text-sm focus:outline-none focus:border-[#92EEFF]">
            </div>
            <button type="submit" class="w-full py-2.5 rounded-xl bg-[#92EEFF] text-[#0B1120] font-bold text-sm hover:opacity-90 transition">
                Masuk Dashboard
            </button>
        </form>

        <div class="text-center">
            <a href="{{ route('home') }}" class="text-xs font-mono text-slate-400 hover:text-[#92EEFF] transition">
                ← Kembali ke Portofolio
            </a>
        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>
