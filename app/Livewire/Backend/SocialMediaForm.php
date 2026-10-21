<?php

namespace App\Livewire\Backend;

use App\Models\SocialProfile;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class SocialMediaForm extends Component
{
    public ?string $facebook = null;

    public ?string $instagram = null;

    public ?string $vezeeta = null;

    public ?string $clinido = null;

    public ?string $youtube = null;

    public ?string $tiktok = null;

    public string $noticeType = 'success';

    public ?string $noticeMessage = null;

    public int $noticeKey = 0;

    public function mount(): void
    {
        $profile = SocialProfile::query()->firstOrFail();

        $this->facebook = $profile->facebook;
        $this->instagram = $profile->instagram;
        $this->vezeeta = $profile->vezeeta;
        $this->clinido = $profile->clinido;
        $this->youtube = $profile->youtube;
        $this->tiktok = $profile->tiktok;
    }

    public function save(): void
    {
        foreach (['facebook', 'instagram', 'vezeeta', 'clinido', 'youtube', 'tiktok'] as $field) {
            $this->{$field} = trim((string) $this->{$field}) ?: null;
        }

        try {
            $this->validate();
        } catch (ValidationException $exception) {
            $this->notify('danger', (string) $exception->validator->errors()->first());

            throw $exception;
        }

        SocialProfile::query()->firstOrFail()->update([
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'vezeeta' => $this->vezeeta,
            'clinido' => $this->clinido,
            'youtube' => $this->youtube,
            'tiktok' => $this->tiktok,
        ]);

        $this->notify('success', 'Social links saved.');
    }

    public function render()
    {
        return view('livewire.backend.social-media-form');
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        $url = ['nullable', 'url:https', 'max:500'];

        return [
            'facebook' => $url,
            'instagram' => $url,
            'vezeeta' => $url,
            'clinido' => $url,
            'youtube' => $url,
            'tiktok' => $url,
        ];
    }

    private function notify(string $type, string $message): void
    {
        $this->noticeType = $type;
        $this->noticeMessage = $message;
        $this->noticeKey++;
    }
}
