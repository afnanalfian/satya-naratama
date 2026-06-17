<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ToggleSection extends Component
{
    /**
     * Judul section
     */
    public string $title;

    /**
     * Default open / closed
     */
    public bool $open;

    /**
     * Create a new component instance.
     */
    public function __construct(string $title, bool $open = false)
    {
        $this->title = $title;
        $this->open  = $open;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.toggle-section');
    }
}
