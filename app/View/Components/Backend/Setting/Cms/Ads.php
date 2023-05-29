<?php

namespace App\View\Components\Backend\Setting\Cms;

use Illuminate\View\Component;

class Ads extends Component
{
    public $cms;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($cms)
    {
        $this->cms = $cms;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.backend.setting.cms.ads');
    }
}
