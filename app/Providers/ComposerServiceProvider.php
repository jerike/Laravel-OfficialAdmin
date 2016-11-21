<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer(
            '*', 'App\Http\ViewComposers\LayoutComposer'
        );
        view()->composer(
            ['banner.index', 'banner.create', 'banner.edit', 'news.create', 'news.edit'], 'App\Http\ViewComposers\ImageComposer'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
