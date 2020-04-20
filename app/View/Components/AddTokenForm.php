<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AddTokenForm extends Component
{
    public $url = 'https://github.com/settings/tokens';

    public function __construct()
    {
        //
    }

    public function render()
    {
        return <<<'blade'
<form @submit="saveGithubToken">
    <div>
        <b-form-input v-model="github_token" placeholder="Enter Github Token"></b-form-input>
    </div>
    <div>
        <x-button variant='success' name='Save' />
    </div>
    <div>
        <b-link href="{{ $url }}" target="_blank">No Token? Click here to learn how to make token</b-link>
    </div>
</form>
blade;
    }
}
