<div>
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1090">
        @if ($noticeMessage)
            <div
                wire:key="review-notice-{{ $noticeKey }}"
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

    <div class="card">
        <div class="card-header d-flex flex-wrap align-items-center gap-2">
            <h4 class="card-title mb-0 flex-grow-1">Patient reviews</h4>
            <div style="min-width: 160px">
                <select class="form-select" wire:model.live="sort">
                    <option value="newest">Newest first</option>
                    <option value="oldest">Oldest first</option>
                </select>
            </div>
            <div style="min-width: 150px">
                <select class="form-select" wire:model.live="status">
                    <option value="all">All statuses</option>
                    <option value="pending">Pending</option>
                    <option value="published">Published</option>
                </select>
            </div>
            <div style="min-width: 130px">
                <select class="form-select" wire:model.live="rating">
                    <option value="all">All ratings</option>
                    @foreach ([5, 4, 3, 2, 1] as $stars)
                        <option value="{{ $stars }}">{{ $stars }} stars</option>
                    @endforeach
                </select>
            </div>
            <div style="min-width: 220px">
                <input
                    type="search"
                    class="form-control"
                    placeholder="Filter by name or text"
                    wire:model.live.debounce.300ms="search"
                >
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Received</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reviews as $review)
                            <tr wire:key="review-row-{{ $review->id }}">
                                <td>{{ $review->name }}</td>
                                <td>{{ $review->rating }} / 5</td>
                                <td>{{ \Illuminate\Support\Str::limit($review->body, 80) }}</td>
                                <td>{{ $review->created_at->format('Y-m-d h:i A') }}</td>
                                <td>
                                    @if ($review->is_published)
                                        <span class="badge bg-success">Published</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-sm btn-success" wire:click="toggle({{ $review->id }})">
                                        {{ $review->is_published ? 'Hide' : 'Publish' }}
                                    </button>
                                    <a href="{{ route('backend.reviews.show', $review) }}" class="btn btn-sm btn-primary">View</a>
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-danger"
                                        wire:click="delete({{ $review->id }})"
                                        wire:confirm="Delete this review?"
                                    >Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No reviews match these filters.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
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
