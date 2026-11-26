@extends('layouts.app')

@section('title', 'Nazwar Makarim Mahardhika — Web & IoT Developer')

@section('content')

<section id="hero" class="relative isolate overflow-hidden">
    <canvas id="sonar" class="absolute inset-0 -z-10 size-full" aria-hidden="true"></canvas>

    <div class="mx-auto flex min-h-[92svh] max-w-6xl flex-col justify-end px-5 pb-24 pt-36">
        <p class="fade mb-6 inline-flex w-fit items-center gap-2 rounded-full border border-line px-3 py-1.5 text-xs font-medium tracking-wide text-muted" style="--i:0">
            <span class="size-1.5 rounded-full bg-accent" aria-hidden="true"></span>
            SISWA RPL · SMKN 1 GARUT · TERBUKA UNTUK PKL
        </p>
        <h1 class="font-display text-[clamp(2.75rem,8.2vw,7.5rem)] font-semibold leading-[0.94] tracking-[-0.035em]">
            <span class="line"><span style="--i:1">Teknologi yang</span></span>
            <span class="line"><span style="--i:2">punya tujuan.</span></span>
            <span class="line text-accent"><span style="--i:3">Dari web hingga IoT.</span></span>
        </h1>

        <div class="fade mt-10 grid gap-8 lg:grid-cols-12" style="--i:5">
            <p class="max-w-xl text-lg leading-relaxed text-muted lg:col-span-6">
                Saya Nazwar Makarim Mahardhika, siswa Rekayasa Perangkat Lunak yang membangun aplikasi dengan Laravel dan React, serta merancang prototipe berbasis ESP32. Dari penyelamatan pangan dan pelacakan emisi hingga alat bantu mobilitas—saya ingin kode yang saya tulis punya manfaat. Saat ini saya mencari kesempatan PKL.
            </p>
            <div class="flex flex-wrap items-center gap-x-8 gap-y-4 lg:col-span-6 lg:justify-end">
                <a href="#projects" class="btn">Lihat proyek</a>
                <a href="#contact" class="ulink py-2 font-medium">Mari berkolaborasi</a>
            </div>
        </div>
    </div>

    <p class="fade absolute bottom-6 right-5 text-sm text-muted" style="--i:7" aria-hidden="true">
        Sensor ultrasonik, objek berjarak <span id="sonar-readout" class="inline-block w-16 font-mono tabular-nums text-ink">0 cm</span>
        <span id="sonar-hint" class="block text-right">Gerakkan kursor untuk memindahkan objek</span>
    </p>
</section>

<section id="projects" class="scroll-mt-16 border-t border-line">
    <div class="mx-auto max-w-6xl px-5 py-24">
        <p class="text-xs font-medium tracking-[0.18em] text-accent">IDE YANG MENJADI KARYA</p>
        <h2 class="mt-3 font-display text-4xl font-semibold tracking-tight sm:text-5xl">Proyek pilihan</h2>
        <p class="mt-4 max-w-2xl text-lg leading-relaxed text-muted">
            Tiga eksplorasi dengan tujuan berbeda: menghubungkan pangan berlebih dengan komunitas, memahami jejak karbon harian, dan merancang alat bantu mobilitas dengan IoT.
        </p>

        @php
            $lead = $projects->first();
            $rest = $projects->slice(1);
        @endphp

        @if($lead)
            <div class="mt-14"><x-project-item :project="$lead" :lead="true" /></div>
            @if($rest->isNotEmpty())
                <div class="mt-20 grid gap-x-10 gap-y-16 sm:grid-cols-2">
                    @foreach($rest as $project)
                        <x-project-item :project="$project" />
                    @endforeach
                </div>
            @endif
        @else
            <p class="mt-14 text-muted">Belum ada proyek yang ditambahkan.</p>
        @endif
    </div>
</section>

<section id="about" class="scroll-mt-16 border-t border-line">
    <div class="mx-auto grid max-w-6xl gap-12 px-5 py-24 lg:grid-cols-12">
        <div class="lg:sticky lg:top-28 lg:col-span-4 lg:self-start">
            <p class="text-xs font-medium tracking-[0.18em] text-accent">CARA SAYA BERKARYA</p>
            <h2 class="mt-3 font-display text-4xl font-semibold tracking-tight sm:text-5xl">Belajar, merakit, lalu membuatnya nyata.</h2>
            <p class="mt-5 leading-relaxed text-muted">
                Saya menikmati proses dari memahami masalah, menyusun logika dan antarmuka, sampai menguji ide lewat aplikasi maupun prototipe perangkat.
            </p>
        </div>

        <div class="lg:col-span-8">
            <dl class="border-b border-line">
                @foreach([
                    ['Laravel dan MySQL', 'Fondasi untuk aplikasi portofolio ini, termasuk login admin, pengelolaan proyek, dan pengujian otomatis.'],
                    ['React dan Supabase', 'Membangun pengalaman aplikasi untuk BagiRasa dan JejakHijau.'],
                    ['ESP32 dan C++', 'Merangkai sensor ultrasonik, motor getar, dan layar OLED pada prototipe WALL-Z.'],
                    ['Docker dan Railway', 'Mengemas dan menjalankan aplikasi ini melalui alur deployment berbasis Docker.'],
                ] as [$name, $proof])
                    <div class="grid gap-1 border-t border-line py-5 sm:grid-cols-3 sm:gap-6">
                        <dt class="font-medium">{{ $name }}</dt>
                        <dd class="text-muted sm:col-span-2">{{ $proof }}</dd>
                    </div>
                @endforeach
            </dl>

            <h3 class="mt-16 font-display text-2xl font-semibold tracking-tight">Pendidikan dan aktivitas</h3>
            <dl class="mt-6 border-b border-line">
                @foreach([
                    ['SMKN 1 Garut, Rekayasa Perangkat Lunak', '2024 sampai sekarang. Mendalami pemrograman berorientasi objek, basis data relasional, pengujian otomatis, dan prototipe IoT.'],
                    ['Pelatihan LKS Cyber Security', 'Mempelajari dasar analisis kerentanan web, keamanan jaringan, kriptografi, dan pengujian penetrasi di Linux.'],
                    ['Mentor di sekolah', 'Berbagi dasar logika pemrograman dan membantu teman merakit sirkuit sensor.'],
                ] as [$title, $desc])
                    <div class="grid gap-1 border-t border-line py-5 sm:grid-cols-3 sm:gap-6">
                        <dt class="font-medium">{{ $title }}</dt>
                        <dd class="text-muted sm:col-span-2">{{ $desc }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </div>
</section>

<section id="contact" class="scroll-mt-16 border-t border-line">
    <div class="mx-auto grid max-w-6xl gap-16 px-5 py-24 lg:grid-cols-12">
        <div class="lg:col-span-7">
            <p class="text-xs font-medium tracking-[0.18em] text-accent">ADA IDE YANG INGIN DIWUJUDKAN?</p>
            <h2 class="mt-3 font-display text-[clamp(2.5rem,6vw,5rem)] font-semibold leading-[0.98] tracking-[-0.03em]">Mari buat teknologi yang berguna.</h2>
            <p class="mt-6 max-w-xl text-lg leading-relaxed text-muted">Saya terbuka untuk kesempatan PKL dan kolaborasi proyek web maupun IoT. Ceritakan kebutuhan atau ide yang sedang kamu kerjakan.</p>
            <p class="mt-8">
                <a href="mailto:nazwarmakarim818@gmail.com" class="ulink break-all font-display text-2xl font-medium sm:text-3xl">nazwarmakarim818@gmail.com</a>
            </p>
            <p class="mt-4 text-muted">
                Atau lewat WhatsApp di
                <a href="https://wa.me/6289509306601?text=Halo%20Nazwar,%20saya%20tertarik%20dengan%20portofolio%20Anda" target="_blank" rel="noopener noreferrer" class="ulink text-ink">+62 895-0930-6601</a>.
            </p>
        </div>

        <form id="contact-form" action="{{ route('contact.store') }}" method="POST" class="space-y-6 lg:col-span-5">
            @csrf
            @if($errors->any())
                <p role="alert" class="text-sm text-red-700 dark:text-red-300">{{ $errors->first() }}</p>
            @endif
            <div>
                <label for="sender_name" class="text-sm text-muted">Nama</label>
                <input id="sender_name" name="sender_name" type="text" autocomplete="name" value="{{ old('sender_name') }}" required maxlength="100" class="field">
            </div>
            <div>
                <label for="sender_email" class="text-sm text-muted">Email</label>
                <input id="sender_email" name="sender_email" type="email" autocomplete="email" value="{{ old('sender_email') }}" required maxlength="100" class="field">
            </div>
            <div>
                <label for="message" class="text-sm text-muted">Pesan</label>
                <textarea id="message" name="message" rows="4" required maxlength="1000" class="field resize-y">{{ old('message') }}</textarea>
            </div>
            <button type="submit" class="btn"><span>Kirim pesan</span></button>
        </form>
    </div>
</section>

@endsection
