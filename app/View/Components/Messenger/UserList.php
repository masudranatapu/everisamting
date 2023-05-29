<?php

namespace App\View\Components\Messenger;

use Illuminate\View\Component;

class UserList extends Component
{
    public $user, $unread;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user, $unread = 0)
    {
        $this->user = $user;
        $this->unread = $unread;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.messenger.user-list');
    }
}
