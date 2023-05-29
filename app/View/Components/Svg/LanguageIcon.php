<?php

namespace App\View\Components\Svg;

use Illuminate\View\Component;

class LanguageIcon extends Component
{
    public $dark_mode;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($dark_mode = false)
    {
        $this->dark_mode = $dark_mode;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.svg.language-icon');
    }
}
