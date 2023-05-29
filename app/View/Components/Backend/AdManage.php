<?php

namespace App\View\Components\Backend;

use Illuminate\View\Component;

class AdManage extends Component
{
    public $ads, $showCustomer,$showCity, $showCategory;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($ads, $showCustomer = true, $showCity = true, $showCategory = true)
    {
        $this->ads = $ads;
        $this->showCustomer = $showCustomer;
        $this->showCity = $showCity;
        $this->showCategory = $showCategory;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.backend.ad-manage');
    }
}
