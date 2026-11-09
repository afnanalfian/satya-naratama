/* =========================================================
 | UI helpers global: toast, konfirmasi, grafik, rumus, salin
 * ======================================================= */

/* ---------- Toast ---------- */
window.toast = (type, message, timeout = 4200) => {
    window.dispatchEvent(new CustomEvent('toast', { detail: { type, message, timeout } }));
};

document.addEventListener('alpine:init', () => {
    const Alpine = window.Alpine;

    Alpine.data('toaster', (initial = []) => ({
        items: [],
        init() {
            initial.forEach((t) => this.push(t));
            window.addEventListener('toast', (e) => {
                const d = Array.isArray(e.detail) ? e.detail[0] : e.detail;
                this.push(d);
            });
        },
        push({ type = 'info', message = '', timeout = 4200 }) {
            if (!message) return;
            if (!['success', 'error', 'warning', 'info'].includes(type)) type = 'error';
            const id = Date.now() + Math.random();
            this.items.push({ id, type, message, show: true });
            setTimeout(() => this.remove(id), timeout);
        },
        remove(id) {
            const t = this.items.find((i) => i.id === id);
            if (t) t.show = false;
            setTimeout(() => (this.items = this.items.filter((i) => i.id !== id)), 300);
        },
    }));

    /* ---------- Konfirmasi (pengganti SweetAlert) ---------- */
    Alpine.store('confirm', {
        open: false, title: 'Konfirmasi', message: '', okText: 'Ya, lanjutkan', danger: true, _resolve: null,
        ask(message, opts = {}) {
            Object.assign(this, { title: 'Konfirmasi', okText: 'Ya, lanjutkan', danger: true }, opts, { message, open: true });
            return new Promise((r) => (this._resolve = r));
        },
        answer(v) { this.open = false; this._resolve && this._resolve(v); this._resolve = null; },
    });

    Alpine.magic('confirm', () => (message, cb, opts) =>
        Alpine.store('confirm').ask(message, opts).then((ok) => ok && cb && cb()));

    /* ---------- Salin ke clipboard ---------- */
    Alpine.magic('copy', () => (text, msg = 'Tersalin ke clipboard') => {
        navigator.clipboard?.writeText(text).then(() => window.toast('success', msg))
            .catch(() => window.toast('error', 'Gagal menyalin'));
    });

    /* ---------- Grafik Chart.js (dimuat via <x-chartjs/>) ---------- */
    Alpine.data('chart', (config) => ({
        c: null,
        init() {
            const draw = () => {
                if (!window.Chart) return setTimeout(draw, 60);
                window.Chart.defaults.font.family = '"Plus Jakarta Sans", ui-sans-serif, system-ui';
                window.Chart.defaults.color = '#75589f';
                window.Chart.defaults.plugins.legend.labels.usePointStyle = true;
                this.c = new window.Chart(this.$refs.canvas || this.$el.querySelector('canvas'), config);
            };
            draw();
        },
        destroy() { this.c && this.c.destroy(); },
    }));
});

/* ---------- Form dengan data-confirm ---------- */
document.addEventListener('submit', (e) => {
    const form = e.target;
    if (!(form instanceof HTMLFormElement) || !form.dataset.confirm || form.dataset.confirmed === '1') return;
    e.preventDefault();
    window.Alpine.store('confirm').ask(form.dataset.confirm, {
        okText: form.dataset.ok || 'Ya, lanjutkan',
        danger: form.dataset.danger !== '0',
    }).then((ok) => {
        if (!ok) return;
        form.dataset.confirmed = '1';
        form.requestSubmit ? form.requestSubmit(e.submitter || undefined) : form.submit();
        setTimeout(() => (form.dataset.confirmed = ''), 500);
    });
});

/* ---------- Render rumus (KaTeX, dimuat via <x-katex/>) ---------- */
window.renderMath = (el = document.body) => {
    if (!window.renderMathInElement) return;
    try {
        window.renderMathInElement(el, {
            delimiters: [
                { left: '$$', right: '$$', display: true },
                { left: '\\[', right: '\\]', display: true },
                { left: '\\(', right: '\\)', display: false },
                { left: '$', right: '$', display: false },
            ],
            throwOnError: false,
            ignoredTags: ['script', 'noscript', 'style', 'textarea', 'pre', 'code', 'input'],
        });
    } catch (e) { /* abaikan */ }
};
document.addEventListener('DOMContentLoaded', () => window.renderMath());
document.addEventListener('livewire:init', () => {
    window.Livewire.hook('morphed', ({ el }) => window.renderMath(el));
});

/* ---------- Format angka ---------- */
window.rupiah = (n) => 'Rp ' + Number(n || 0).toLocaleString('id-ID');
