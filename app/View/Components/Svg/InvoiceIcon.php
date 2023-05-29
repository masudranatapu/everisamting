<?php

namespace App\View\Components\Svg;

use Illuminate\View\Component;

class InvoiceIcon extends Component
{
    public $width;
    public $height;
    public $stroke;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($width = '32', $height = '32', $stroke = '#00AAFF')
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
        return view('components.svg.invoice-icon');
    }
}
