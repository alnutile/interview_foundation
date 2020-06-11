<template>
  <div>
    <b-form @submit="onSubmit">
      <b-form-group
        id="input-group-1"
        label="Github Token"
        label-for="github_token"
        description="Tokens are encryptly stored in the database"
      >
        <b-form-input
          id="github_token"
          v-model="token"
          type="text"
          required
          placeholder="Token..."
          :disabled="showHelp == false"
        ></b-form-input>
      </b-form-group>
      <b-form-group v-if="showHelp">
        <p>
          No Token? Click
          <a
            href="https://help.github.com/en/github/authenticating-to-github/creating-a-personal-access-token-for-the-command-line"
            target="_blank"
          >here</a> to learn how to make token
        </p>
      </b-form-group>

      <b-button type="submit" variant="primary" :disabled="showHelp == false">Save Token</b-button>
    </b-form>
  </div>
</template>

<script>
export default {
  props: {
    user_github_token: String
  },
  data() {
    return {
      token: "",
      showHelp: false
    };
  },
  mounted() {
    this.token = this.user_github_token || "";
    this.showHelp = this.token == "";
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
      axios
        .post("/github/token", {
          token: this.token
        })
        .then(function(response) {
          console.log(response.data);
        })
        .catch(function(error) {
          console.error(error);
        });
    }
  }
};
</script>
