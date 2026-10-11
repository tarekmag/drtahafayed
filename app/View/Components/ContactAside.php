<?php

namespace App\View\Components;

use App\Support\Content;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContactAside extends Component
{
    public ?string $phoneUrl;

    public ?string $whatsappUrl;

    public string $phone;

    public string $email;

    public function __construct()
    {
        $contact = Content::contact();
        $this->phoneUrl = Content::phoneUrl();
        $this->whatsappUrl = Content::whatsappUrl();
        $this->phone = $contact['phone'];
        $this->email = $contact['email'];
    }

    public function render(): View
    {
        return view('components.contact-aside');
    }
}
