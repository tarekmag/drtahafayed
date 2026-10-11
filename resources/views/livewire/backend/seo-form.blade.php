<div>
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1090">
        @if ($noticeMessage)
            <div
                wire:key="seo-notice-{{ $noticeKey }}"
                class="toast fade show toast-border-{{ $noticeType === 'success' ? 'success' : 'danger' }} overflow-hidden"
                role="alert"
                aria-live="assertive"
                aria-atomic="true"
                data-settings-toast
            >
                <div class="toast-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <i class="{{ $noticeType === 'success' ? 'ri-checkbox-circle-fill' : 'ri-alert-line' }} align-middle"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0">{{ $noticeMessage }}</h6>
                        </div>
                        <button type="button" class="btn-close ms-2" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <form wire:submit="save">
        @foreach ($pages as $page => $label)
            <div class="card" wire:key="seo-page-{{ $page }}">
                <div class="card-header">
                    <h4 class="card-title mb-0">{{ $label }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="seo-title-ar-{{ $page }}">Meta title (Arabic)</label>
                                <input id="seo-title-ar-{{ $page }}" type="text" class="form-control @error('entries.'.$page.'.title.ar') is-invalid @enderror" wire:model="entries.{{ $page }}.title.ar">
                                @error('entries.'.$page.'.title.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="seo-title-en-{{ $page }}">Meta title (English)</label>
                                <input id="seo-title-en-{{ $page }}" type="text" class="form-control @error('entries.'.$page.'.title.en') is-invalid @enderror" wire:model="entries.{{ $page }}.title.en">
                                @error('entries.'.$page.'.title.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-0">
                                <label class="form-label" for="seo-description-ar-{{ $page }}">Meta description (Arabic)</label>
                                <textarea id="seo-description-ar-{{ $page }}" rows="3" class="form-control @error('entries.'.$page.'.description.ar') is-invalid @enderror" wire:model="entries.{{ $page }}.description.ar"></textarea>
                                @error('entries.'.$page.'.description.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-0">
                                <label class="form-label" for="seo-description-en-{{ $page }}">Meta description (English)</label>
                                <textarea id="seo-description-en-{{ $page }}" rows="3" class="form-control @error('entries.'.$page.'.description.en') is-invalid @enderror" wire:model="entries.{{ $page }}.description.en"></textarea>
                                @error('entries.'.$page.'.description.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="text-end mb-4">
            <button type="submit" class="btn btn-success" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="save">Save</span>
                <span wire:loading wire:target="save">Saving...</span>
            </button>
        </div>
    </form>
</div>

@script
<script>
    const showSettingsToasts = () => {
        if (typeof bootstrap === 'undefined') {
            return;
        }

        document.querySelectorAll('[data-settings-toast]').forEach((element) => {
            if (element.dataset.shown === '1') {
                return;
            }

            element.dataset.shown = '1';
            bootstrap.Toast.getOrCreateInstance(element, { delay: 4000 }).show();
        });
    };

    Livewire.hook('morph.added', () => showSettingsToasts());
    Livewire.hook('morph.updated', () => showSettingsToasts());
    showSettingsToasts();
</script>
@endscript
