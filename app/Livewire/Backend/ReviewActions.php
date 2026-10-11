<?php

namespace App\Livewire\Backend;

use App\Models\PatientReview;
use Livewire\Component;

class ReviewActions extends Component
{
    public int $reviewId;

    public bool $isPublished = false;

    public string $noticeType = 'success';

    public ?string $noticeMessage = null;

    public int $noticeKey = 0;

    public function mount(PatientReview $patientReview): void
    {
        $this->reviewId = $patientReview->id;
        $this->isPublished = $patientReview->is_published;

        if ($message = session('reviewNotice')) {
            $this->notify('success', $message);
        }
    }

    public function toggle(): void
    {
        $review = PatientReview::query()->findOrFail($this->reviewId);
        $review->update(['is_published' => ! $review->is_published]);
        $this->isPublished = $review->is_published;
        $this->notify('success', $review->is_published ? 'Review published.' : 'Review hidden.');
    }

    public function delete(): void
    {
        PatientReview::query()->findOrFail($this->reviewId)->delete();
        session()->flash('reviewNotice', 'Review deleted.');
        $this->redirect(route('backend.reviews.index'));
    }

    public function render()
    {
        return view('livewire.backend.review-actions');
    }

    private function notify(string $type, string $message): void
    {
        $this->noticeType = $type;
        $this->noticeMessage = $message;
        $this->noticeKey++;
    }
}
