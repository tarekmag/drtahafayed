<?php

namespace App\Livewire\Frontend;

use App\Support\Content;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\Livewire;

class ServicesIndex extends Component
{
    use PaginatesContent;

    #[Url(except: '')]
    public string $category = '';

    public function updatedCategory(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $specialties = __('site.services.specialties');
        $active = isset($specialties[$this->category]) ? $this->category : '';

        return view('livewire.frontend.services-index', [
            'services' => Content::services($active !== '' ? $active : null, 11)
                ->withPath(Livewire::originalUrl())
                ->appends(array_filter(['category' => $active])),
            'specialties' => $specialties,
            'active' => $active,
        ]);
    }
}
