<div>
    @if ($published->isNotEmpty())
        <div class="review-wall">
            @foreach ($published as $review)
                <x-review-card :review="$review" />
            @endforeach
        </div>
    @endif

    <form class="review-form" wire:submit="submit" novalidate>
        <h2>{{ __('site.review.form_title') }}</h2>
        <p>{{ __('site.review.form_text') }}</p>

        @if ($sent)
            <p class="form-notice" role="status" tabindex="-1">{{ __('site.review.notice') }}</p>
        @else
            <label class="hp-field" aria-hidden="true">
                <span>Company</span>
                <input type="text" wire:model="company" tabindex="-1" autocomplete="off">
            </label>

            <label class="form-field @error('name') is-invalid @enderror">
                <span>{{ __('site.review.name') }} *</span>
                <input type="text" wire:model="name" autocomplete="name" maxlength="80" required>
                @error('name')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </label>

            <fieldset class="star-picker @error('rating') is-invalid @enderror">
                <legend>{{ __('site.review.rating') }} *</legend>
                <div class="star-picker-stars">
                    @foreach ([5, 4, 3, 2, 1] as $star)
                        <label class="star-picker-star">
                            <input type="radio" value="{{ $star }}" wire:model.live="rating" aria-label="{{ __('site.common.rating', ['count' => $star]) }}">
                            <x-icon name="star" />
                        </label>
                    @endforeach
                </div>
                @error('rating')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </fieldset>

            <label class="form-field @error('body') is-invalid @enderror">
                <span>{{ __('site.review.body') }} *</span>
                <textarea wire:model="body" rows="5" maxlength="1000" required placeholder="{{ __('site.review.body_hint') }}"></textarea>
                @error('body')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </label>

            <div class="form-actions">
                <button class="btn btn-primary" type="submit">{{ __('site.review.submit') }}</button>
            </div>
        @endif
    </form>
</div>
