<?php

namespace App\Livewire\Backend;

use App\Models\Faq;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class FaqForm extends Component
{
    public ?int $faqId = null;

    /** @var array{ar: string, en: string} */
    public array $question = ['ar' => '', 'en' => ''];

    /** @var array{ar: string, en: string} */
    public array $answer = ['ar' => '', 'en' => ''];

    public int $sort = 0;

    public bool $isActive = true;

    public string $noticeType = 'success';

    public ?string $noticeMessage = null;

    public int $noticeKey = 0;

    public function mount(?Faq $faq = null): void
    {
        if ($faq) {
            $this->faqId = $faq->id;
            $this->question = $this->localePair($faq->question);
            $this->answer = $this->localePair($faq->answer);
            $this->sort = $faq->sort;
            $this->isActive = $faq->is_active;
        } else {
            $this->sort = (int) Faq::query()->max('sort') + 1;
        }

        if ($message = session('faqNotice')) {
            $this->notify('success', $message);
        }
    }

    public function save(): void
    {
        $this->question = $this->localePair($this->question);
        $this->answer = $this->localePair($this->answer);

        try {
            $this->validate();
        } catch (ValidationException $exception) {
            $this->notify('danger', (string) $exception->validator->errors()->first());

            throw $exception;
        }

        $faq = $this->faqId
            ? Faq::query()->findOrFail($this->faqId)
            : new Faq;

        $faq->fill([
            'question' => $this->question,
            'answer' => $this->answer,
            'sort' => $this->sort,
            'is_active' => $this->isActive,
        ])->save();

        if ($this->faqId === null) {
            session()->flash('faqNotice', 'FAQ saved.');
            $this->redirect(route('backend.faqs.edit', $faq));

            return;
        }

        $this->notify('success', 'FAQ saved.');
    }

    public function render()
    {
        return view('livewire.backend.faq-form');
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'question.ar' => ['required', 'string', 'max:255'],
            'question.en' => ['required', 'string', 'max:255'],
            'answer.ar' => ['required', 'string', 'max:2000'],
            'answer.en' => ['required', 'string', 'max:2000'],
            'sort' => ['required', 'integer', 'min:0'],
            'isActive' => ['boolean'],
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
