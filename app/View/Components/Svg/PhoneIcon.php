<?php

namespace App\View\Components\Svg;

use Illuminate\View\Component;

class PhoneIcon extends Component
{
    public $width;
    public $height;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($width = '24', $height = '24')
    {
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
        return view('components.svg.phone-icon');
    }
}
