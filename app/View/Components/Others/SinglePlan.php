<?php

namespace App\View\Components\Others;

use Illuminate\View\Component;

class SinglePlan extends Component
{
    public $plan;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($plan)
    {
        $this->plan = $plan;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.others.single-plan');
    }
}
