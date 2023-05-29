<?php

namespace App\View\Components\Svg;

use Illuminate\View\Component;

class FacebookIcon extends Component
{
    public $fill;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($fill = '#1877F2')
    {
        $this->fill = $fill;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.svg.facebook-icon');
    }
}
