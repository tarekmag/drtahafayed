<?php

namespace App\View\Components;

use App\View\Presenters\ServicePresenter;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ServiceCard extends Component
{
    public ServicePresenter $service;

    public function __construct(
        array $service,
        public bool $featured = false,
        public int $index = 0,
        public bool $detailed = false,
    ) {
        $this->service = ServicePresenter::make($service);
    }

    public function render(): View
    {
        return view('components.service-card');
    }
}
