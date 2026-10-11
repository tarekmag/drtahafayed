<svg class="icon" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
    @switch($name)
        @case('general')
            <circle cx="12" cy="12" r="8"/>
            <path d="M12 8.5v7M8.5 12h7"/>
            @break
        @case('oncology')
            <circle cx="12" cy="12" r="7.5"/>
            <circle cx="12" cy="12" r="2.2"/>
            @break
        @case('endocrine')
            <path d="M12 3.2s5.2 5.1 5.2 8.6a5.2 5.2 0 0 1-10.4 0c0-3.5 5.2-8.6 5.2-8.6z"/>
            @break
        @case('thyroid')
            <path d="M12 5.2c1.7 0 2.8 1.5 3.8 3.1 1.1 1.8 1.7 3.5 1.7 4.9 0 2.4-1.7 4.3-3.8 4.3-1 0-1.6-.6-1.7-1.3-.1.7-.7 1.3-1.7 1.3-2.1 0-3.8-1.9-3.8-4.3 0-1.4.6-3.1 1.7-4.9 1-1.6 2.1-3.1 3.8-3.1z"/>
            <path d="M12 5.2V3.4"/>
            @break
        @case('parathyroid')
            <rect x="4" y="5" width="16" height="14" rx="4"/>
            <circle cx="9" cy="10" r="1.1" fill="currentColor" stroke="none"/>
            <circle cx="15" cy="10" r="1.1" fill="currentColor" stroke="none"/>
            <circle cx="9" cy="14.5" r="1.1" fill="currentColor" stroke="none"/>
            <circle cx="15" cy="14.5" r="1.1" fill="currentColor" stroke="none"/>
            @break
        @case('laparoscopy')
            <circle cx="12" cy="12" r="6.5"/>
            <circle cx="12" cy="12" r="1.7"/>
            <path d="M12 5.5V3M12 21v-2.5"/>
            @break
    @endswitch
</svg>
