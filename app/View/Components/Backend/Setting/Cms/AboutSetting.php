<?php

namespace App\View\Components\Backend\Setting\Cms;

use Illuminate\View\Component;

class AboutSetting extends Component
{
    public $aboutcontent;
    public $aboutVideoThumb;
    public $aboutBackground;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($aboutcontent, $aboutVideoThumb, $aboutBackground)
    {
        $this->aboutcontent = $aboutcontent;
        $this->aboutVideoThumb = $aboutVideoThumb;
        $this->aboutBackground = $aboutBackground;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.backend.setting.cms.about-setting');
    }
}
