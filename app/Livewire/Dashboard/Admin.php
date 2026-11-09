<?php

namespace App\Livewire\Dashboard;

use App\Models\Course;
use App\Models\Exam;
use App\Models\Meeting;
use App\Models\Order;
use App\Models\StudentRegistration;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Title('Dashboard Admin')]
class Admin extends Component
{
    #[Url(as: 'week')]
    public int $weekOffset = 0;

    public function prevWeek() { $this->weekOffset--; $this->pushChart(); }
    public function nextWeek() { $this->weekOffset++; $this->pushChart(); }
    public function thisWeek() { $this->weekOffset = 0; $this->pushChart(); }

    protected function range(): array
    {
        $start = Carbon::now()->startOfWeek(Carbon::MONDAY)->addWeeks($this->weekOffset);
        return [$start, $start->copy()->endOfWeek(Carbon::SUNDAY)];
    }

    protected function days(): array
    {
        [$start, $end] = $this->range();
        $sales = Order::where('status', 'verified')
            ->whereBetween('created_at', [$start, $end])
            ->get(['created_at', 'total_amount'])
            ->groupBy(fn ($o) => $o->created_at->toDateString())
            ->map(fn ($g) => (float) $g->sum('total_amount'));

        $days = [];
        for ($d = $start->copy(), $i = 0; $i < 7; $i++, $d->addDay()) {
            $days[] = ['day' => $d->translatedFormat('D'), 'date' => $d->translatedFormat('d M'), 'total' => $sales[$d->toDateString()] ?? 0];
        }
        return $days;
    }

    protected function pushChart(): void
    {
        $days = $this->days();
        $this->dispatch('sales-updated', labels: array_map(fn ($d) => $d['day'].' '.$d['date'], $days), data: array_column($days, 'total'));
    }

    public function render()
    {
        [$start, $end] = $this->range();
        $days = $this->days();

        $meetingsThisWeek = Meeting::with('course')
            ->whereBetween('scheduled_at', [$start, $end])
            ->get()
            ->sortBy(fn ($m) => [['live' => 1, 'upcoming' => 2][$m->status] ?? 3, $m->scheduled_at])
            ->take(10)->values();

        $pendingOrders = Order::with('user')->where('status', 'paid')->latest()->limit(8)->get();

        return view('livewire.dashboard.admin', [
            'stats' => [
                'total_siswa' => User::role('siswa')->count(),
                'active_siswa' => User::role('siswa')->where('is_active', true)->count(),
                'total_tentor' => User::role('tentor')->count(),
                'total_course' => Course::count(),
                'total_meeting' => Meeting::count(),
                'done_meeting' => Meeting::where('status', 'done')->count(),
                'pending_orders' => Order::where('status', 'paid')->count(),
                'pending_regs' => StudentRegistration::awaitingVerification()->count(),
                'active_exams' => Exam::where('status', 'active')->count(),
                'month_income' => (float) Order::where('status', 'verified')->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->sum('total_amount'),
            ],
            'days' => $days,
            'weekTotal' => array_sum(array_column($days, 'total')),
            'weekLabel' => $start->translatedFormat('d M').' – '.$end->translatedFormat('d M Y'),
            'meetingsThisWeek' => $meetingsThisWeek,
            'pendingOrders' => $pendingOrders,
        ]);
    }
}
