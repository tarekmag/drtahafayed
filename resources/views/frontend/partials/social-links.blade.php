@php
    $clinic = $clinic ?? config('clinic');
    $socials = [
        'facebook' => __('site.nav.facebook'),
        'youtube' => __('site.nav.youtube'),
        'tiktok' => __('site.nav.tiktok'),
    ];
@endphp
@foreach ($socials as $key => $label)
    @if (! empty($clinic[$key]))
        <a class="social-link {{ $linkClass ?? '' }}" href="{{ $clinic[$key] }}" target="_blank" rel="noopener noreferrer">
            <span class="social-icon" aria-hidden="true">
                @switch($key)
                    @case('facebook')
                        <svg viewBox="0 0 24 24"><path fill="currentColor" d="M14.2 8.5V6.7c0-.8.4-1.2 1.3-1.2H17V3h-2.2C12 3 10.8 4.4 10.8 6.6v1.9H9v2.6h1.8V21h3.2v-9.9h2.2l.4-2.6h-2.4z"/></svg>
                        @break
                    @case('youtube')
                        <svg viewBox="0 0 24 24"><path fill="currentColor" d="M23 12.2s0-3.2-.4-4.6c-.2-.9-.9-1.6-1.8-1.8C19.2 5.4 12 5.4 12 5.4s-7.2 0-8.8.4c-.9.2-1.6.9-1.8 1.8C1 9 1 12.2 1 12.2s0 3.2.4 4.6c.2.9.9 1.6 1.8 1.8 1.6.4 8.8.4 8.8.4s7.2 0 8.8-.4c.9-.2 1.6-.9 1.8-1.8.4-1.4.4-4.6.4-4.6zM9.8 15.5V8.9l6.2 3.3-6.2 3.3z"/></svg>
                        @break
                    @case('tiktok')
                        <svg viewBox="0 0 24 24"><path fill="currentColor" d="M19.6 6.7a4.8 4.8 0 0 1-3.8-4.2V2h-3.4v13.7a2.9 2.9 0 0 1-2.9 2.5 2.9 2.9 0 0 1-2.9-2.9 2.9 2.9 0 0 1 2.9-2.9c.3 0 .5 0 .8.1V9.1a6.4 6.4 0 0 0-.8 0A6.3 6.3 0 0 0 3.2 15.4 6.3 6.3 0 0 0 9.5 21.8a6.3 6.3 0 0 0 6.3-6.4V8.8a8.2 8.2 0 0 0 4.8 1.5V6.8a4.8 4.8 0 0 1-1-.1z"/></svg>
                        @break
                @endswitch
            </span>
            {{ $label }}
        </a>
    @endif
@endforeach
