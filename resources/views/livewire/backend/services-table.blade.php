<div>
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1090">
        @if ($noticeMessage)
            <div
                wire:key="service-notice-{{ $noticeKey }}"
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
            <h4 class="card-title mb-0 flex-grow-1">Services</h4>
            <div style="min-width: 180px">
                <select class="form-select" wire:model.live="specialty">
                    <option value="all">All specialties</option>
                    @foreach ($specialties as $key => $label)
                        <option value="{{ $key }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div style="min-width: 140px">
                <select class="form-select" wire:model.live="status">
                    <option value="all">All statuses</option>
                    <option value="active">Active</option>
                    <option value="hidden">Hidden</option>
                </select>
            </div>
            <div style="min-width: 220px">
                <input
                    type="search"
                    class="form-control"
                    placeholder="Filter by title or slug"
                    wire:model.live.debounce.300ms="search"
                >
            </div>
            <a href="{{ route('backend.services.create') }}" class="btn btn-success">Add service</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Specialty</th>
                            <th>Status</th>
                            <th>Sort</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($services as $service)
                            <tr wire:key="service-row-{{ $service->id }}">
                                <td>
                                    <div class="fw-medium">{{ $service->title['en'] ?? '' }}</div>
                                    <div class="text-muted">{{ $service->title['ar'] ?? '' }}</div>
                                </td>
                                <td>{{ $specialties[$service->specialty] ?? $service->specialty }}</td>
                                <td>
                                    @if ($service->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Hidden</span>
                                    @endif
                                </td>
                                <td>{{ $service->sort }}</td>
                                <td class="text-end">
                                    <a href="{{ route('backend.services.edit', $service) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-danger"
                                        wire:click="delete({{ $service->id }})"
                                        wire:confirm="Delete this service?"
                                    >Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No services match this search.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $services->links() }}
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
