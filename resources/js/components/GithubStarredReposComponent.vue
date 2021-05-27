<template>
  <b-card class="tw-border-none tw-mt-3">
    <b-card-title class="tw-text-center">
      <span class="tw-font-bold">STARRED REPOSITORIES</span>

    </b-card-title>
    <div class="tw-flex tw-items-center tw-justify-around my-4">
      <b-button
          pill
          variant="primary"
          @click="fetchRepositories"
          :disabled="isFetching || !hasToken"
      >
        REFRESH
      </b-button>
      <p v-if="!refreshed && !isFetching" class="text-center tw-py-2 tw-text-md">
        Click the button to fetch your starred repositories
      </p>
    </div>
    <div v-if="error" class="tw-my-2">
      <b-alert show dismissible variant="danger">
        {{ error }}
      </b-alert>
    </div>
    <b-table
        striped
        hover
        :items="repositories"
        :fields="fields"
        small
        :busy="isFetching"
    >
      <template v-slot:table-busy>
        <div class="text-center text-primary my-2">
          <b-spinner class="align-middle"></b-spinner>
          <strong>Loading...</strong>
        </div>
      </template>
      <template v-slot:cell(view)="data">
        <a :href="data.item.html_url" class="tw-text-small" target="_blank">Github Page</a>
      </template>
    </b-table>
  </b-card>
</template>

<script>
import get from 'lodash/get'

export default {
  name: "GithubStarredReposComponent",
  data() {
    return {
      repositories: null,
      isFetching: false,
      refreshed: false,
      error: null,
      hasToken: !!this.$user?.github_token,
      fields: [{key: 'full_name', label: 'Repo Name'}, 'open_issues', 'view'],
    }
  }
  ,
  methods: {
    fetchRepositories() {
      this.error = null;
      this.isFetching = true;
      this.$http
          .get('auth/starredGithubRepos')
          .then(({data}) => {
            this.repositories = data.repositories;
          })
          .catch((error) => {
            this.error = get(error, 'response.data.message', 'Something went wrong');
            this.repositories = [];
          })
          .finally(() => {
            this.isFetching = false;
            this.refreshed = true;
          });
    }
    ,
  }
  ,
}
</script>

<style scoped>

</style>
