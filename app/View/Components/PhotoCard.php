<?php

namespace App\View\Components;

use App\View\Presenters\PhotoPresenter;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PhotoCard extends Component
{
    public PhotoPresenter $photo;

    public function __construct(
        array $photo,
        public int $index = 0,
    ) {
        $this->photo = PhotoPresenter::make($photo);
    }

    public function render(): View
    {
        return view('components.photo-card');
    }
}
