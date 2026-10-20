<?php

namespace Acme\Hello;

use App\Models\User;
use App\Support\Addons\AddonSettings;
use App\Support\Navigation\Navigation;
use App\Support\Navigation\NavItem;
use App\Support\Permissions;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

/**
 * Hello: one page in the Add-ons menu and one setting on System, then Add-ons, each behind its own permission box.
 * Core loads this provider because composer.json lists it in extra.ispgrid.providers (never in extra.laravel).
 */
class HelloServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadJsonTranslationsFrom(__DIR__.'/../lang');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        Livewire::addNamespace('hello', viewPath: __DIR__.'/../resources/views/livewire');

        // Every box is registered here and gets its row in a migration. Ticking "Hello settings" on Roles ticks
        // "See the Hello page" too (implies).
        $permissions = $this->app->make(Permissions::class);
        $permissions->register('view-hello', fn (): string => __('See the Hello page'), fn (): string => __('Hello'));
        $permissions->register('manage-hello', fn (): string => __('Hello settings'), fn (): string => __('Hello'), 'view-hello');

        $this->app->make(AddonSettings::class)->register('acme/hello', 'hello::settings', 'manage-hello');

        $this->app->make(Navigation::class)->add(new NavItem(
            group: 'addons',
            label: fn (): string => __('Hello'),
            route: 'hello.index',
            icon: 'puzzle-piece',
            active: ['hello.*'],
            visible: fn (User $user): bool => $user->can('view-hello'),
            order: 50,
        ));
    }
}
