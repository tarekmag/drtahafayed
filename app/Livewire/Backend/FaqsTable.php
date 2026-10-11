<?php

namespace App\Livewire\Backend;

use App\Models\Faq;
use Livewire\Component;
use Livewire\WithPagination;

class FaqsTable extends Component
{
    use WithPagination;

    private const PER_PAGE = 10;

    public string $search = '';

    public string $status = 'all';

    public string $noticeType = 'success';

    public ?string $noticeMessage = null;

    public int $noticeKey = 0;

    public function mount(): void
    {
        if ($message = session('faqNotice')) {
            $this->notify('success', $message);
        }
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function delete(int $faqId): void
    {
        Faq::query()->findOrFail($faqId)->delete();
        $this->notify('success', 'FAQ deleted.');
    }

    public function render()
    {
        $faqs = Faq::query()
            ->when($this->search !== '', function ($query) {
                $term = '%'.trim($this->search).'%';

                $query->where(function ($query) use ($term) {
                    $query->where('question->ar', 'like', $term)
                        ->orWhere('question->en', 'like', $term)
                        ->orWhere('answer->ar', 'like', $term)
                        ->orWhere('answer->en', 'like', $term);
                });
            })
            ->when($this->status === 'active', fn ($query) => $query->where('is_active', true))
            ->when($this->status === 'hidden', fn ($query) => $query->where('is_active', false))
            ->orderBy('sort')
            ->orderBy('id')
            ->paginate(self::PER_PAGE);

        return view('livewire.backend.faqs-table', [
            'faqs' => $faqs,
        ]);
    }

    public function paginationView(): string
    {
        return 'livewire::bootstrap';
    }

    private function notify(string $type, string $message): void
    {
        $this->noticeType = $type;
        $this->noticeMessage = $message;
        $this->noticeKey++;
    }
}
