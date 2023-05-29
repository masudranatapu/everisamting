<?php

namespace App\View\Components\AdDetails;

use Illuminate\View\Component;

class AdInfo extends Component
{
    public $ad;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($ad)
    {
        $this->ad = $ad;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ad-details.ad-info');
    }
}
