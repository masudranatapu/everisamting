<?php

namespace App\View\Components\Footer;

use Illuminate\View\Component;

class FooterTop extends Component
{
    public $bg;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($bg = 'footer--dark')
    {
        $this->bg = $bg;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.footer.footer-top');
    }
}
