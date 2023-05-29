<?php

namespace App\View\Components\frontend;

use Illuminate\View\Component;

class AdlistSearch extends Component
{

    public $categories;
    public $dark;
    public $totalAds;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($categories, $dark = false, $totalAds)
    {
        $this->categories = $categories;
        $this->dark = $dark;
        $this->totalAds = $totalAds;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.adlist-search');
    }
}
