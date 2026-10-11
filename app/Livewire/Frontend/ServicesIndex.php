<?php

namespace App\Livewire\Frontend;

use App\Support\Content;
use Livewire\Attributes\Url;
use Livewire\Component;

class ServicesIndex extends Component
{
    #[Url(except: '')]
    public string $category = '';

    public function render()
    {
        $specialties = __('site.services.specialties');
        $services = Content::services();

        $active = isset($specialties[$this->category]) ? $this->category : '';

        if ($active !== '') {
            $services = $services->filter(
                fn (array $service) => ($service['specialty'] ?? '') === $active
            )->values();
        }

        return view('livewire.frontend.services-index', [
            'services' => $services,
            'specialties' => $specialties,
            'active' => $active,
        ]);
    }
}
