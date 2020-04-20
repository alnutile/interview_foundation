<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StarredRepository extends Component
{
    public $name;
    public $url;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $url)
    {
        $this->name = $name;
        $this->url= $url;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<'blade'
<b-card
    title="{{ $name }}"
    style="max-width: 20rem;"
    class="mb-2"
    >
    <b-card-text>
        {{ $name }}
    </b-card-text>

    <b-button href="{{ $url }}" variant="primary" target="_blank" class="btn-sm">View on Github</b-button>
</b-card>
blade;
    }
}
