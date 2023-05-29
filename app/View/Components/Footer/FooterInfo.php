<?php

namespace App\View\Components\Footer;

use Illuminate\View\Component;

class FooterInfo extends Component
{
    public $logotype;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($logotype)
    {
        $this->logotype = $logotype;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.footer.footer-info');
    }
}
