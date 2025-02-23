<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Component;

class ContentHeader extends Component
{
    public string $title;
    /**
     * Create a new component instance.
     */
    public function __construct($title)
    {
        $this->title = Blade::render($title);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.content-header');
    }
}
