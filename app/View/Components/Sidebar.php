<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Sidebar extends Component
{
    public $navigations;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->navigations = [
            [
                'text' => __('Dashboard'), 
                'url' => route('dashboard'), 
                'icon' => 'fas fa-home', 
                'admin' => false,
            ],
            [
                'text' => __('My Devices'), 
                'url' => '#', 
                'icon' => 'fas fa-mobile-alt', 
                'admin' => false,
                'exact' => false, 
            ],
            [
                'text' => __('Management'), 
                'url' => '#', 
                'icon' => 'fas fa-fingerprint', 
                'admin' => true,
                'exact' => false, 
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.sidebar');
    }
}
