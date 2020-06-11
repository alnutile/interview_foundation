<template>
  <div class="mt-2">
    <b-button
      :disabled="showButton == false"
      v-on:click="getStarredRepos"
      variant="primary"
    >List Starred Repositories</b-button>
    <div v-if="showSpinner">
      <p>
        Getting your data
        <b-spinner small variant="primary"></b-spinner>
      </p>
    </div>
    <b-list-group class="mt-2" v-if="showList">
      <b-list-group-item
        v-for="repo in starredList"
        :key="repo.id"
        :href="repo.html_url"
        target="_blank"
      >{{repo.name}}</b-list-group-item>
    </b-list-group>
  </div>
</template>

<script>
export default {
  props: {
    user_github_token: String
  },
  data() {
    return {
      showButton: false,
      showList: false,
      showSpinner: false,
      starredList: []
    };
  },
  mounted() {
    this.showButton = this.user_github_token != "";
  },
  methods: {
    getStarredRepos() {
      this.showSpinner = true;

      axios
        .post("/github/starred", {
          token: this.user_github_token
        })
        .then(response => {
          this.starredList = response.data;
          this.showList = true
          this.showSpinner = false;
        });
    }
  }
};
</script>
