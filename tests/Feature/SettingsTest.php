<?php

use App\Models\AppSetting;
use App\Models\Role;
use App\Models\User;
use Livewire\Livewire;

it('saves the greeting on System, then Add-ons', function () {
    $this->actingAs(User::factory()->create());

    $this->get(route('addons.index'))->assertOk()->assertSee(__('Greeting'));

    Livewire::test('hello::settings')
        ->set('greeting', 'Namaste')
        ->call('save')
        ->assertHasNoErrors();

    expect(AppSetting::valueOf('hello.greeting'))->toBe('Namaste');
});

it('refuses a greeting longer than 100 characters', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test('hello::settings')
        ->set('greeting', str_repeat('a', 101))
        ->call('save')
        ->assertHasErrors(['greeting']);
});

it('needs its own settings box, not only the page box', function () {
    $role = Role::create(['name' => 'Front desk', 'guard_name' => 'web']);
    $role->givePermissionTo('view-hello');
    $this->actingAs(User::factory()->role('Front desk')->create());

    $this->get(route('addons.index'))->assertDontSee(__('Greeting'));
    Livewire::test('hello::settings')->assertForbidden();
});
