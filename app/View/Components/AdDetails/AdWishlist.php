<?php

namespace App\View\Components\AdDetails;

use Illuminate\View\Component;

class AdWishlist extends Component
{
    public $id, $price;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $price)
    {
        $this->id = $id;
        $this->price = $price;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ad-details.ad-wishlist');
    }
}
