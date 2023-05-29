<?php

namespace App\View\Components\Backend\Setting\Website;

use Illuminate\View\Component;

class BasicSetting extends Component
{
    public $setting;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($setting)
    {
        $this->setting = $setting;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.backend.setting.website.basic-setting');
    }
}
