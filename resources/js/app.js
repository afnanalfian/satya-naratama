import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import { csrf, startKeepAlive, refreshToken } from './session';
import './ui';

window.Alpine = Alpine;

/* ------------------------------------------------------------
 | Sesi "abadi": token CSRF selalu segar, request Livewire yang
 | kebetulan kena 419 diulang otomatis setelah token diperbarui.
 * ---------------------------------------------------------- */
startKeepAlive();

Livewire.hook('request', ({ options, fail }) => {
    fail(({ status, preventDefault }) => {
        if (status === 419) {
            preventDefault();
            refreshToken().then(() => window.toast('info', 'Koneksi diperbarui. Silakan ulangi aksi terakhir.'));
        }
    });
});

Livewire.start();

export { csrf };
