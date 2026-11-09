/**
 * Menjaga sesi tetap hidup selama tab terbuka & memperbarui token CSRF.
 * Bersama "remember me" permanen di server, pengguna tidak akan
 * ter-logout kecuali menekan tombol Keluar.
 */
let last = Date.now();
const INTERVAL = 10 * 60 * 1000; // 10 menit

export function csrf() {
    return document.querySelector('meta[name="csrf-token"]')?.content ?? '';
}

function apply(token) {
    if (!token) return;
    document.querySelector('meta[name="csrf-token"]')?.setAttribute('content', token);
    document.querySelectorAll('input[name="_token"]').forEach((i) => (i.value = token));
    if (window.livewireScriptConfig) window.livewireScriptConfig.csrf = token;
    document.querySelectorAll('[data-csrf]').forEach((el) => el.setAttribute('data-csrf', token));
    if (window.axios) window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
}

export async function refreshToken() {
    try {
        const res = await fetch('/keep-alive', {
            headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            credentials: 'same-origin',
            cache: 'no-store',
        });
        if (res.ok) {
            const data = await res.json();
            apply(data.token);
            last = Date.now();
            return data.token;
        }
    } catch (e) { /* offline: coba lagi nanti */ }
    return csrf();
}

export function startKeepAlive() {
    setInterval(() => { if (!document.hidden) refreshToken(); }, INTERVAL);
    document.addEventListener('visibilitychange', () => {
        if (!document.hidden && Date.now() - last > 5 * 60 * 1000) refreshToken();
    });
    window.addEventListener('online', () => refreshToken());

    // Form biasa: jika halaman sudah lama terbuka, segarkan token dulu sebelum submit.
    document.addEventListener('submit', async (e) => {
        const form = e.target;
        if (!(form instanceof HTMLFormElement) || form.dataset.fresh === '1') return;
        if (!form.querySelector('input[name="_token"]')) return;
        if (Date.now() - last < 30 * 60 * 1000) return;
        e.preventDefault();
        e.stopPropagation();
        await refreshToken();
        form.dataset.fresh = '1';
        form.requestSubmit ? form.requestSubmit(e.submitter || undefined) : form.submit();
    }, true);

    window.refreshCsrf = refreshToken;
    window.csrf = csrf;
}
