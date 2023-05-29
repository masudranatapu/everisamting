<?php

namespace App\View\Components\Svg;

use Illuminate\View\Component;

class MessageIcon extends Component
{
    public $width;
    public $height;
    public $stroke;
    public $strokeWidth;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($width = '18', $height = '18', $stroke = '#00AAFF', $strokeWidth = '1.3')
    {
        $this->width = $width;
        $this->height = $height;
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
        return view('components.svg.message-icon');
    }
}
