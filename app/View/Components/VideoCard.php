<?php

namespace App\View\Components;

use App\View\Presenters\VideoPresenter;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VideoCard extends Component
{
    public VideoPresenter $video;

    public function __construct(
        array $video,
        public int $index = 0,
    ) {
        $this->video = VideoPresenter::make($video);
    }

    public function render(): View
    {
        return view('components.video-card');
    }
}
