<x-layouts.public title="Tutorial Penggunaan" description="Panduan langkah demi langkah memakai aplikasi Satya Naratama: pendaftaran, kelas, presensi QR, kuis, tryout, dan pembayaran.">
@php
$guides = [
    ['user-plus', 'Mendaftar bimbel', ['Buka menu <b>Daftar Sekarang</b> dan isi 4 langkah formulir.', 'Transfer biaya pendaftaran ke rekening yang tertera, lalu unggah bukti transfer.', 'Pantau di <b>Cek Status</b>. Setelah diverifikasi, kamu menerima email dan bisa masuk.']],
    ['login', 'Masuk & tetap login', ['Masuk dengan email & password saat mendaftar.', 'Kamu akan tetap login di perangkat tersebut sampai menekan tombol <b>Keluar</b>.', 'Lupa password? Gunakan menu <b>Lupa password</b> di halaman masuk.']],
    ['book', 'Mengikuti kelas', ['Buka <b>Kelas Saya</b> untuk melihat daftar pertemuan.', 'Saat tentor memulai kelas, tombol <b>Gabung Zoom</b> aktif.', 'Materi PDF, video rekaman, dan post-test tersedia di halaman pertemuan.']],
    ['qr', 'Presensi dengan QR', ['Buka <b>QR Presensi Saya</b> dan perbesar kecerahan layar.', 'Tunjukkan QR ke tentor untuk dipindai saat pertemuan.', 'Riwayat kehadiran bisa dilihat di dashboard.']],
    ['trophy', 'Kuis & Tryout', ['Buka menu <b>Tryout</b> atau <b>Kuis</b>, pilih yang aktif, tekan <b>Mulai</b>.', 'Jawaban tersimpan otomatis. Waktu dihitung server, jadi tetap aman jika koneksi terputus.', 'Setelah selesai, lihat nilai, pembahasan, dan peringkat.']],
    ['cart', 'Membeli paket', ['Buka <b>Beli Paket</b>, tambahkan kelas/tryout ke keranjang.', 'Checkout, gunakan voucher bila ada, lalu bayar via QRIS/transfer.', 'Unggah bukti; setelah disetujui admin, akses langsung terbuka.']],
    ['scale', 'Data fisik bulanan', ['Buka <b>Data Fisik Bulanan</b> setiap awal bulan.', 'Isi tinggi & berat badan serta riwayat penyakit/cedera bila ada.', 'Grafik perkembanganmu tampil otomatis.']],
    ['heart', 'Untuk orang tua', ['Minta <b>link pantauan</b> dari admin.', 'Buka link tanpa perlu login untuk melihat nilai, kehadiran, dan perkembangan fisik anak.', 'Link bersifat rahasia — jangan dibagikan ke orang lain.']],
];
@endphp
<section class="mx-auto max-w-6xl px-4 py-14 sm:px-6">
    <div class="max-w-2xl">
        <p class="eyebrow">Tutorial</p>
        <h1 class="mt-2 font-display text-4xl font-extrabold sm:text-5xl">Cara memakai aplikasi Satya Naratama</h1>
        <p class="mt-4 text-ink-500">Panduan singkat untuk siswa dan orang tua. Masih bingung? Hubungi admin via WhatsApp.</p>
    </div>
    <div class="mt-12 grid gap-5 md:grid-cols-2">
        @foreach($guides as $i => [$ic, $t, $steps])
            <div class="card p-6" x-data="{ o: {{ $i < 2 ? 'true' : 'false' }} }">
                <button @click="o=!o" class="flex w-full items-center gap-4 text-left">
                    <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl {{ $i % 2 ? 'bg-saffron-100 text-saffron-700' : 'bg-garnet-50 text-garnet-600' }}"><x-icon :name="$ic" class="h-6 w-6"/></span>
                    <span class="flex-1 font-display text-lg font-bold">{{ $t }}</span>
                    <x-icon name="chevron-down" class="h-5 w-5 text-ink-400 transition" ::class="o && 'rotate-180'"/>
                </button>
                <ol x-show="o" x-collapse class="mt-4 space-y-3 pl-1">
                    @foreach($steps as $n => $s)
                        <li class="flex gap-3 text-sm text-ink-600"><span class="grid h-6 w-6 shrink-0 place-items-center rounded-lg bg-ink-900 text-[11px] font-bold text-white">{{ $n + 1 }}</span><span>{!! $s !!}</span></li>
                    @endforeach
                </ol>
            </div>
        @endforeach
    </div>
    <div class="mt-12 flex flex-col items-center gap-3 rounded-3xl bg-ink-900 p-8 text-center text-white">
        <p class="font-display text-2xl font-bold">Butuh bantuan langsung?</p>
        <a href="https://wa.me/{{ config('satya.cs_wa') }}" target="_blank" class="btn-gold"><x-icon name="whatsapp" class="h-5 w-5"/> Chat admin</a>
    </div>
</section>
</x-layouts.public>
