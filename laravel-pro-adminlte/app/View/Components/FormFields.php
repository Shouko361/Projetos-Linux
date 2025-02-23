<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormFields extends Component
{
    public $type;
    public $name;
    public $value;
    public $label;
    public $div;
    public $options;
    public $isChecked;
    /**
     * Create a new component instance.
     */
    public function __construct($type, $name, $div, $label,$value = null, $options = [], $isChecked = [])
    {
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->div = $div;
        $this->label = $label;
        $this->options = $options;
        $this->isChecked = $isChecked;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-fields');
    }
}
