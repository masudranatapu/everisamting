<?php

namespace App\View\Components\Backend\Setting\Cms;

use Illuminate\View\Component;

class TermsConditionSetting extends Component
{
    public $terms;
    public $termsBackground;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($terms, $termsBackground)
    {
        $this->terms = $terms;
        $this->termsBackground = $termsBackground;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.backend.setting.cms.terms-condition-setting');
    }
}
