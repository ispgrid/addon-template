<?php

use App\Livewire\Concerns\AuthorizesEveryRequest;
use App\Livewire\Concerns\ShowsToasts;
use App\Models\AppSetting;
use Livewire\Component;

/**
 * The add-on's section on System, then Add-ons. Settings are stored with AppSetting under keys that start with the
 * add-on's prefix (hello.), and the permission is checked again in every action that saves.
 */
new class extends Component
{
    use AuthorizesEveryRequest, ShowsToasts;

    public string $greeting = '';

    public function mount(): void
    {
        $this->authorizeAccess();
        $this->greeting = (string) AppSetting::valueOf('hello.greeting');
    }

    protected function authorizeAccess(): void
    {
        $this->authorize('manage-hello');
    }

    public function save(): void
    {
        $this->authorize('manage-hello');
        $this->validate(['greeting' => ['nullable', 'string', 'max:100']]);
        AppSetting::put('hello.greeting', $this->greeting === '' ? null : $this->greeting);
        $this->toast(__('Settings saved.'));
    }
};
