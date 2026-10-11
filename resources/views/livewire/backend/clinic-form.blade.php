@assets
    <link rel="stylesheet" href="{{ asset('backendtheme/assets/libs/leaflet/leaflet.css') }}">
    <script src="{{ asset('backendtheme/assets/libs/leaflet/leaflet.js') }}"></script>
@endassets

<div>
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1090">
        @if ($noticeMessage)
            <div
                wire:key="clinic-form-notice-{{ $noticeKey }}"
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
                <h4 class="card-title mb-0">Branch</h4>
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
                            <input id="name-en" type="text" class="form-control @error('name.en') is-invalid @enderror" wire:model.blur="name.en">
                            @error('name.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" wire:model="slug">
                            <div class="form-text">Used in the public page address. A new branch can leave this empty until the English name is set.</div>
                            @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="address-ar" class="form-label">Address (Arabic)</label>
                            <textarea id="address-ar" rows="2" class="form-control @error('address.ar') is-invalid @enderror" wire:model="address.ar"></textarea>
                            @error('address.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="address-en" class="form-label">Address (English)</label>
                            <textarea id="address-en" rows="2" class="form-control @error('address.en') is-invalid @enderror" wire:model="address.en"></textarea>
                            @error('address.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label">Working days</label>
                            <div>
                                @foreach ($weekdays as $value => $label)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="day-{{ $value }}" value="{{ $value }}" wire:model="days">
                                        <label class="form-check-label" for="day-{{ $value }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('days.*') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="opens" class="form-label">Opens</label>
                            <input id="opens" type="time" class="form-control @error('opens') is-invalid @enderror" wire:model="opens">
                            @error('opens') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="closes" class="form-label">Closes</label>
                            <input id="closes" type="time" class="form-control @error('closes') is-invalid @enderror" wire:model="closes">
                            @error('closes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" wire:model="phone">
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-0">
                            <label for="map" class="form-label">Map</label>
                            <div class="input-group">
                                <input id="map" type="text" class="form-control @error('map') is-invalid @enderror" wire:model="map">
                                <button type="button" class="btn btn-primary" id="clinic-map-pin">Pin location</button>
                            </div>
                            @error('map') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            <div class="form-text">Click the map or drag the pin. The branch location is saved as coordinates.</div>
                            <div
                                wire:ignore
                                id="clinic-location-map"
                                class="mt-2 rounded border"
                                style="height: 380px"
                                data-query="{{ $map }}"
                                data-fallbacks='@json(array_values(array_filter([$address["en"] ?? "", $address["ar"] ?? ""])))'
                                data-icon="{{ asset('backendtheme/assets/libs/leaflet/images/marker-icon.png') }}"
                                data-icon2x="{{ asset('backendtheme/assets/libs/leaflet/images/marker-icon-2x.png') }}"
                                data-shadow="{{ asset('backendtheme/assets/libs/leaflet/images/marker-shadow.png') }}"
                            ></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Photos</h4>
            </div>
            <div class="card-body">
                <div class="row g-3 mb-3">
                    @foreach ($photos as $index => $photo)
                        <div class="col-md-3" wire:key="clinic-photo-{{ $index }}-{{ $photo }}">
                            <div class="border rounded p-2">
                                <img src="{{ $this->imageUrl($photo) }}" alt="" class="img-fluid rounded mb-2">
                                <button type="button" class="btn btn-sm btn-danger" wire:click="removePhoto({{ $index }})">Remove</button>
                            </div>
                        </div>
                    @endforeach
                    @foreach ($photoUploads as $index => $upload)
                        <div class="col-md-3" wire:key="clinic-upload-{{ $index }}">
                            <div class="border rounded p-2">
                                <img src="{{ $upload->temporaryUrl() }}" alt="" class="img-fluid rounded mb-2">
                                <button type="button" class="btn btn-sm btn-danger" wire:click="removeUpload({{ $index }})">Remove</button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <input type="file" class="form-control @error('photoUploads.*') is-invalid @enderror" wire:model="photoUploads" accept="image/*" multiple>
                <div wire:loading wire:target="photoUploads" class="form-text">Uploading...</div>
                @error('photoUploads.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="text-end mb-4">
            <a href="{{ route('backend.clinics.index') }}" class="btn btn-light me-2">Back</a>
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

    const mapRoot = document.getElementById('clinic-location-map');

    if (mapRoot && mapRoot.dataset.ready !== '1' && typeof L !== 'undefined') {
        mapRoot.dataset.ready = '1';

        const icon = L.icon({
            iconUrl: mapRoot.dataset.icon,
            iconRetinaUrl: mapRoot.dataset.icon2x,
            shadowUrl: mapRoot.dataset.shadow,
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41],
        });

        const map = L.map(mapRoot).setView([30.0444, 31.2357], 11);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap',
        }).addTo(map);

        let marker = null;

        const savePin = (lat, lng) => {
            $wire.set('map', `${Number(lat).toFixed(6)},${Number(lng).toFixed(6)}`);
        };

        const placePin = (lat, lng, zoom = 16) => {
            const point = [lat, lng];

            if (!marker) {
                marker = L.marker(point, { icon, draggable: true }).addTo(map);
                marker.on('dragend', () => {
                    const position = marker.getLatLng();
                    savePin(position.lat, position.lng);
                });
            } else {
                marker.setLatLng(point);
            }

            map.setView(point, Math.max(map.getZoom(), zoom));
        };

        map.on('click', (event) => {
            placePin(event.latlng.lat, event.latlng.lng);
            savePin(event.latlng.lat, event.latlng.lng);
        });

        const parseCoordinates = (value) => {
            const match = String(value || '').trim().match(/^(-?\d+(?:\.\d+)?)\s*,\s*(-?\d+(?:\.\d+)?)$/);

            return match ? { lat: Number(match[1]), lng: Number(match[2]) } : null;
        };

        const wait = (ms) => new Promise((resolve) => setTimeout(resolve, ms));

        const variants = (query) => {
            const value = String(query || '').trim();

            if (value === '' || /^https?:\/\//i.test(value)) {
                return [];
            }

            const short = value.split(/[,،]/)[0].trim();

            return short !== '' && short !== value ? [value, short] : [value];
        };

        const geocode = async (query) => {
            const coordinates = parseCoordinates(query);

            if (coordinates) {
                return coordinates;
            }

            const response = await fetch(`https://nominatim.openstreetmap.org/search?format=jsonv2&limit=1&countrycodes=eg&q=${encodeURIComponent(query)}`, {
                headers: { Accept: 'application/json' },
            });

            if (!response.ok) {
                return null;
            }

            const results = await response.json();

            if (!results.length) {
                return null;
            }

            return { lat: Number(results[0].lat), lng: Number(results[0].lon) };
        };

        const pinQuery = async (query, persist = false) => {
            const options = variants(query);

            for (let index = 0; index < options.length; index++) {
                const coordinates = await geocode(options[index]);

                if (coordinates) {
                    placePin(coordinates.lat, coordinates.lng);

                    if (persist) {
                        savePin(coordinates.lat, coordinates.lng);
                    }

                    return true;
                }

                if (index < options.length - 1) {
                    await wait(1100);
                }
            }

            return false;
        };

        const pinFirstMatch = async () => {
            let fallbacks = [];

            try {
                fallbacks = JSON.parse(mapRoot.dataset.fallbacks || '[]');
            } catch (error) {
                fallbacks = [];
            }

            const queries = [mapRoot.dataset.query, ...fallbacks];

            for (const query of queries) {
                if (await pinQuery(query)) {
                    return;
                }

                await wait(1100);
            }
        };

        pinFirstMatch();
        setTimeout(() => map.invalidateSize(), 200);

        if (!window.__clinicMapPinBound) {
            window.__clinicMapPinBound = true;
            document.addEventListener('click', (event) => {
                if (!event.target.closest('#clinic-map-pin')) {
                    return;
                }

                event.preventDefault();
                pinQuery(document.getElementById('map')?.value || '', true);
            });
        }
    }
</script>
@endscript
