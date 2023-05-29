<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class SidebarList extends Component
{
    public $linkActive, $route, $icon;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($linkActive, $route, $icon)
    {
        $this->linkActive = $linkActive;
        $this->route = $route;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.admin.sidebar-list');
    }
}
