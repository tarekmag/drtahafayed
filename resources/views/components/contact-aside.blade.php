<aside class="contact-card">
    <h2>{{ __('site.contact.channels_title') }}</h2>
    @if ($phoneUrl)
        <div class="channel">
            <h3>{{ __('site.contact.phone_label') }}</h3>
            <a href="{{ $phoneUrl }}" dir="ltr">{{ $phone }}</a>
            @if ($secondaryPhoneUrl)
                <a href="{{ $secondaryPhoneUrl }}" dir="ltr">{{ $secondaryPhone }}</a>
            @endif
        </div>
    @endif
    @if ($whatsappUrl)
        <div class="channel">
            <h3>{{ __('site.contact.whatsapp_label') }}</h3>
            <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer">{{ __('site.common.whatsapp') }}</a>
        </div>
    @endif
    @if ($email !== '')
        <div class="channel">
            <h3>{{ __('site.contact.email_label') }}</h3>
            <a href="mailto:{{ $email }}">{{ $email }}</a>
        </div>
    @endif
    <div class="channel">
        <h3>{{ __('site.contact.social_label') }}</h3>
        <x-social-links labels />
    </div>
</aside>
