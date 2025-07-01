<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Menu;

class MenuComposer
{
    public function compose(View $view)
    {
        $menus = Menu::where('is_active', 1)->orderBy('order_by', 'asc')->get();
        $view->with('menus', $menus);
    }
}
