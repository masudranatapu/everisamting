<?php

namespace App\View\Components\Auth;

use Illuminate\View\Component;

class Content extends Component
{
    public $verifiedusers;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($verifiedusers = 0)
    {
        $this->verifiedusers = $verifiedusers;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.auth.content');
    }
}
