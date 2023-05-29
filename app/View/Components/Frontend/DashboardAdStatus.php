<?php

namespace App\View\Components\frontend;

use Illuminate\View\Component;

class DashboardAdStatus extends Component
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
        return view('components.frontend.dashboard-ad-status');
    }
}
