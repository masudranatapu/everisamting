<?php

namespace App\View\Components\Svg;

use Illuminate\View\Component;

class LinkedinIcon extends Component
{
    public $fill, $width, $height;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($fill = '#ffffff', $width = 16, $height = 16)
    {
        $this->fill = $fill;
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.svg.linkedin-icon');
    }
}
