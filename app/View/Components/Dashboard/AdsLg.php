<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class AdsLg extends Component
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
        return view('components.dashboard.ads-lg');
    }
}
