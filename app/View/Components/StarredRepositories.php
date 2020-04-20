<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Auth;

class StarredRepositories extends Component
{
    public $name;
    public $email;
    public $github_token;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->github_token = Auth::user()->decryptedGithubToken();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.starred-repositories');
    }
}
