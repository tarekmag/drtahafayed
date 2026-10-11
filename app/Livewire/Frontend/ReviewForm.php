<?php

namespace App\Livewire\Frontend;

use App\Models\PatientReview;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class ReviewForm extends Component
{
    public string $name = '';

    public ?int $rating = null;

    public string $body = '';

    public string $company = '';

    public bool $sent = false;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:80'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'body' => ['required', 'string', 'min:10', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('site.review.required'),
            'rating.required' => __('site.review.rating_required'),
            'rating.between' => __('site.review.rating_required'),
            'body.required' => __('site.review.required'),
            'body.min' => __('site.review.body_short'),
        ];
    }

    public function submit(): void
    {
        if ($this->company !== '') {
            $this->sent = true;

            return;
        }

        $this->validate();

        $key = 'patient-review:'.request()->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $this->addError('body', __('site.review.slow_down'));

            return;
        }

        PatientReview::query()->create([
            'name' => trim($this->name),
            'rating' => $this->rating,
            'body' => trim($this->body),
            'locale' => app()->getLocale(),
            'source' => 'website',
            'is_published' => false,
        ]);

        RateLimiter::hit($key, 3600);

        $this->reset('name', 'rating', 'body');
        $this->sent = true;
    }

    public function render()
    {
        return view('livewire.frontend.review-form', [
            'published' => PatientReview::query()
                ->where('is_published', true)
                ->where('source', 'website')
                ->latest()
                ->get()
                ->map(fn (PatientReview $review) => [
                    'rating' => $review->rating,
                    'name' => $review->name,
                    'place' => ['ar' => 'الموقع', 'en' => 'Website'],
                    'text' => $review->body,
                ]),
        ]);
    }
}
