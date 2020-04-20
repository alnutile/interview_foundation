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
        return <<<'blade'
<b-container class=" mb-3">
  <b-row cols="2">
    <b-col>
      <h4>Profile</h4>
      <b>{{ $name }}</b> <br>
      <b-link href="mailto:{{ $email }}">{{ $email }}</b-link>
      <hr>
      @if (!$github_token)
      <x-add-token-form />
      @else
      <b>Github Token</b>: {{ $github_token }}

      @endif
    </b-col>
    <b-col>
      <h4>Starred Repositories</h4>
      <div>
        
          <x-starred-repository name="Example Repo" url="https://github.com/chiefbrob/test" />
          <x-starred-repository name="Example Repo 2" url="https://github.com/chiefbrob/test2" />
      </div>

    </b-col>
  </b-row>
</b-container>
blade;
    }
}
