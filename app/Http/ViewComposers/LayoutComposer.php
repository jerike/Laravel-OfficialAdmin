<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Models\MenuNavigation;
use App\Models\Menu;

class LayoutComposer
{

    /**
     * The menu, menu_navigation repository implementation.
     *
     * @var MenuNavigation
     * @var Menu
     */
    protected $menu_navigation;
    protected $menu;

    /**
     * Create a new profile composer.
     *
     * @param \App\Models\MenuNavigation $menu_navigation
     * @param \App\Models\Menu $menu
     *
     * @return void
     */
    public function __construct(MenuNavigation $menu_navigation, Menu $menu)
    {
        // Dependencies automatically resolved by service container...
        $this->menu_navigation = $menu_navigation;
        $this->menu = $menu;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view_data_arr = [
            'sidebar_data_arr' => [
                'username' => session('username'),
                'permission_arr' => session('permission_arr'),
                'menu_navigations' => session('menu_navigation_arr'),                
                'menus' => session('menu_arr'),
            ]
        ];                
        $view->with($view_data_arr);

    }

}
