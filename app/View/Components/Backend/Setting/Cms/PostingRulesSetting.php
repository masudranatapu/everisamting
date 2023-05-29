<?php

namespace App\View\Components\Backend\Setting\Cms;

use Illuminate\View\Component;

class PostingRulesSetting extends Component
{
    public $rules;
    public $postingRulesBackground;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($rules, $postingRulesBackground)
    {
        $this->rules = $rules;
        $this->postingRulesBackground = $postingRulesBackground;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.backend.setting.cms.posting-rules-setting');
    }
}
