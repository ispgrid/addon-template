<?php

use App\Livewire\Concerns\AuthorizesEveryRequest;
use App\Models\AppSetting;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

/**
 * The add-on's page. The logic lives here; the view next to it only shows what this class gives it.
 */
new #[Title('Hello')] class extends Component
{
    use AuthorizesEveryRequest;

    public function mount(): void
    {
        $this->authorizeAccess();
    }

    /**
     * Runs when the page opens and again on every later request of the open page.
     */
    protected function authorizeAccess(): void
    {
        $this->authorize('view-hello');
    }

    #[Computed]
    public function greeting(): string
    {
        return AppSetting::valueOf('hello.greeting') ?? __('Hello from your first ISPGrid add-on.');
    }
};
