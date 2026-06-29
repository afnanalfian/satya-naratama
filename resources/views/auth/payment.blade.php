@extends('layouts.guest')

@section('title', 'Pembayaran – Satya Naratama')
@section('content')

<div class="w-full py-12 sm:py-20 px-4 flex items-center justify-center">

    <div
        class="w-full max-w-2xl mx-auto
            p-6 sm:p-8
            rounded-3xl shadow-xl
            bg-azwara-lightest dark:bg-azwara-darker
            border border-azwara-light/30
            transition-colors">

        {{-- Title --}}
        <div class="text-center mb-8">
            <div class="flex items-center justify-center gap-3 mb-2">
                <span class="h-px w-8 bg-primary/60"></span>
                <p class="text-xs font-semibold tracking-[0.2em] text-primary uppercase">Pembayaran</p>
                <span class="h-px w-8 bg-primary/60"></span>
            </div>
            <h2 class="text-2xl font-extrabold text-azwara-darker dark:text-white">
                Selesaikan Pembayaran 💳
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                {{ $registration->full_name }} • {{ $registration->email }}
            </p>
        </div>

        {{-- Info Pendaftaran --}}
        <div class="bg-primary/5 dark:bg-primary/10 rounded-xl p-4 mb-6 border border-primary/20">
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600 dark:text-gray-400">Biaya Pendaftaran</span>
                <span class="text-xl font-bold text-azwara-darker dark:text-white">
                    Rp {{ number_format($registration->registration_fee, 0, ',', '.') }}
                </span>
            </div>
            <div class="flex justify-between items-center mt-2 text-sm">
                <span class="text-gray-500 dark:text-gray-400">Batas Pembayaran</span>
                <span class="text-red-600 dark:text-red-400 font-medium">
                    {{ $registration->payment_expires_at->format('d M Y H:i') }}
                </span>
            </div>
            <div class="flex justify-between items-center mt-2 text-sm">
                <span class="text-gray-500 dark:text-gray-400">Kode Pendaftaran</span>
                <span class="font-mono text-sm font-medium text-azwara-darker dark:text-white">
                    #{{ str_pad($registration->id, 6, '0', STR_PAD_LEFT) }}
                </span>
            </div>
        </div>

        {{-- Metode Pembayaran --}}
        <div class="mb-6">
            <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                Pilih Metode Pembayaran
            </p>

            {{-- Tab Metode --}}
            <div class="grid grid-cols-2 gap-3 mb-4">
                <button 
                    onclick="switchPayment('qris')"
                    id="tab-qris"
                    class="py-3 rounded-xl font-medium text-center transition-all duration-300
                           bg-primary text-white shadow-md hover:shadow-lg">
                    📱 QRIS
                </button>
                <button 
                    onclick="switchPayment('transfer')"
                    id="tab-transfer"
                    class="py-3 rounded-xl font-medium text-center transition-all duration-300
                           bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400
                           hover:bg-gray-200 dark:hover:bg-gray-700">
                    🏦 Transfer Bank
                </button>
            </div>

            {{-- QRIS Panel --}}
            <div id="panel-qris" class="payment-panel">
                <div class="text-center">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                        Scan QRIS Berikut untuk Pembayaran
                    </p>
                    <div class="inline-block p-4 bg-white rounded-2xl shadow-md border border-gray-200 dark:border-gray-700">
                        {{-- Ganti dengan path QRIS Anda --}}
                        <img src="{{ asset('img/qris-satya-naratama.png') }}" 
                             alt="QRIS Pembayaran"
                             class="w-48 h-48 object-contain">
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                        * Scan QRIS menggunakan aplikasi mobile banking
                    </p>
                </div>
            </div>

            {{-- Transfer Bank Panel --}}
            <div id="panel-transfer" class="payment-panel hidden">
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4">
                    <p class="text-sm font-medium text-blue-800 dark:text-blue-200 mb-3">
                        💰 Transfer ke Rekening Berikut:
                    </p>
                    
                    <div class="space-y-3">
                        {{-- Bank BRI --}}
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-3 border border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-bold text-blue-700 dark:text-blue-400">BRI</span>
                                        <span class="text-xs text-gray-500">Bank Rakyat Indonesia</span>
                                    </div>
                                    <p class="text-lg font-mono font-bold text-azwara-darker dark:text-white mt-1">
                                        0223 0105 9553 505
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        a.n. Muhammad Afnan Alfian
                                    </p>
                                </div>
                                <button 
                                    onclick="copyRekening('022301059553505')"
                                    class="px-3 py-1.5 text-xs font-medium rounded-lg
                                           bg-primary/10 text-primary hover:bg-primary/20 transition">
                                    Salin
                                </button>
                            </div>
                        </div>

                        {{-- Info Tambahan --}}
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-3">
                            <p class="text-xs text-yellow-800 dark:text-yellow-200">
                                <span class="font-medium">📌 Penting:</span> 
                                Transfer sesuai nominal <strong>Rp {{ number_format($registration->registration_fee, 0, ',', '.') }}</strong> 
                                {{-- dan gunakan kode pendaftaran <strong>#{{ str_pad($registration->id, 6, '0', STR_PAD_LEFT) }}</strong> 
                                sebagai berita transfer. --}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Promo Info --}}
        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-xl p-4 mb-6">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="text-sm text-yellow-800 dark:text-yellow-200 font-medium">
                        Informasi Promo
                    </p>
                    <p class="text-sm text-yellow-700 dark:text-yellow-300">
                        Hubungi admin untuk info promo atau potongan harga.
                    </p>
                    <a href="https://wa.me/6282154734819?text=Halo%20Admin%2C%20saya%20ingin%20bertanya%20tentang%20promo%20pendaftaran"
                       target="_blank"
                       class="inline-flex items-center gap-2 mt-2 text-sm text-primary font-semibold hover:underline">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Chat Admin Sekarang
                    </a>
                </div>
            </div>
        </div>

        {{-- Upload Bukti --}}
        <form action="{{ route('daftar.payment.upload', $registration->id) }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="space-y-4">
            @csrf

            <div>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300 block mb-1">
                    Upload Bukti Transfer <span class="text-red-500">*</span>
                </label>
                <input type="file" name="payment_proof" required accept="image/*,.pdf"
                    class="block w-full text-sm
                            file:mr-4 file:py-2.5 file:px-4
                            file:rounded-xl file:border-0
                            file:bg-primary file:text-white
                            hover:file:bg-azwara-medium
                            bg-white dark:bg-gray-800
                            border border-gray-300 dark:border-gray-700
                            rounded-xl cursor-pointer">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, PDF. Maks 5MB</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <button type="submit"
                    class="flex-1 py-3 rounded-xl font-bold text-white
                        bg-gradient-to-r from-primary to-azwara-medium
                        hover:shadow-xl hover:scale-[1.01] transition-all duration-300">
                    Kirim Bukti Pembayaran
                </button>
                
                <a href="{{ route('daftar.payment.nanti', $registration->id) }}"
                   class="flex-1 py-3 rounded-xl font-medium text-center
                        border-2 border-azwara-lighter dark:border-gray-700
                        text-gray-600 dark:text-gray-400
                        hover:bg-gray-100 dark:hover:bg-gray-800
                        transition-all duration-300">
                    Bayar Nanti
                </a>
            </div>
        </form>

        {{-- Link Cek Status --}}
        <p class="text-sm text-center text-gray-500 dark:text-gray-400 mt-6">
            <a href="{{ route('daftar.status.form') }}"
               class="text-primary font-semibold hover:underline">
                Cek Status Pendaftaran
            </a>
        </p>

    </div>
</div>

@endsection

@push('scripts')
<script>
// Switch between payment methods
function switchPayment(method) {
    // Update tabs
    const tabQris = document.getElementById('tab-qris');
    const tabTransfer = document.getElementById('tab-transfer');
    
    if (method === 'qris') {
        tabQris.className = 'py-3 rounded-xl font-medium text-center transition-all duration-300 bg-primary text-white shadow-md hover:shadow-lg';
        tabTransfer.className = 'py-3 rounded-xl font-medium text-center transition-all duration-300 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700';
        document.getElementById('panel-qris').classList.remove('hidden');
        document.getElementById('panel-transfer').classList.add('hidden');
    } else {
        tabTransfer.className = 'py-3 rounded-xl font-medium text-center transition-all duration-300 bg-primary text-white shadow-md hover:shadow-lg';
        tabQris.className = 'py-3 rounded-xl font-medium text-center transition-all duration-300 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700';
        document.getElementById('panel-transfer').classList.remove('hidden');
        document.getElementById('panel-qris').classList.add('hidden');
    }
}

// Copy rekening to clipboard
function copyRekening(rekening, bank) {
    navigator.clipboard.writeText(rekening).then(() => {
        // Show feedback
        const btn = event.target;
        const originalText = btn.textContent;
        btn.textContent = '✅ Tersalin!';
        btn.className = 'px-3 py-1.5 text-xs font-medium rounded-lg bg-green-100 text-green-700';
        
        setTimeout(() => {
            btn.textContent = originalText;
            btn.className = 'px-3 py-1.5 text-xs font-medium rounded-lg bg-primary/10 text-primary hover:bg-primary/20 transition';
        }, 2000);
    }).catch(() => {
        // Fallback for older browsers
        const input = document.createElement('input');
        input.value = rekening;
        document.body.appendChild(input);
        input.select();
        document.execCommand('copy');
        document.body.removeChild(input);
        
        alert('Nomor rekening ' + bank + ' ' + rekening + ' telah disalin!');
    });
}

// Set default tab based on URL parameter or default to qris
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const method = urlParams.get('method') || 'qris';
    switchPayment(method);
});
</script>
@endpush