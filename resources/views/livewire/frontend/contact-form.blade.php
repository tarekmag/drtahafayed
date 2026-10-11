<form class="contact-form" wire:submit="submit" novalidate>
    <h2>{{ __('site.contact.form_title') }}</h2>
    <p>{{ __('site.contact.form_text') }}</p>

    @if ($sent)
        <p class="form-notice" role="status" tabindex="-1">{{ __('site.contact.notice') }}</p>
    @endif

    <label class="form-field @error('name') is-invalid @enderror">
        <span>{{ __('site.contact.name') }} *</span>
        <input type="text" wire:model="name" autocomplete="name" required>
        @error('name')
            <small class="field-error">{{ $message }}</small>
        @enderror
    </label>
    <label class="form-field @error('phone') is-invalid @enderror">
        <span>{{ __('site.contact.phone') }} *</span>
        <input type="tel" wire:model="phone" autocomplete="tel" inputmode="tel" required>
        @error('phone')
            <small class="field-error">{{ $message }}</small>
        @enderror
    </label>
    <label class="form-field">
        <span>{{ __('site.contact.branch') }}</span>
        <select wire:model="branch">
            <option value="">{{ __('site.contact.branch_any') }}</option>
            @foreach ($branches as $branchName)
                <option value="{{ $branchName }}">{{ $branchName }}</option>
            @endforeach
        </select>
    </label>
    <label class="form-field">
        <span>{{ __('site.contact.service') }}</span>
        <select wire:model="service">
            <option value="">{{ __('site.contact.service_any') }}</option>
            @foreach ($services as $serviceName)
                <option value="{{ $serviceName }}">{{ $serviceName }}</option>
            @endforeach
        </select>
    </label>
    <label class="form-field">
        <span>{{ __('site.contact.message') }}</span>
        <textarea wire:model="message" rows="4" placeholder="{{ __('site.contact.message_hint') }}"></textarea>
    </label>
    <div class="form-actions">
        <button class="btn btn-primary" type="submit">{{ __('site.contact.submit') }}</button>
        @if ($whatsapp)
            <button class="btn btn-outline" type="button" x-on:click="window.__waPending = window.open('about:blank', '_blank')" wire:click="sendWhatsApp">{{ __('site.contact.whatsapp_submit') }}</button>
        @endif
    </div>
</form>
