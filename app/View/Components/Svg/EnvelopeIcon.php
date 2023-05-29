<?php

namespace App\View\Components\Svg;

use Illuminate\View\Component;

class EnvelopeIcon extends Component
{
    public $stroke;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($stroke = '#00AAFF')
    {
        $this->stroke = $stroke;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.svg.envelope-icon');
    }
}
