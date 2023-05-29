<?php

namespace App\View\Components\AdDetails;

use Illuminate\View\Component;

class AdBadge extends Component
{
    public $featured, $customerid, $verifiedseller,$status;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($featured = false, $customerid, $verifiedseller,$status)
    {
        $this->featured = $featured;
        $this->customerid = $customerid;
        $this->verifiedseller = $verifiedseller;
        $this->status = $status;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ad-details.ad-badge');
    }
}
