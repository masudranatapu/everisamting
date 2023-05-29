<?php

namespace App\View\Components\Svg;

use Illuminate\View\Component;

class UserIcon extends Component
{
    public $height;
    public $width;
    public $stroke;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($height = 18, $width = 18, $stroke = '#00AAFF')
    {
        $this->height = $height;
        $this->width = $width;
        $this->stroke = $stroke;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.svg.user-icon');
    }
}
