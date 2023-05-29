<?php

namespace App\View\Components\frontend\location;

use Illuminate\View\Component;

class SinglePopularLocation extends Component
{
    public $city;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($city)
    {
        $this->city = $city;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.location.single-popular-location');
    }
}
