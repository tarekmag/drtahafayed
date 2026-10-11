<?php

namespace App\Livewire\Backend;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    private const PER_PAGE = 10;

    public string $search = '';

    public string $noticeType = 'success';

    public ?string $noticeMessage = null;

    public int $noticeKey = 0;

    public function mount(): void
    {
        if ($message = session('userNotice')) {
            $this->notify('success', $message);
        }
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function delete(int $userId): void
    {
        $user = User::query()->findOrFail($userId);

        if ($user->id === Auth::id()) {
            $this->notify('danger', 'You cannot delete the account you are logged in with.');

            return;
        }

        if (User::query()->count() === 1) {
            $this->notify('danger', 'The last backend user cannot be deleted.');

            return;
        }

        $user->delete();
        $this->notify('success', 'User deleted.');
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search !== '', function ($query) {
                $term = '%'.trim($this->search).'%';

                $query->where(function ($query) use ($term) {
                    $query->where('name', 'like', $term)
                        ->orWhere('email', 'like', $term);
                });
            })
            ->orderBy('name')
            ->paginate(self::PER_PAGE);

        return view('livewire.backend.users-table', [
            'users' => $users,
            'currentUserId' => Auth::id(),
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
}
