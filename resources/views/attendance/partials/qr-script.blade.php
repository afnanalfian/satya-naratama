@once
<script src="{{ asset('vendor/qrcodejs/qrcode.min.js') }}"></script>
<script>
    // Render semua elemen [data-qr] menjadi QR code
    window.renderQrCodes = function (root) {
        (root || document).querySelectorAll('[data-qr]').forEach((el) => {
            if (el.dataset.rendered) return;
            const size = parseInt(el.dataset.size || '160', 10);
            new QRCode(el, {
                text: el.dataset.qr, width: size, height: size,
                colorDark: '#0D1B0D', colorLight: '#ffffff',
                correctLevel: QRCode.CorrectLevel.M,
            });
            el.dataset.rendered = '1';
            el.removeAttribute('title');
        });
    };
    document.addEventListener('DOMContentLoaded', () => window.renderQrCodes());
</script>
@endonce
