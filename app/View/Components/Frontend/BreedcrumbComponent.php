<?php

namespace App\View\Components\frontend;

use Illuminate\View\Component;

class BreedcrumbComponent extends Component
{
    public $background;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($background)
    {
        $this->background = $background;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.breedcrumb-component');
    }
}
