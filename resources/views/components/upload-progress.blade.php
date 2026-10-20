<div
    x-data="{
        uploading: false,
        progress: 0,
        forThis(event) {
            return this.$el.contains(event.target);
        },
        start(event) {
            if (! this.forThis(event)) return;
            this.uploading = true;
            this.progress = 0;
        },
        finish(event) {
            if (this.forThis(event)) this.uploading = false;
        },
        tick(event) {
            if (! this.forThis(event)) return;
            this.uploading = true;
            this.progress = event.detail.progress;
        },
    }"
    x-on:livewire-upload-start.window="start($event)"
    x-on:livewire-upload-finish.window="finish($event)"
    x-on:livewire-upload-cancel.window="finish($event)"
    x-on:livewire-upload-error.window="finish($event)"
    x-on:livewire-upload-progress.window="tick($event)"
>
    {{ $slot }}
    <div class="progress mt-2" style="height: 1.15rem" x-show="uploading" x-cloak>
        <div
            class="progress-bar progress-bar-striped progress-bar-animated"
            role="progressbar"
            x-bind:style="`width: ${progress}%`"
            x-bind:aria-valuenow="progress"
            aria-valuemin="0"
            aria-valuemax="100"
            x-text="`${progress}%`"
        ></div>
    </div>
</div>
