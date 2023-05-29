<?php

namespace App\View\Components\Alert;

use Illuminate\View\Component;

class Warning extends Component
{
    public $title, $selector,$text;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $selector,$text)
    {
        $this->title = $title;
        $this->selector = $selector;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert.warning');
    }
}
