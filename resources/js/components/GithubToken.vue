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
          v-model="form.token"
          type="text"
          required
          placeholder="Token..."
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

      <b-button type="submit" variant="primary">Save Token</b-button>
    </b-form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        token: '123'
      },
      showHelp: false
    };
  },
  mounted() {
    this.showHelp = this.form.token == null
  },
  methods: {
    onSubmit(evt) {

    }
  }
};
</script>
