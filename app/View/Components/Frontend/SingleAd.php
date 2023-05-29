<?php

namespace App\View\Components\frontend;

use Illuminate\View\Component;

class SingleAd extends Component
{
    public $ad;
    public $className;
    public $adfields;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($ad, $className, $adfields)
    {
        $this->ad = $ad;
        $this->className = $className;
        $this->adfields = $adfields;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.single-ad');
    }
}
