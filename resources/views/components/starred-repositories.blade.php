@props(['github_token' => $github_token, 'name' => $name, 'email' => $email])
<b-container class=" mb-3">
  <b-row cols="2">
    <b-col>
      <h4>{{ $name }}</h4>
      <b-link href="mailto:{{ $email }}">{{ $email }}</b-link>
      <hr>
      @if (!$github_token)
          <x-add-token-form />
      @else
          <b>Github Token</b>: 
          {{ $github_token }}
      <hr>
      <b-button variant="success" @click="getGithubRepositories" v-show="!loadingRepositories">Get Starred Repos</b-button>
      <p v-show="loadingRepositories">Getting your data</p>

      @endif
    </b-col>
    <b-col>
      <h4><span v-text="starred_repositories.length"></span> Starred Repositories</h4>
      <div v-if="starred_repositories.length > 0">

          <x-starred-repository
           v-for="repo in starred_repositories" 
            
            v-slot:name="repo.name" 
            >
            @{{ repo.name }}
          </x-starred-repository>
          
        
      </div>

      <div v-else>

        <p>No starred repositories to show</p>
      </div>

    </b-col>
  </b-row>
</b-container>