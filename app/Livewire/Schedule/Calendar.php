<?php

namespace App\Livewire\Schedule;

use App\Models\Exam;
use App\Models\Meeting;
use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Title('Jadwal')]
class Calendar extends Component
{
    #[Url] public int $month = 0;
    #[Url] public int $year = 0;
    public ?string $selected = null;

    public function mount()
    {
        $this->month = $this->month ?: now()->month;
        $this->year = $this->year ?: now()->year;
        $this->selected = now()->month === $this->month && now()->year === $this->year ? now()->toDateString() : null;
    }

    public function shift(int $delta)
    {
        $d = Carbon::create($this->year, $this->month, 1)->addMonths($delta);
        [$this->month, $this->year, $this->selected] = [$d->month, $d->year, null];
    }

    public function today()
    {
        [$this->month, $this->year, $this->selected] = [now()->month, now()->year, now()->toDateString()];
    }

    public function pick(string $date)
    {
        $this->selected = $date;
    }

    public function render()
    {
        $start = Carbon::create($this->year, $this->month, 1)->startOfMonth();
        $end = $start->copy()->endOfMonth();

        $meetings = Meeting::with('course:id,name,type')->whereBetween('scheduled_at', [$start, $end])->get()->map(fn ($m) => [
            'type' => $m->course?->type === 'jasmani' ? 'jasmani' : 'meeting', 'title' => $m->title, 'sub' => $m->course?->name,
            'time' => $m->scheduled_at, 'date_key' => $m->scheduled_at->format('Y-m-d'), 'url' => route('meeting.show', $m), 'status' => $m->status,
        ]);
        $exams = Exam::whereIn('type', ['tryout', 'quiz'])->whereNotNull('exam_date')->whereBetween('exam_date', [$start, $end])->get()->map(fn ($e) => [
            'type' => $e->type, 'title' => $e->title ?? 'Tryout', 'sub' => strtoupper((string) $e->test_type),
            'time' => Carbon::parse($e->exam_date), 'date_key' => Carbon::parse($e->exam_date)->format('Y-m-d'), 'url' => route('exams.show', $e), 'status' => $e->status,
        ]);
        $items = $meetings->concat($exams)->sortBy('time')->groupBy('date_key');

        $gridStart = $start->copy()->startOfWeek(Carbon::MONDAY);
        $gridEnd = $end->copy()->endOfWeek(Carbon::SUNDAY);
        $days = [];
        for ($d = $gridStart->copy(); $d->lte($gridEnd); $d->addDay()) {
            $days[] = $d->copy();
        }

        return view('livewire.schedule.calendar', [
            'items' => $items, 'days' => $days, 'start' => $start,
            'agenda' => $this->selected ? ($items[$this->selected] ?? collect()) : $items->flatten(1),
        ]);
    }
}
