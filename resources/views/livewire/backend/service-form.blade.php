<div>
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1090">
        @if ($noticeMessage)
            <div
                wire:key="service-form-notice-{{ $noticeKey }}"
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
                <h4 class="card-title mb-0">Service</h4>
            </div>
            <div class="card-body">
                <div class="row">
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
                            <input id="title-en" type="text" class="form-control @error('title.en') is-invalid @enderror" wire:model.blur="title.en">
                            @error('title.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" wire:model="slug">
                            @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="specialty" class="form-label">Specialty</label>
                            <select id="specialty" class="form-select @error('specialty') is-invalid @enderror" wire:model.live="specialty">
                                @foreach ($specialties as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('specialty') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon</label>
                            <select id="icon" class="form-select @error('icon') is-invalid @enderror" wire:model="icon">
                                @foreach ($icons as $name)
                                    <option value="{{ $name }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="excerpt-ar" class="form-label">Excerpt (Arabic)</label>
                            <textarea id="excerpt-ar" rows="3" class="form-control @error('excerpt.ar') is-invalid @enderror" wire:model="excerpt.ar"></textarea>
                            @error('excerpt.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="excerpt-en" class="form-label">Excerpt (English)</label>
                            <textarea id="excerpt-en" rows="3" class="form-control @error('excerpt.en') is-invalid @enderror" wire:model="excerpt.en"></textarea>
                            @error('excerpt.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="video" class="form-label">Video URL</label>
                            <input id="video" type="text" class="form-control @error('video') is-invalid @enderror" wire:model="video" placeholder="https://www.youtube.com/watch?v=...">
                            @error('video') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="sort" class="form-label">Sort</label>
                            <input id="sort" type="number" min="0" class="form-control @error('sort') is-invalid @enderror" wire:model="sort">
                            @error('sort') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <div class="form-check form-switch mb-3">
                            <input id="is-active" class="form-check-input" type="checkbox" wire:model="isActive">
                            <label class="form-check-label" for="is-active">Active</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">Body (Arabic)</label>
                            <div wire:ignore>
                                <textarea class="form-control" data-service-editor="body.ar">{{ $body['ar'] }}</textarea>
                            </div>
                            @error('body.ar') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-0">
                            <label class="form-label">Body (English)</label>
                            <div wire:ignore>
                                <textarea class="form-control" data-service-editor="body.en">{{ $body['en'] }}</textarea>
                            </div>
                            @error('body.en') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h4 class="card-title mb-0 flex-grow-1">Conditions</h4>
                <button type="button" class="btn btn-sm btn-soft-success" wire:click="addCondition">Add condition</button>
            </div>
            <div class="card-body">
                @forelse ($conditions as $index => $condition)
                    <div class="row" wire:key="condition-{{ $index }}">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <input type="text" class="form-control @error('conditions.'.$index.'.ar') is-invalid @enderror" placeholder="Arabic" wire:model="conditions.{{ $index }}.ar">
                                @error('conditions.'.$index.'.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <input type="text" class="form-control @error('conditions.'.$index.'.en') is-invalid @enderror" placeholder="English" wire:model="conditions.{{ $index }}.en">
                                @error('conditions.'.$index.'.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-soft-danger w-100" wire:click="removeCondition({{ $index }})">Remove</button>
                        </div>
                    </div>
                @empty
                    <p class="text-muted mb-0">No conditions yet.</p>
                @endforelse
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h4 class="card-title mb-0 flex-grow-1">FAQs</h4>
                <button type="button" class="btn btn-sm btn-soft-success" wire:click="addFaq">Add FAQ</button>
            </div>
            <div class="card-body">
                @forelse ($faqs as $index => $faq)
                    <div class="border rounded p-3 mb-3" wire:key="faq-{{ $index }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Question (Arabic)</label>
                                    <input type="text" class="form-control @error('faqs.'.$index.'.q.ar') is-invalid @enderror" wire:model="faqs.{{ $index }}.q.ar">
                                    @error('faqs.'.$index.'.q.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Question (English)</label>
                                    <input type="text" class="form-control @error('faqs.'.$index.'.q.en') is-invalid @enderror" wire:model="faqs.{{ $index }}.q.en">
                                    @error('faqs.'.$index.'.q.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Answer (Arabic)</label>
                                    <textarea rows="2" class="form-control @error('faqs.'.$index.'.a.ar') is-invalid @enderror" wire:model="faqs.{{ $index }}.a.ar"></textarea>
                                    @error('faqs.'.$index.'.a.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Answer (English)</label>
                                    <textarea rows="2" class="form-control @error('faqs.'.$index.'.a.en') is-invalid @enderror" wire:model="faqs.{{ $index }}.a.en"></textarea>
                                    @error('faqs.'.$index.'.a.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-soft-danger" wire:click="removeFaq({{ $index }})">Remove</button>
                    </div>
                @empty
                    <p class="text-muted mb-0">No FAQs yet.</p>
                @endforelse
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Related services</h4>
            </div>
            <div class="card-body">
                @forelse ($otherServices as $other)
                    <div class="form-check mb-2">
                        <input id="related-{{ $other->id }}" class="form-check-input" type="checkbox" value="{{ $other->slug }}" wire:model="related">
                        <label class="form-check-label" for="related-{{ $other->id }}">{{ $other->title['en'] ?? $other->slug }}</label>
                    </div>
                @empty
                    <p class="text-muted mb-0">Save this service first, then relate it to others.</p>
                @endforelse
                @error('related.*') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">SEO</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="meta-title-ar" class="form-label">Meta title (Arabic)</label>
                            <input id="meta-title-ar" type="text" class="form-control" wire:model="metaTitle.ar">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="meta-title-en" class="form-label">Meta title (English)</label>
                            <input id="meta-title-en" type="text" class="form-control" wire:model="metaTitle.en">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-0">
                            <label for="meta-description-ar" class="form-label">Meta description (Arabic)</label>
                            <textarea id="meta-description-ar" rows="2" class="form-control" wire:model="metaDescription.ar"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-0">
                            <label for="meta-description-en" class="form-label">Meta description (English)</label>
                            <textarea id="meta-description-en" rows="2" class="form-control" wire:model="metaDescription.en"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Image</h4>
            </div>
            <div class="card-body">
                @if ($url = $this->imageUrl())
                    <img src="{{ $url }}" alt="" class="img-fluid rounded mb-3" style="max-height: 180px">
                @endif
                <input type="file" class="form-control @error('imageUpload') is-invalid @enderror" wire:model="imageUpload" accept="image/*">
                <div wire:loading wire:target="imageUpload" class="form-text">Uploading...</div>
                @error('imageUpload') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="text-end mb-4">
            <a href="{{ route('backend.services.index') }}" class="btn btn-light me-2">Back</a>
            <button type="submit" class="btn btn-success" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="save">Save</span>
                <span wire:loading wire:target="save">Saving...</span>
            </button>
        </div>
    </form>
</div>

@script
<script>
    const mountServiceEditors = () => {
        if (typeof ClassicEditor === 'undefined') {
            return;
        }

        document.querySelectorAll('[data-service-editor]').forEach((element) => {
            if (element.dataset.editorReady === '1') {
                return;
            }

            element.dataset.editorReady = '1';

            ClassicEditor.create(element).then((editor) => {
                editor.ui.view.editable.element.style.minHeight = '220px';
                editor.model.document.on('change:data', () => {
                    $wire.set(element.dataset.serviceEditor, editor.getData());
                });
            }).catch((error) => {
                console.error(error);
            });
        });
    };

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
    mountServiceEditors();
</script>
@endscript
