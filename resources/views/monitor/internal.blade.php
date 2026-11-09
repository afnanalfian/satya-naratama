<x-layouts.app :title="'Monitoring · '.$student->name">
    <x-page-header :title="$student->display_name" sub="Rapor lengkap presensi, tryout, jasmani & data fisik." :back="url()->previous()">
        <x-slot:actions>
            @role('admin')<a href="{{ $student->parent_monitor_url }}" target="_blank" class="btn-soft"><x-icon name="external" class="h-4 w-4"/> Versi orang tua</a>@endrole
            <a href="{{ route('attendance.student', $student) }}" class="btn-soft"><x-icon name="chart" class="h-4 w-4"/> Detail presensi</a>
            <a href="{{ route('physical.student', $student) }}" class="btn-ink"><x-icon name="scale" class="h-4 w-4"/> Data fisik</a>
        </x-slot:actions>
    </x-page-header>
    @include('monitor.partials.report')
</x-layouts.app>
