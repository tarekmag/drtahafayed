<?php

namespace App\Livewire\Backend;

use App\Models\SeoPage;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class SeoForm extends Component
{
    /**
     * @var array<string, array{title: array{ar: string, en: string}, description: array{ar: string, en: string}}>
     */
    public array $entries = [];

    public string $noticeType = 'success';

    public ?string $noticeMessage = null;

    public int $noticeKey = 0;

    public function mount(): void
    {
        $pages = SeoPage::query()->get()->keyBy('page');

        foreach (SeoPage::PAGES as $page => $label) {
            $record = $pages->get($page);

            $this->entries[$page] = [
                'title' => $this->localePair($record?->meta_title),
                'description' => $this->localePair($record?->meta_description),
            ];
        }
    }

    public function save(): void
    {
        foreach ($this->entries as $page => $entry) {
            $this->entries[$page]['title'] = $this->localePair($entry['title'] ?? []);
            $this->entries[$page]['description'] = $this->localePair($entry['description'] ?? []);
        }

        try {
            $this->validate();
        } catch (ValidationException $exception) {
            $this->notify('danger', (string) $exception->validator->errors()->first());

            throw $exception;
        }

        foreach ($this->entries as $page => $entry) {
            SeoPage::query()->updateOrCreate(
                ['page' => $page],
                [
                    'meta_title' => $entry['title'],
                    'meta_description' => $entry['description'],
                ],
            );
        }

        $this->notify('success', 'SEO saved.');
    }

    public function render()
    {
        return view('livewire.backend.seo-form', [
            'pages' => SeoPage::PAGES,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'entries.*.title.ar' => ['required', 'string', 'max:180'],
            'entries.*.title.en' => ['required', 'string', 'max:180'],
            'entries.*.description.ar' => ['required', 'string', 'max:320'],
            'entries.*.description.en' => ['required', 'string', 'max:320'],
        ];
    }

    private function notify(string $type, string $message): void
    {
        $this->noticeType = $type;
        $this->noticeMessage = $message;
        $this->noticeKey++;
    }

    /**
     * @return array{ar: string, en: string}
     */
    private function localePair(mixed $value): array
    {
        return [
            'ar' => trim((string) (is_array($value) ? ($value['ar'] ?? '') : '')),
            'en' => trim((string) (is_array($value) ? ($value['en'] ?? '') : '')),
        ];
    }
}
