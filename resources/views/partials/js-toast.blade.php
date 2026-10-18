@once
<script>
    // Tampilkan toast dari JavaScript memakai komponen toast bawaan layout
    window.snToast = function (type, message) {
        const el = document.querySelector('[x-data="toastManager()"]');
        const data = el && window.Alpine ? window.Alpine.$data(el) : null;
        if (data && typeof data.push === 'function') data.push(type, message, 3000);
        else alert(message);
    };
</script>
@endonce
