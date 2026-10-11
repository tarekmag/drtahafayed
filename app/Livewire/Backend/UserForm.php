<?php

namespace App\Livewire\Backend;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class UserForm extends Component
{
    public ?int $userId = null;

    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $passwordConfirmation = '';

    public string $noticeType = 'success';

    public ?string $noticeMessage = null;

    public int $noticeKey = 0;

    public function mount(?User $user = null): void
    {
        if ($user) {
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
        }

        if ($message = session('userNotice')) {
            $this->notify('success', $message);
        }
    }

    public function save(): void
    {
        $this->name = trim($this->name);
        $this->email = trim($this->email);
        $this->password = trim($this->password);
        $this->passwordConfirmation = trim($this->passwordConfirmation);

        try {
            $this->validate();
        } catch (ValidationException $exception) {
            $this->notify('danger', (string) $exception->validator->errors()->first());

            throw $exception;
        }

        $user = $this->userId
            ? User::query()->findOrFail($this->userId)
            : new User;

        $user->name = $this->name;
        $user->email = $this->email;

        if ($this->password !== '') {
            $user->password = $this->password;
        }

        $user->save();

        $this->password = '';
        $this->passwordConfirmation = '';

        if ($this->userId === null) {
            session()->flash('userNotice', 'User saved.');
            $this->redirect(route('backend.users.edit', $user));

            return;
        }

        $this->notify('success', 'User saved.');
    }

    public function render()
    {
        return view('livewire.backend.user-form');
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->userId)],
            'password' => [
                $this->userId === null ? 'required' : 'nullable',
                'string',
                'min:8',
                Rule::when($this->password !== '', ['same:passwordConfirmation']),
            ],
        ];
    }

    private function notify(string $type, string $message): void
    {
        $this->noticeType = $type;
        $this->noticeMessage = $message;
        $this->noticeKey++;
    }
}
