<?php

namespace App\View\Components\frontend;

use Illuminate\View\Component;

class SingleLeftImageAd extends Component
{
    public $ad, $classList;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($ad, $classList)
    {
        $this->ad = $ad;
        $this->classList = $classList;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.single-left-image-ad');
    }
}
