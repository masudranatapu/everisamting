<?php

namespace App\View\Components\AdDetails;

use Illuminate\View\Component;

class AdCustomerInfo extends Component
{
    public $customer, $ad, $link;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($customer, $ad, $link)
    {
        $this->customer = $customer;
        $this->ad = $ad;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ad-details.ad-customer-info');
    }
}
