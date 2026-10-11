<?php

namespace App\Livewire\Backend;

use App\Models\PatientReview;
use Livewire\Component;
use Livewire\WithPagination;

class ReviewsTable extends Component
{
    use WithPagination;

    private const PER_PAGE = 10;

    public string $search = '';

    public string $sort = 'newest';

    public string $status = 'all';

    public string $rating = 'all';

    public string $noticeType = 'success';

    public ?string $noticeMessage = null;

    public int $noticeKey = 0;

    public function mount(): void
    {
        if ($message = session('reviewNotice')) {
            $this->notify('success', $message);
        }
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingSort(): void
    {
        $this->resetPage();
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function updatingRating(): void
    {
        $this->resetPage();
    }

    public function paginationView(): string
    {
        return 'livewire::bootstrap';
    }

    public function toggle(int $reviewId): void
    {
        $review = PatientReview::query()->findOrFail($reviewId);
        $review->update(['is_published' => ! $review->is_published]);

        $this->notify('success', $review->is_published ? 'Review published.' : 'Review hidden.');
    }

    public function delete(int $reviewId): void
    {
        PatientReview::query()->findOrFail($reviewId)->delete();
        $this->notify('success', 'Review deleted.');
    }

    public function render()
    {
        $reviews = PatientReview::query()
            ->when($this->search !== '', function ($query) {
                $term = '%'.trim($this->search).'%';

                $query->where(function ($query) use ($term) {
                    $query->where('name', 'like', $term)
                        ->orWhere('body', 'like', $term);
                });
            })
            ->when($this->status === 'pending', fn ($query) => $query->where('is_published', false))
            ->when($this->status === 'published', fn ($query) => $query->where('is_published', true))
            ->when($this->rating !== 'all', fn ($query) => $query->where('rating', (int) $this->rating))
            ->orderBy('created_at', $this->sort === 'oldest' ? 'asc' : 'desc')
            ->paginate(self::PER_PAGE);

        return view('livewire.backend.reviews-table', [
            'reviews' => $reviews,
        ]);
    }

    private function notify(string $type, string $message): void
    {
        $this->noticeType = $type;
        $this->noticeMessage = $message;
        $this->noticeKey++;
    }
}
