@use('App\Support\Content')

@php
    $phone = Content::phoneUrl();
    $whatsapp = Content::whatsappUrl(__('site.contact.wa_intro'));
    $booking = Content::bookingUrl();
@endphp

@if ($phone || $whatsapp)
    <nav class="dock" aria-label="{{ __('site.nav.book') }}">
        @if ($phone)
            <a href="{{ $phone }}">
                <x-icon name="phone" />
                {{ __('site.common.call') }}
            </a>
        @endif
        @if ($whatsapp)
            <a href="{{ $whatsapp }}" target="_blank" rel="noopener noreferrer">
                <x-icon name="whatsapp" />
                {{ __('site.common.whatsapp') }}
            </a>
        @endif
        <a class="is-accent" href="{{ $booking }}">
            <x-icon name="calendar" />
            {{ __('site.common.book') }}
        </a>
    </nav>
@endif
