<form wire:submit="save" class="grid gap-3 sm:grid-cols-[1fr_auto] sm:items-end">
    <x-ui.input wire:model="greeting" :label="__('Greeting')" :description="__('Shown on the Hello page. Leave empty for the default.')" maxlength="100" />
    <x-ui.button type="submit">{{ __('Save') }}</x-ui.button>
</form>
