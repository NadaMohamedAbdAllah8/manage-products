<?php

namespace App\View\Components;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\View\Component;

class Alert extends Component
{
    public $message = "";
    public $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($message, $type = "primary")
    {
        $this->message = $message;

        $this->type = $type;

        Debugbar::info($type);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}