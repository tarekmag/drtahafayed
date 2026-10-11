<?php

namespace App\Livewire\Frontend;

use App\Mail\ContactInquiryMail;
use App\Models\Contact;
use App\Support\Content;
use App\Support\LocaleText;
use App\View\Presenters\ServicePresenter;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';

    public string $phone = '';

    public string $branch = '';

    public string $service = '';

    public string $message = '';

    public bool $sent = false;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:20', function (string $attribute, mixed $value, \Closure $fail): void {
                if (preg_match_all('/\d/', (string) $value) < 8) {
                    $fail(__('site.contact.invalid_phone'));
                }
            }],
            'branch' => ['nullable', 'string', 'max:160'],
            'service' => ['nullable', 'string', 'max:160'],
            'message' => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('site.contact.required'),
            'phone.required' => __('site.contact.required'),
        ];
    }

    public function submit(): void
    {
        $this->validate();

        $contact = Contact::query()->create([
            'name' => $this->name,
            'phone' => $this->phone,
            'branch' => $this->branch !== '' ? $this->branch : null,
            'service' => $this->service !== '' ? $this->service : null,
            'message' => $this->message !== '' ? $this->message : null,
        ]);

        $inbox = Content::contact()['email'];

        if ($inbox !== '') {
            Mail::to($inbox)->send(new ContactInquiryMail($contact));
        }

        $this->reset('name', 'phone', 'branch', 'service', 'message');
        $this->sent = true;
    }

    public function sendWhatsApp(): void
    {
        try {
            $this->validate();
        } catch (ValidationException $exception) {
            $this->js('window.__waPending?.close(); window.__waPending = null;');
            throw $exception;
        }

        $url = Content::whatsappUrl($this->whatsappText());

        if (! $url) {
            $this->js('window.__waPending?.close(); window.__waPending = null;');

            return;
        }

        $encoded = json_encode($url);
        $this->js('if (window.__waPending) { window.__waPending.location = '.$encoded.'; window.__waPending = null; } else { window.open('.$encoded.', "_blank", "noopener"); }');
    }

    public function render()
    {
        return view('livewire.frontend.contact-form', [
            'branches' => Content::clinics()
                ->map(fn (array $clinic) => LocaleText::get($clinic['name'] ?? ''))
                ->filter()
                ->values()
                ->all(),
            'services' => Content::services()
                ->map(fn (array $service) => ServicePresenter::make($service)->title)
                ->filter()
                ->values()
                ->all(),
            'whatsapp' => (bool) Content::whatsappUrl(),
        ]);
    }

    private function whatsappText(): string
    {
        $lines = array_filter([
            __('site.contact.wa_intro'),
            $this->name !== '' ? __('site.contact.name').': '.$this->name : '',
            $this->phone !== '' ? __('site.contact.phone').': '.$this->phone : '',
            $this->branch !== '' ? __('site.contact.branch').': '.$this->branch : '',
            $this->service !== '' ? __('site.contact.service').': '.$this->service : '',
            $this->message,
        ]);

        return implode("\n", $lines);
    }
}
