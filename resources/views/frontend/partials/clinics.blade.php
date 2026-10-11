@php
    $clinics = config('clinic.clinics') ?? [];
@endphp

@if ($clinics === [])
    <div class="branch-empty">
        <h2>{{ __('site.common.coming_soon') }}</h2>
        <p>{{ __('site.contact.missing_clinics') }}</p>
    </div>
@else
    <div class="branch-list">
        @foreach ($clinics as $place)
            @include('frontend.partials.clinic-card', [
                'clinic' => $place,
                'branchId' => $place['id'] ?? 'branch-'.$loop->index,
            ])
        @endforeach
    </div>
@endif
