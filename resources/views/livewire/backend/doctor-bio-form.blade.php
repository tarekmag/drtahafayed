<div>
    <div id="doctor-bio-toasts" class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1090">
        @if ($noticeMessage)
            <div
                wire:key="doctor-notice-{{ $noticeKey }}"
                class="toast fade show toast-border-{{ $noticeType === 'success' ? 'success' : 'danger' }} overflow-hidden"
                role="alert"
                aria-live="assertive"
                aria-atomic="true"
                data-doctor-toast
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
                <h4 class="card-title mb-0">Profile</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name-ar" class="form-label">Name (Arabic)</label>
                            <input id="name-ar" type="text" class="form-control @error('name.ar') is-invalid @enderror" wire:model="name.ar">
                            @error('name.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name-en" class="form-label">Name (English)</label>
                            <input id="name-en" type="text" class="form-control @error('name.en') is-invalid @enderror" wire:model="name.en">
                            @error('name.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title-ar" class="form-label">Title (Arabic)</label>
                            <input id="title-ar" type="text" class="form-control @error('title.ar') is-invalid @enderror" wire:model="title.ar">
                            @error('title.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title-en" class="form-label">Title (English)</label>
                            <input id="title-en" type="text" class="form-control @error('title.en') is-invalid @enderror" wire:model="title.en">
                            @error('title.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="summary-ar" class="form-label">Summary (Arabic)</label>
                            <textarea id="summary-ar" rows="4" class="form-control @error('summary.ar') is-invalid @enderror" wire:model="summary.ar"></textarea>
                            @error('summary.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="summary-en" class="form-label">Summary (English)</label>
                            <textarea id="summary-en" rows="4" class="form-control @error('summary.en') is-invalid @enderror" wire:model="summary.en"></textarea>
                            @error('summary.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Biography</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Biography (Arabic)</label>
                            <div wire:ignore>
                                <textarea class="form-control" data-doctor-editor="bio.ar">{{ $bio['ar'] }}</textarea>
                            </div>
                            @error('bio.ar') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Biography (English)</label>
                            <div wire:ignore>
                                <textarea class="form-control" data-doctor-editor="bio.en">{{ $bio['en'] }}</textarea>
                            </div>
                            @error('bio.en') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Credentials</h4>
                <button type="button" class="btn btn-soft-primary btn-sm" wire:click="addCredential">Add</button>
            </div>
            <div class="card-body">
                @forelse ($credentials as $index => $credential)
                    <div class="row align-items-end" wire:key="credential-{{ $index }}">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label class="form-label" for="credential-ar-{{ $index }}">Arabic</label>
                                <input id="credential-ar-{{ $index }}" type="text" class="form-control @error('credentials.'.$index.'.ar') is-invalid @enderror" wire:model="credentials.{{ $index }}.ar">
                                @error('credentials.'.$index.'.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label class="form-label" for="credential-en-{{ $index }}">English</label>
                                <input id="credential-en-{{ $index }}" type="text" class="form-control @error('credentials.'.$index.'.en') is-invalid @enderror" wire:model="credentials.{{ $index }}.en">
                                @error('credentials.'.$index.'.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <button type="button" class="btn btn-soft-danger w-100" wire:click="removeCredential({{ $index }})">Remove</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted mb-0">No credentials yet.</p>
                @endforelse
            </div>
        </div>

        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Stats</h4>
                <button type="button" class="btn btn-soft-primary btn-sm" wire:click="addStat">Add</button>
            </div>
            <div class="card-body">
                @forelse ($stats as $index => $stat)
                    <div class="row align-items-end" wire:key="stat-{{ $index }}">
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label" for="stat-value-{{ $index }}">Value</label>
                                <input id="stat-value-{{ $index }}" type="number" min="0" class="form-control @error('stats.'.$index.'.value') is-invalid @enderror" wire:model="stats.{{ $index }}.value">
                                @error('stats.'.$index.'.value') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label" for="stat-suffix-{{ $index }}">Suffix</label>
                                <input id="stat-suffix-{{ $index }}" type="text" class="form-control @error('stats.'.$index.'.suffix') is-invalid @enderror" wire:model="stats.{{ $index }}.suffix">
                                @error('stats.'.$index.'.suffix') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label" for="stat-label-ar-{{ $index }}">Label (Arabic)</label>
                                <input id="stat-label-ar-{{ $index }}" type="text" class="form-control @error('stats.'.$index.'.label.ar') is-invalid @enderror" wire:model="stats.{{ $index }}.label.ar">
                                @error('stats.'.$index.'.label.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label" for="stat-label-en-{{ $index }}">Label (English)</label>
                                <input id="stat-label-en-{{ $index }}" type="text" class="form-control @error('stats.'.$index.'.label.en') is-invalid @enderror" wire:model="stats.{{ $index }}.label.en">
                                @error('stats.'.$index.'.label.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <button type="button" class="btn btn-soft-danger w-100" wire:click="removeStat({{ $index }})">Remove</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted mb-0">No stats yet.</p>
                @endforelse
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Images</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="hero-upload" class="form-label">Hero image</label>
                            @if ($url = $this->imageUrl($heroImage, $heroUpload))
                                <div class="mb-2">
                                    <img src="{{ $url }}" alt="" class="rounded border" style="max-height: 160px;">
                                </div>
                            @endif
                            <input id="hero-upload" type="file" accept="image/*" class="form-control @error('heroUpload') is-invalid @enderror" wire:model="heroUpload">
                            @error('heroUpload') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <div class="form-text" wire:loading wire:target="heroUpload">Uploading...</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="portrait-upload" class="form-label">Portrait</label>
                            @if ($url = $this->imageUrl($portrait, $portraitUpload))
                                <div class="mb-2">
                                    <img src="{{ $url }}" alt="" class="rounded border" style="max-height: 160px;">
                                </div>
                            @endif
                            <input id="portrait-upload" type="file" accept="image/*" class="form-control @error('portraitUpload') is-invalid @enderror" wire:model="portraitUpload">
                            @error('portraitUpload') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <div class="form-text" wire:loading wire:target="portraitUpload">Uploading...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-end mb-4">
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save">
                <span wire:loading.remove wire:target="save">Save</span>
                <span wire:loading wire:target="save">Saving...</span>
            </button>
        </div>
    </form>
</div>

@script
<script>
    const mountDoctorEditors = () => {
        if (typeof ClassicEditor === 'undefined') {
            return;
        }

        document.querySelectorAll('[data-doctor-editor]').forEach((element) => {
            if (element.dataset.editorReady === '1') {
                return;
            }

            element.dataset.editorReady = '1';

            ClassicEditor.create(element).then((editor) => {
                editor.ui.view.editable.element.style.minHeight = '200px';
                editor.model.document.on('change:data', () => {
                    $wire.set(element.dataset.doctorEditor, editor.getData());
                });
            }).catch((error) => {
                console.error(error);
            });
        });
    };

    const showDoctorToasts = () => {
        if (typeof bootstrap === 'undefined') {
            return;
        }

        document.querySelectorAll('[data-doctor-toast]').forEach((element) => {
            if (element.dataset.shown === '1') {
                return;
            }

            element.dataset.shown = '1';
            bootstrap.Toast.getOrCreateInstance(element, { delay: 4000 }).show();
        });
    };

    Livewire.hook('morph.added', () => showDoctorToasts());
    Livewire.hook('morph.updated', () => showDoctorToasts());
    showDoctorToasts();

    mountDoctorEditors();
</script>
@endscript
