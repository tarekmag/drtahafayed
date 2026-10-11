<?php

namespace App\Livewire\Backend;

use App\Models\Clinic;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ClinicsTable extends Component
{
    public string $search = '';

    public string $noticeType = 'success';

    public ?string $noticeMessage = null;

    public int $noticeKey = 0;

    public function delete(int $clinicId): void
    {
        $clinic = Clinic::query()->findOrFail($clinicId);

        foreach ($clinic->photos ?? [] as $photo) {
            $this->deleteManagedImage($photo);
        }

        $clinic->delete();
        $this->notify('success', 'Branch deleted.');
    }

    public function render()
    {
        $clinics = Clinic::query()
            ->when($this->search !== '', function ($query) {
                $term = '%'.trim($this->search).'%';

                $query->where(function ($query) use ($term) {
                    $query->where('name->ar', 'like', $term)
                        ->orWhere('name->en', 'like', $term);
                });
            })
            ->orderBy('sort')
            ->orderBy('id')
            ->get();

        return view('livewire.backend.clinics-table', [
            'clinics' => $clinics,
        ]);
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
