<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use Laravel\Fortify\Fortify;


class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerComponent('button-secondary');
        $this->registerComponent('danger-button-secondary');
        $this->registerComponent('nav-sidebar');
        $this->registerComponent('table');
        $this->registerComponent('info-card');
        $this->registerComponent('card-note');
        $this->registerComponent('card-submit');
        $this->registerComponent('pagination-nav');
        $this->registerComponent('cr-image');
        $this->registerComponent('select-dropdown');

    }


    /**
     * Configure the Jetstream Blade components.
     *
     * @return void
     */
    protected function configureComponents()
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('button-secondary');
            $this->registerComponent('danger-button-secondary');
            $this->registerComponent('nav-sidebar');
            $this->registerComponent('info-card');
            $this->registerComponent('card-note');
            $this->registerComponent('card-submit');
            $this->registerComponent('pagination-nav');
            $this->registerComponent('select-dropdown');

        });
    }

    /**
     * Register the given component.
     *
     * @param  string  $component
     * @return void
     */
    protected function registerComponent(string $component)
    {
        \Illuminate\Support\Facades\Blade::component('jetstream::components.'.$component, 'jet-'.$component);
    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureComponents();
        $this->configurePermissions();
        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
