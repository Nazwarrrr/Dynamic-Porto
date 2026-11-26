import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

const ready = (fn) => (document.readyState === 'loading' ? document.addEventListener('DOMContentLoaded', fn) : fn());

/* Sonar: sensor ultrasonik di kanan hero. Objek mengikuti kursor; makin dekat, makin sering ping. */
function initSonar(cv) {
    const hero = cv.parentElement;
    const ctx = cv.getContext('2d');
    const readout = document.getElementById('sonar-readout');
    const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
    let w = 0, h = 0, sx = 0, sy = 0, maxR = 0;
    let pointer = null, rings = [], lastPing = 0, echoAt = -1e9, running = false, lastText = '';
    const SPEED = 0.28; // px per ms

    const resize = () => {
        const dpr = Math.min(devicePixelRatio || 1, 2);
        const r = cv.getBoundingClientRect();
        w = r.width; h = r.height;
        cv.width = w * dpr; cv.height = h * dpr;
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
        sx = w * (w > 760 ? 0.8 : 0.84);
        sy = h * (w > 760 ? 0.52 : 0.2);
        maxR = Math.hypot(Math.max(sx, w - sx), Math.max(sy, h - sy));
    };

    const frame = (t) => {
        const s = getComputedStyle(document.documentElement);
        const accent = s.getPropertyValue('--accent').trim();
        const ink = s.getPropertyValue('--ink').trim();

        let ox, oy;
        if (pointer) { ox = pointer.x; oy = pointer.y; }
        else {
            ox = sx - w * 0.12 - (Math.sin(t / 2600) * 0.5 + 0.5) * w * 0.3;
            oy = sy + h * 0.08 + Math.sin(t / 1900) * h * 0.22;
        }
        const d = Math.hypot(ox - sx, oy - sy);

        const interval = Math.min(2400, Math.max(420, 380 + d * 2.2));
        if (t - lastPing > interval) { rings.push({ t0: t, hit: false }); lastPing = t; }
        rings = rings.filter((g) => (t - g.t0) * SPEED < maxR);

        ctx.clearRect(0, 0, w, h);
        ctx.lineWidth = 1;
        for (const g of rings) {
            const r = (t - g.t0) * SPEED;
            if (!g.hit && r >= d) { g.hit = true; echoAt = t; }
            ctx.globalAlpha = 0.4 * (1 - r / maxR);
            ctx.strokeStyle = accent;
            ctx.beginPath(); ctx.arc(sx, sy, r, 0, Math.PI * 2); ctx.stroke();
        }

        ctx.globalAlpha = 0.25; ctx.strokeStyle = ink; ctx.setLineDash([3, 5]);
        ctx.beginPath(); ctx.moveTo(sx, sy); ctx.lineTo(ox, oy); ctx.stroke(); ctx.setLineDash([]);

        const e = (t - echoAt) / 500;
        if (e >= 0 && e < 1) {
            ctx.globalAlpha = 0.6 * (1 - e); ctx.strokeStyle = accent;
            ctx.beginPath(); ctx.arc(ox, oy, 6 + e * 22, 0, Math.PI * 2); ctx.stroke();
        }

        ctx.globalAlpha = 1; ctx.fillStyle = ink;
        ctx.beginPath(); ctx.arc(ox, oy, 4, 0, Math.PI * 2); ctx.fill();

        ctx.strokeStyle = accent; ctx.lineWidth = 2;
        for (const dx of [-13, 13]) { ctx.beginPath(); ctx.arc(sx + dx, sy, 9, 0, Math.PI * 2); ctx.stroke(); }

        const text = Math.round(d * 0.4) + ' cm';
        if (readout && text !== lastText) { readout.textContent = text; lastText = text; }
    };

    const loop = (t) => { if (running) { frame(t); requestAnimationFrame(loop); } };
    const start = () => { if (!running && !reduce) { running = true; requestAnimationFrame(loop); } };
    const stop = () => { running = false; };

    resize();
    if (reduce) {
        rings = [-500, -1300, -2100].map((t0) => ({ t0, hit: true }));
        frame(0);
    }
    addEventListener('resize', () => { resize(); if (reduce) frame(0); });

    hero.addEventListener('pointermove', (e) => {
        if (e.pointerType === 'touch') return;
        const r = cv.getBoundingClientRect();
        pointer = { x: e.clientX - r.left, y: e.clientY - r.top };
    });
    hero.addEventListener('pointerleave', () => { pointer = null; });

    new IntersectionObserver(([entry]) => (entry.isIntersecting ? start() : stop())).observe(hero);
    document.addEventListener('visibilitychange', () => (document.hidden ? stop() : start()));
}

ready(() => {
    window.lucide?.createIcons();

    const nav = document.getElementById('site-nav');
    if (nav) {
        const set = () => { nav.dataset.scrolled = String(scrollY > 8); };
        set();
        addEventListener('scroll', set, { passive: true });
    }

    document.querySelectorAll('[data-toast]').forEach((el) => setTimeout(() => el.remove(), 6000));

    const form = document.getElementById('contact-form');
    form?.addEventListener('submit', () => {
        const btn = form.querySelector('[type=submit]');
        btn.disabled = true;
        btn.querySelector('span').textContent = 'Mengirim';
    });

    const canvas = document.getElementById('sonar');
    if (canvas) initSonar(canvas);
});
