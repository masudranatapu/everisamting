<?php

namespace App\View\Components\Svg;

use Illuminate\View\Component;

class ListIcon extends Component
{
    public $width;
    public $height;
    public $stroke;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($width = '40', $height = '40', $stroke = '#00AAFF')
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
        return view('components.svg.list-icon');
    }
}
