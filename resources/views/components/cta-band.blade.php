@use('App\Support\Content')

@php
    $whatsapp = Content::whatsappUrl(__('site.contact.wa_intro'));
    $phone = Content::phoneUrl();
@endphp

<section {{ $attributes->class(['cta-band']) }}>
    <div class="container">
        <div class="cta-card reveal">
            <span class="cta-ornament" aria-hidden="true"></span>
            <p class="eyebrow eyebrow-light">{{ __('site.cta.eyebrow') }}</p>
            <h2 class="cta-title">{{ __('site.cta.title') }}</h2>
            <p class="cta-text">{{ __('site.cta.text') }}</p>
            <div class="cta-actions">
                <x-button :href="Content::bookingUrl()" variant="gold" icon="calendar">{{ __('site.nav.book') }}</x-button>
                @if ($whatsapp)
                    <x-button :href="$whatsapp" variant="light-outline" icon="whatsapp" external>{{ __('site.common.whatsapp') }}</x-button>
                @endif
                @if ($phone)
                    <x-button :href="$phone" variant="light-outline" icon="phone"><span dir="ltr">{{ Content::contact()['phone'] }}</span></x-button>
                @endif
            </div>
        </div>
    </div>
</section>
