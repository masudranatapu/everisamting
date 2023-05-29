<?php

namespace App\View\Components\frontend;

use Illuminate\View\Component;

class Counter extends Component
{
    public $totalAds;
    public $verifiedUser;
    public $proMember;
    public $country;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($totalAds, $verifiedUser, $proMember, $country)
    {
        $this->totalAds = $totalAds;
        $this->verifiedUser = $verifiedUser;
        $this->proMember = $proMember;
        $this->country = $country;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.counter');
    }
}
