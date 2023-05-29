<?php

namespace App\View\Components\Svg;

use Illuminate\View\Component;

class EyeIcon extends Component
{
    public $stroke;
    public $width;
    public $height;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($stroke = '#191F33', $width = '24', $height = '24')
    {
        $this->stroke = $stroke;
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
        return view('components.svg.eye-icon');
    }
}
