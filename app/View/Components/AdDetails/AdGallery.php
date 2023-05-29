<?php

namespace App\View\Components\AdDetails;

use Illuminate\View\Component;

class AdGallery extends Component
{
    public $galleries, $thumbnail, $slug;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($galleries, $thumbnail, $slug)
    {
        $this->galleries = $galleries;
        $this->thumbnail = $thumbnail;
        $this->slug = $slug;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ad-details.ad-gallery');
    }
}
