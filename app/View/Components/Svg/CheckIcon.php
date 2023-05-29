<?php

namespace App\View\Components\Svg;

use Illuminate\View\Component;

class CheckIcon extends Component
{
    public $width;
    public $height;
    public $stroke;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($width = '14', $height = '14', $stroke = 'currentColor')
    {
        $this->width = $width;
        $this->height = $height;
        $this->stroke = $stroke;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.svg.check-icon');
    }
}
