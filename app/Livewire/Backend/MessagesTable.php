<?php

namespace App\Livewire\Backend;

use App\Models\Contact;
use Livewire\Component;

class MessagesTable extends Component
{
    public string $search = '';

    public string $sort = 'newest';

    public string $status = 'all';

    public string $noticeType = 'success';

    public ?string $noticeMessage = null;

    public int $noticeKey = 0;

    public function delete(int $contactId): void
    {
        Contact::query()->findOrFail($contactId)->delete();
        $this->notify('success', 'Message deleted.');
    }

    public function render()
    {
        $messages = Contact::query()
            ->when($this->search !== '', function ($query) {
                $term = '%'.trim($this->search).'%';

                $query->where(function ($query) use ($term) {
                    $query->where('name', 'like', $term)
                        ->orWhere('phone', 'like', $term);
                });
            })
            ->when($this->status === 'new', fn ($query) => $query->whereNull('read_at'))
            ->when($this->status === 'read', fn ($query) => $query->whereNotNull('read_at'))
            ->orderBy('created_at', $this->sort === 'oldest' ? 'asc' : 'desc')
            ->get();

        return view('livewire.backend.messages-table', [
            'messages' => $messages,
        ]);
    }

    private function notify(string $type, string $message): void
    {
        $this->noticeType = $type;
        $this->noticeMessage = $message;
        $this->noticeKey++;
    }
}
