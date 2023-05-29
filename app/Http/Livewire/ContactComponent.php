<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\Contact\Entities\Contact;

class ContactComponent extends Component
{
    public $name, $email, $subject, $message, $success;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'subject' => 'required',
        'message' => 'required|min:10',
    ];

    public function submitContact()
    {
        $this->validate();
        Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        $this->reset();
        $this->success = "Message Send Successfully";
    }

    public function render()
    {
        return view('livewire.contact-component');
    }
}
