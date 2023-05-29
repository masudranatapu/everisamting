<?php

namespace App\View\Components\Svg;

use Illuminate\View\Component;

class HeartIcon extends Component
{
    public $fill;
    public $stroke;
    public $strokeWidth;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($fill = 'none', $stroke = '#00AAFF', $strokeWidth = '1.6')
    {
        $this->fill = $fill;
        $this->stroke = $stroke;
        $this->strokeWidth = $strokeWidth;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.svg.heart-icon');
    }
}
