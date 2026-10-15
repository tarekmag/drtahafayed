<?php

namespace App\Livewire\Backend;

use App\Models\ClinicContact;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ContactDataForm extends Component
{
    public string $phone = '';

    public string $phoneSecondary = '';

    public string $whatsapp = '';

    public string $email = '';

    public ?string $bookingUrl = null;

    public string $noticeType = 'success';

    public ?string $noticeMessage = null;

    public int $noticeKey = 0;

    public function mount(): void
    {
        $contact = ClinicContact::query()->firstOrFail();

        $this->phone = (string) $contact->phone;
        $this->phoneSecondary = (string) $contact->phone_secondary;
        $this->whatsapp = (string) $contact->whatsapp;
        $this->email = (string) $contact->email;
        $this->bookingUrl = $contact->booking_url;
    }

    public function save(): void
    {
        $this->phone = trim($this->phone);
        $this->phoneSecondary = trim($this->phoneSecondary);
        $this->whatsapp = preg_replace('/\D+/', '', $this->whatsapp) ?? '';
        $this->email = trim($this->email);
        $this->bookingUrl = trim((string) $this->bookingUrl) ?: null;

        try {
            $this->validate();
        } catch (ValidationException $exception) {
            $this->notify('danger', (string) $exception->validator->errors()->first());

            throw $exception;
        }

        ClinicContact::query()->firstOrFail()->update([
            'phone' => $this->phone,
            'phone_secondary' => $this->phoneSecondary !== '' ? $this->phoneSecondary : null,
            'whatsapp' => $this->whatsapp,
            'email' => $this->email,
            'booking_url' => $this->bookingUrl,
        ]);

        $this->notify('success', 'Contacts saved.');
    }

    public function render()
    {
        return view('livewire.backend.contact-data-form');
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'phone' => ['required', 'string', 'max:30'],
            'phoneSecondary' => ['nullable', 'string', 'max:30'],
            'whatsapp' => ['required', 'regex:/^[0-9]{8,20}$/'],
            'email' => ['required', 'email', 'max:255'],
            'bookingUrl' => ['nullable', 'url', 'max:500'],
        ];
    }

    private function notify(string $type, string $message): void
    {
        $this->noticeType = $type;
        $this->noticeMessage = $message;
        $this->noticeKey++;
    }
}
