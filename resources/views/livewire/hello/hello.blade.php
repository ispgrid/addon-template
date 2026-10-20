<section class="grid gap-6">
    <div>
        <x-ui.heading level="1" size="xl">{{ __('Hello') }}</x-ui.heading>
        <x-ui.text muted class="mt-1">{{ __('A page from an add-on. Change the greeting on System, then Add-ons.') }}</x-ui.text>
    </div>

    <x-ui.card>
        <x-ui.text>{{ $this->greeting }}</x-ui.text>
    </x-ui.card>
</section>
