<?php

use App\Models\AppSetting;
use App\Models\Role;
use App\Models\User;
use Livewire\Livewire;

it('shows the greeting to staff with the box', function () {
    $this->actingAs(User::factory()->create());

    $this->get(route('hello.index'))->assertOk()->assertSee(__('Hello from your first ISPGrid add-on.'));
});

it('shows the greeting saved in the settings', function () {
    AppSetting::put('hello.greeting', 'Namaste from the network team');
    $this->actingAs(User::factory()->create());

    $this->get(route('hello.index'))->assertOk()->assertSee('Namaste from the network team');
});

it('refuses staff without the box', function () {
    Role::create(['name' => 'Front desk', 'guard_name' => 'web']);
    $this->actingAs(User::factory()->role('Front desk')->create());

    $this->get(route('hello.index'))->assertForbidden();
});

it('stops an open page when the box is taken away', function () {
    $role = Role::create(['name' => 'Front desk', 'guard_name' => 'web']);
    $role->givePermissionTo('view-hello');
    $this->actingAs(User::factory()->role('Front desk')->create());

    $page = Livewire::test('hello::hello')->assertOk();
    $role->revokePermissionTo('view-hello');

    $page->call('$refresh')->assertForbidden();
});
