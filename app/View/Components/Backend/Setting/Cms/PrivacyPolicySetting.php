<?php

namespace App\View\Components\Backend\Setting\Cms;

use Illuminate\View\Component;

class PrivacyPolicySetting extends Component
{
    public $privacy;
    public $privacyBackground;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($privacy, $privacyBackground)
    {
        $this->privacy = $privacy;
        $this->privacyBackground = $privacyBackground;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.backend.setting.cms.privacy-policy-setting');
    }
}
