<?php

namespace App\View\Components;

use Auth;

use Illuminate\View\Component;

class NavigationItem extends Component
{
    public $navigation;
    public $admin;
    public $current_url;
    public $route;
    public $exact;
    private $shown;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($navigation)
    {
        //
        $this->navigation = $navigation;
        
        $this->admin = $navigation['admin'] ?? true;
        $this->current_url = url()->current();
        $this->route = $navigation['url'] ?? 'javascript:;';
        $this->exact = $navigation['exact'] ?? true;
        $this->shown = true;
        if (\array_key_exists('authorize', $navigation)) {
            $this->shown = Auth::user()->is_administrator || $navigation['authorize'](Auth::user());
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        if ($this->shown) {
            return view('components.navigation-item');
        }
        return '';
    }
}
