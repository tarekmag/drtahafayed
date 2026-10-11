<div>
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1090">
        @if ($noticeMessage)
            <div
                wire:key="article-form-notice-{{ $noticeKey }}"
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
                <h4 class="card-title mb-0">Article</h4>
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
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category-ar" class="form-label">Category (Arabic)</label>
                            <input id="category-ar" type="text" class="form-control @error('category.ar') is-invalid @enderror" wire:model="category.ar">
                            @error('category.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category-en" class="form-label">Category (English)</label>
                            <input id="category-en" type="text" class="form-control @error('category.en') is-invalid @enderror" wire:model="category.en">
                            @error('category.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" wire:model="slug">
                            @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="published-at" class="form-label">Published</label>
                            <input id="published-at" type="date" class="form-control @error('publishedAt') is-invalid @enderror" wire:model="publishedAt">
                            @error('publishedAt') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="read-minutes" class="form-label">Read minutes</label>
                            <input id="read-minutes" type="number" min="1" class="form-control @error('readMinutes') is-invalid @enderror" wire:model="readMinutes">
                            @error('readMinutes') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="sort" class="form-label">Sort</label>
                            <input id="sort" type="number" min="0" class="form-control @error('sort') is-invalid @enderror" wire:model="sort">
                            @error('sort') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label d-block">Status</label>
                            <div class="form-check form-switch mt-2">
                                <input id="is-active" class="form-check-input" type="checkbox" wire:model="isActive">
                                <label class="form-check-label" for="is-active">Active on the site</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Body</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Body (Arabic)</label>
                            <div wire:ignore>
                                <textarea class="form-control" data-article-editor="body.ar">{{ $body['ar'] }}</textarea>
                            </div>
                            @error('body.ar') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-0">
                            <label class="form-label">Body (English)</label>
                            <div wire:ignore>
                                <textarea class="form-control" data-article-editor="body.en">{{ $body['en'] }}</textarea>
                            </div>
                            @error('body.en') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Cover</h4>
            </div>
            <div class="card-body">
                @if ($url = $this->coverUrl())
                    <img src="{{ $url }}" alt="" class="img-fluid rounded mb-3" style="max-height: 180px">
                @endif
                <input type="file" class="form-control @error('coverUpload') is-invalid @enderror" wire:model="coverUpload" accept="image/*">
                <div wire:loading wire:target="coverUpload" class="form-text">Uploading...</div>
                @error('coverUpload') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="text-end mb-4">
            <a href="{{ route('backend.articles.index') }}" class="btn btn-light me-2">Back</a>
            <button type="submit" class="btn btn-success" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="save">Save</span>
                <span wire:loading wire:target="save">Saving...</span>
            </button>
        </div>
    </form>
</div>

@script
<script>
    const mountArticleEditors = () => {
        if (typeof ClassicEditor === 'undefined') {
            return;
        }

        document.querySelectorAll('[data-article-editor]').forEach((element) => {
            if (element.dataset.editorReady === '1') {
                return;
            }

            element.dataset.editorReady = '1';

            ClassicEditor.create(element).then((editor) => {
                editor.ui.view.editable.element.style.minHeight = '220px';
                editor.model.document.on('change:data', () => {
                    $wire.set(element.dataset.articleEditor, editor.getData());
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
    mountArticleEditors();
</script>
@endscript
