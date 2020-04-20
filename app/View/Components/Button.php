<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $variant;
    public $name;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($variant, $name)
    {
        $this->variant = $variant;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<'blade'
            <b-button variant="{{$variant}}" @click="saveGithubToken">{{ $name }}</b-button>
        blade;
    }
}
