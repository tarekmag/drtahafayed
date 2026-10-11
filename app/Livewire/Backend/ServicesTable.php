<?php

namespace App\Livewire\Backend;

use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ServicesTable extends Component
{
    use WithPagination;

    private const PER_PAGE = 10;

    public string $search = '';

    public string $specialty = 'all';

    public string $status = 'all';

    public string $noticeType = 'success';

    public ?string $noticeMessage = null;

    public int $noticeKey = 0;

    public function mount(): void
    {
        if ($message = session('serviceNotice')) {
            $this->notify('success', $message);
        }
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingSpecialty(): void
    {
        $this->resetPage();
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function delete(int $serviceId): void
    {
        $service = Service::query()->findOrFail($serviceId);
        $this->deleteManagedImage($service->image);
        $service->delete();
        $this->notify('success', 'Service deleted.');
    }

    public function render()
    {
        $services = Service::query()
            ->when($this->search !== '', function ($query) {
                $term = '%'.trim($this->search).'%';

                $query->where(function ($query) use ($term) {
                    $query->where('title->ar', 'like', $term)
                        ->orWhere('title->en', 'like', $term)
                        ->orWhere('slug', 'like', $term);
                });
            })
            ->when($this->specialty !== 'all', fn ($query) => $query->where('specialty', $this->specialty))
            ->when($this->status === 'active', fn ($query) => $query->where('is_active', true))
            ->when($this->status === 'hidden', fn ($query) => $query->where('is_active', false))
            ->orderBy('sort')
            ->orderBy('id')
            ->paginate(self::PER_PAGE);

        return view('livewire.backend.services-table', [
            'services' => $services,
            'specialties' => Service::SPECIALTIES,
        ]);
    }

    public function paginationView(): string
    {
        return 'livewire::bootstrap';
    }

    private function notify(string $type, string $message): void
    {
        $this->noticeType = $type;
        $this->noticeMessage = $message;
        $this->noticeKey++;
    }

    private function deleteManagedImage(?string $path): void
    {
        if ($path && str_starts_with($path, 'storage/')) {
            Storage::disk('public')->delete(substr($path, strlen('storage/')));
        }
    }
}
