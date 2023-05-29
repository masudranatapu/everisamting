<?php

namespace App\View\Components\Svg;

use Illuminate\View\Component;

class TwitterIcon extends Component
{
    public $fill;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($fill = 'none')
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
        return view('components.svg.twitter-icon');
    }
}
