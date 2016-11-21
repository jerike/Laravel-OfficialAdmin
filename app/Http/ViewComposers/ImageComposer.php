<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class ImageComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view_data_arr['image_management_url'] = config('garenatw.imageserver.management_url');
        $view->with($view_data_arr);
    }

}
