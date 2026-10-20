<div>
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1090">
        @if ($noticeMessage)
            <div
                wire:key="photo-form-notice-{{ $noticeKey }}"
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
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Photo</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="caption-ar" class="form-label">Caption (Arabic)</label>
                            <input id="caption-ar" type="text" class="form-control @error('caption.ar') is-invalid @enderror" wire:model="caption.ar">
                            @error('caption.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="caption-en" class="form-label">Caption (English)</label>
                            <input id="caption-en" type="text" class="form-control @error('caption.en') is-invalid @enderror" wire:model="caption.en">
                            @error('caption.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select id="category" class="form-select @error('category') is-invalid @enderror" wire:model="category">
                                @foreach ($categories as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="sort" class="form-label">Sort</label>
                            <input id="sort" type="number" min="0" class="form-control @error('sort') is-invalid @enderror" wire:model="sort">
                            @error('sort') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label d-block">Status</label>
                            <div class="form-check form-switch mt-2">
                                <input id="is-active" class="form-check-input" type="checkbox" wire:model="isActive">
                                <label class="form-check-label" for="is-active">Active on the site</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-0">
                            <label class="form-label">Image</label>
                            @if ($url = $this->imageUrl())
                                <div class="mb-2">
                                    <img src="{{ $url }}" alt="" class="img-fluid rounded" style="max-height: 180px">
                                </div>
                            @endif
                            <x-upload-progress>
                                <input type="file" class="form-control @error('imageUpload') is-invalid @enderror" wire:model="imageUpload" accept="image/*">
                                @error('imageUpload') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </x-upload-progress>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-end mb-4">
            <a href="{{ route('backend.photos.index') }}" class="btn btn-light me-2">Back</a>
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
