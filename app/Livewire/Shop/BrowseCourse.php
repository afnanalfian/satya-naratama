<?php

namespace App\Livewire\Shop;

use App\Livewire\Concerns\Toasts;
use App\Livewire\Shop\Concerns\AddsToCart;
use App\Models\Course;
use App\Models\Meeting;
use Livewire\Component;

class BrowseCourse extends Component
{
    use AddsToCart, Toasts;

    public Course $course;

    public function mount(Course $course)
    {
        $this->course = $course->load('coursePackage.product', 'teachers.user:id,name,avatar');
    }

    public function render()
    {
        $user = auth()->user();
        $ownedCourse = in_array($this->course->id, $user->ownedCourseIds());
        $ownedMeetingIds = $user->ownedMeetingIds();
        [$cartProductIds, $courseIdsInCart] = $this->cartState();

        $meetings = $ownedCourse ? collect() : Meeting::with('productRelation')
            ->where('course_id', $this->course->id)
            ->when($ownedMeetingIds, fn ($q) => $q->whereNotIn('id', $ownedMeetingIds))
            ->orderBy('scheduled_at')->get();

        return view('livewire.shop.browse-course', [
            'meetings' => $meetings, 'ownedCourse' => $ownedCourse, 'cartProductIds' => $cartProductIds,
            'packageInCart' => in_array($this->course->id, $courseIdsInCart),
            'range' => price_range_meeting($this->course),
            'packagePrice' => rescue(fn () => price_for_course_package($this->course), 0, false),
        ])->title('Beli · '.$this->course->name);
    }
}
