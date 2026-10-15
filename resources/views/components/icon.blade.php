@props(['name'])

<svg {{ $attributes->class(['icon', 'icon-'.$name]) }} viewBox="0 0 24 24" aria-hidden="true" focusable="false" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
    @switch($name)
        @case('general')
            <path d="M12 3.5 4.5 6.4v5.2c0 4.4 3.1 7.9 7.5 8.9 4.4-1 7.5-4.5 7.5-8.9V6.4L12 3.5z"/>
            <path d="M12 8.6v6.2M8.9 11.7h6.2"/>
            @break
        @case('oncology')
            <circle cx="12" cy="12" r="8"/>
            <circle cx="12" cy="12" r="4.2"/>
            <circle cx="12" cy="12" r="1.1" fill="currentColor" stroke="none"/>
            @break
        @case('endocrine')
            <path d="M12 3.2s5.4 5.3 5.4 9a5.4 5.4 0 0 1-10.8 0c0-3.7 5.4-9 5.4-9z"/>
            <path d="M9.6 13.4a2.6 2.6 0 0 0 2.4 2.1"/>
            @break
        @case('thyroid')
            <path d="M12 6.2c-1.2-1.6-3.3-2.1-4.8-1-2 1.4-2.6 5-1.6 8.1.9 2.8 3 4.6 4.6 4.2.9-.2 1.4-1 1.8-2.1.4 1.1.9 1.9 1.8 2.1 1.6.4 3.7-1.4 4.6-4.2 1-3.1.4-6.7-1.6-8.1-1.5-1.1-3.6-.6-4.8 1z"/>
            <path d="M12 6.2v9"/>
            @break
        @case('parathyroid')
            <rect x="4.5" y="4.5" width="15" height="15" rx="5"/>
            <circle cx="9.2" cy="9.4" r="1.15" fill="currentColor" stroke="none"/>
            <circle cx="14.8" cy="9.4" r="1.15" fill="currentColor" stroke="none"/>
            <circle cx="9.2" cy="14.6" r="1.15" fill="currentColor" stroke="none"/>
            <circle cx="14.8" cy="14.6" r="1.15" fill="currentColor" stroke="none"/>
            @break
        @case('laparoscopy')
            <circle cx="9.5" cy="9.5" r="5.5"/>
            <path d="m13.5 13.5 6.5 6.5"/>
            <circle cx="9.5" cy="9.5" r="1.6"/>
            @break
        @case('phone')
            <path d="M6.6 3.8h2.6l1.4 4-1.9 1.3a11.4 11.4 0 0 0 6.2 6.2l1.3-1.9 4 1.4v2.6a1.9 1.9 0 0 1-2 1.9A15.6 15.6 0 0 1 4.7 5.8a1.9 1.9 0 0 1 1.9-2z"/>
            @break
        @case('whatsapp')
            <path d="M4.2 19.8 5.3 16A8.2 8.2 0 1 1 8.4 19z"/>
            <path d="M9.1 8.6c.2-.5.4-.5.7-.5h.5c.2 0 .4.1.5.4l.7 1.6c.1.2 0 .4-.1.6l-.5.6c.6 1.1 1.5 2 2.6 2.6l.6-.5c.2-.1.4-.2.6-.1l1.6.7c.3.1.4.3.4.5v.5c0 .3 0 .5-.5.7-.6.3-1.5.5-2.6 0a8.3 8.3 0 0 1-4.1-4.1c-.5-1.1-.3-2 0-2.5z" fill="currentColor" stroke="none"/>
            @break
        @case('calendar')
            <rect x="3.8" y="5.2" width="16.4" height="15" rx="2.6"/>
            <path d="M3.8 9.8h16.4M8.2 3.2v3.6M15.8 3.2v3.6"/>
            <circle cx="12" cy="14.6" r="1.3" fill="currentColor" stroke="none"/>
            @break
        @case('map-pin')
            <path d="M12 21s-6.8-6.1-6.8-11.2a6.8 6.8 0 0 1 13.6 0C18.8 14.9 12 21 12 21z"/>
            <circle cx="12" cy="9.8" r="2.5"/>
            @break
        @case('clock')
            <circle cx="12" cy="12" r="8.6"/>
            <path d="M12 7.4V12l3 2"/>
            @break
        @case('mail')
            <rect x="3.4" y="5.4" width="17.2" height="13.2" rx="2.4"/>
            <path d="m4.2 7 7.8 6 7.8-6"/>
            @break
        @case('arrow')
            <path d="M5 12h14M13.5 6.5 19 12l-5.5 5.5"/>
            @break
        @case('chevron')
            <path d="m9 6 6 6-6 6"/>
            @break
        @case('chevron-down')
            <path d="m6 9 6 6 6-6"/>
            @break
        @case('play')
            <path d="M8.5 5.8v12.4a.8.8 0 0 0 1.2.7l9.6-6.2a.8.8 0 0 0 0-1.4L9.7 5.1a.8.8 0 0 0-1.2.7z" fill="currentColor" stroke="none"/>
            @break
        @case('star')
            <path d="m12 3.6 2.6 5.3 5.8.8-4.2 4.1 1 5.8L12 16.9l-5.2 2.7 1-5.8-4.2-4.1 5.8-.8z" fill="currentColor" stroke="none"/>
            @break
        @case('quote')
            <path d="M10.2 6.5C6.6 7.6 4.5 10.3 4.5 14v3.5h5.2v-5.2H7.1c.1-2 1.3-3.5 3.6-4.3zM19.5 6.5c-3.6 1.1-5.7 3.8-5.7 7.5v3.5H19v-5.2h-2.6c.1-2 1.3-3.5 3.6-4.3z" fill="currentColor" stroke="none"/>
            @break
        @case('check')
            <circle cx="12" cy="12" r="8.6"/>
            <path d="m8.3 12.2 2.5 2.5 4.9-5"/>
            @break
        @case('plus')
            <path d="M12 5v14M5 12h14"/>
            @break
        @case('close')
            <path d="M6 6l12 12M18 6 6 18"/>
            @break
        @case('chat')
            <path d="M4.5 18.8V6.6a2.1 2.1 0 0 1 2.1-2.1h10.8a2.1 2.1 0 0 1 2.1 2.1v7.2a2.1 2.1 0 0 1-2.1 2.1H8.2z"/>
            <path d="M8.5 9.2h7M8.5 12.2h4.6"/>
            @break
        @case('shield')
            <path d="M12 3.5 4.8 6.3v5.1c0 4.3 3 7.9 7.2 9 4.2-1.1 7.2-4.7 7.2-9V6.3L12 3.5z"/>
            <path d="m8.8 12 2.2 2.2 4.2-4.3"/>
            @break
        @case('heart')
            <path d="M12 19.6s-7.6-4.4-7.6-10a4.2 4.2 0 0 1 7.6-2.5 4.2 4.2 0 0 1 7.6 2.5c0 5.6-7.6 10-7.6 10z"/>
            @break
        @case('link')
            <path d="M10 14a4 4 0 0 0 5.7 0l3-3a4 4 0 0 0-5.7-5.7l-1 1"/>
            <path d="M14 10a4 4 0 0 0-5.7 0l-3 3a4 4 0 0 0 5.7 5.7l1-1"/>
            @break
        @case('globe')
            <circle cx="12" cy="12" r="8.6"/>
            <path d="M3.6 12h16.8M12 3.4c2.3 2.4 3.4 5.3 3.4 8.6s-1.1 6.2-3.4 8.6c-2.3-2.4-3.4-5.3-3.4-8.6S9.7 5.8 12 3.4z"/>
            @break
        @case('external')
            <path d="M14 4.5h5.5V10M19.5 4.5 11 13"/>
            <path d="M17.5 13.8v4a1.7 1.7 0 0 1-1.7 1.7H6.2a1.7 1.7 0 0 1-1.7-1.7V8.2a1.7 1.7 0 0 1 1.7-1.7h4"/>
            @break
        @case('arrow-up')
            <path d="M12 19V5M6.5 10.5 12 5l5.5 5.5"/>
            @break
        @case('facebook')
            <path d="M14.2 8.5V6.7c0-.8.4-1.2 1.3-1.2H17V3h-2.2C12 3 10.8 4.4 10.8 6.6v1.9H9v2.6h1.8V21h3.2v-9.9h2.2l.4-2.6h-2.4z" fill="currentColor" stroke="none"/>
            @break
        @case('instagram')
            <rect x="4" y="4" width="16" height="16" rx="4.5"/>
            <circle cx="12" cy="12" r="3.4"/>
            <circle cx="16.7" cy="7.3" r="0.7" fill="currentColor" stroke="none"/>
            @break
        @case('breast')
            <path d="M12 10.4c-1.3-2.3-5-2.5-5.8.3-.7 2.1 1.2 3.6 3.3 4.8"/>
            <path d="M12 10.4c1.3-2.3 5-2.5 5.8.3.7 2.1-1.2 3.6-3.3 4.8"/>
            <path d="M9.5 15.5 7.2 20.4M14.5 15.5l2.3 4.9"/>
            @break
        @case('vezeeta')
            <path d="M5 5.2h3.2L12 15.4l3.8-10.2H19L12 19.4 5 5.2z" fill="currentColor" stroke="none"/>
            @break
        @case('youtube')
            <path d="M23 12.2s0-3.2-.4-4.6c-.2-.9-.9-1.6-1.8-1.8C19.2 5.4 12 5.4 12 5.4s-7.2 0-8.8.4c-.9.2-1.6.9-1.8 1.8C1 9 1 12.2 1 12.2s0 3.2.4 4.6c.2.9.9 1.6 1.8 1.8 1.6.4 8.8.4 8.8.4s7.2 0 8.8-.4c.9-.2 1.6-.9 1.8-1.8.4-1.4.4-4.6.4-4.6zM9.8 15.5V8.9l6.2 3.3-6.2 3.3z" fill="currentColor" stroke="none"/>
            @break
        @case('tiktok')
            <path d="M19.6 6.7a4.8 4.8 0 0 1-3.8-4.2V2h-3.4v13.7a2.9 2.9 0 0 1-2.9 2.5 2.9 2.9 0 0 1-2.9-2.9 2.9 2.9 0 0 1 2.9-2.9c.3 0 .5 0 .8.1V9.1a6.4 6.4 0 0 0-.8 0A6.3 6.3 0 0 0 3.2 15.4 6.3 6.3 0 0 0 9.5 21.8a6.3 6.3 0 0 0 6.3-6.4V8.8a8.2 8.2 0 0 0 4.8 1.5V6.8a4.8 4.8 0 0 1-1-.1z" fill="currentColor" stroke="none"/>
            @break
    @endswitch
</svg>
