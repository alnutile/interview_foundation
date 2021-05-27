<template>
  <b-card class="tw-container tw-w-1/2 tw-m-auto tw-mt-20">
    <b-card-title class="text-center text-2xl tw-font-bold">
      Github Token
    </b-card-title>
    <b-alert v-model="showError" variant="danger" dismissible>
      {{ error_message }}
    </b-alert>
    <b-alert v-model="showSuccess" variant="success" dismissible>
      {{ success_message }}
    </b-alert>
    <b-form @submit.prevent="submit">
      <b-form-group
          class="m-4"
          id="token-group"
          label=""
          label-for="token-input"
      >
        <b-form-input
            id="token-input"
            v-model="token"
            type="text"
            placeholder="Enter token"
            required
        ></b-form-input>
      </b-form-group>

      <b-form-group class="tw-text-center">
        <b-button type="submit" block variant="primary">Update Token</b-button>
      </b-form-group>
    </b-form>
    <div v-if="!token" class="tw-mb-2 tw-mt-5 tw-text-center mx-auto">
      <hr>
      <p class="tw-text-md">
        You haven't added a github token yet.
        <span> Click</span>
        <a
            href="https://help.github.com/en/github/authenticating-to-github/creating-a-personal-access-token-for-the-command-line"
            class="tw-px-1"
            target="_blank"
        >
          here
        </a>
        <span> to learn how to make token</span>
      </p>
    </div>
  </b-card>
</template>

<script>
import get from 'lodash/get'

export default {
  name: "GithubTokenFormComponent",
  data() {
    return {
      token: this.$user?.github_token,
      success_message: '',
      error_message: '',
      showSuccess: false,
      showError: false
    }
  },
  methods: {
    submit() {
      this.$http.put('/auth/githubToken', {token: this.token})
          .then(({data}) => {
            this.token = data.token;
            this.success_message = data.message;
            this.showSuccess = true;

          }).catch((error) => {
        this.error_message = get(error, 'response.data.message', 'Something went wrong');
        this.showError = true;
      })
    }
  }
}
</script>

<style scoped>

</style>
