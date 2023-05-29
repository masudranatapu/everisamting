<?php

namespace App\View\Components\AdDetails;

use Illuminate\View\Component;

class AdRelatedItem extends Component
{
    public $lists;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($lists)
    {
        $this->lists = $lists;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ad-details.ad-related-item');
    }
}
