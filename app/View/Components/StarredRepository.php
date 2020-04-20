<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StarredRepository extends Component
{
    public $title;
    public $href;
    public $description;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = 'Repository name', $href = 'https://github.com/usr/repo', $description = 'About this repository')
    {
        $this->title = $title;
        $this->href= $href;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.starred-repository');
    }
}
