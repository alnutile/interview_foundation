<template>
  <b-card class="tw-container tw-w-1/2 tw-m-auto tw-mt-20">
    <b-card-title class="text-center text-2xl tw-font-bold">
      Login
    </b-card-title>
    <b-alert v-model="showError" variant="danger" dismissible>
      {{ error_message }}
    </b-alert>

    <b-form @submit.prevent="submit">
      <b-form-group
          class="m-4"
          id="email-group"
          label="Email Address"
          label-for="email-input"
      >
        <b-form-input
            id="email-input"
            v-model="email"
            type="email"
            placeholder="Enter email"
            required
        ></b-form-input>
      </b-form-group>

      <b-form-group
          class="m-4"
          id="password-group"
          label="Password"
          label-for="password-input"
      >
        <b-form-input
            id="password-input"
            v-model="password"
            type="password"
            placeholder="Enter password"
            required
        ></b-form-input>
      </b-form-group>

      <b-form-group class="tw-text-center">
        <b-button type="submit" variant="primary">Login</b-button>
      </b-form-group>
    </b-form>
  </b-card>
</template>

<script>
import get from 'lodash/get'

export default {
  name: "LoginComponent",
  data() {
    return {
      email: '',
      password: '',
      error_message: '',
      showError: false
    }
  },
  methods: {
    submit() {
      this.$http.post('/auth/login', {email: this.email, password: this.password})
          .then(() => {
            window.location.reload();
          }).catch(({response}) => {
        this.error_message = get(response, 'data.message', 'something went wrong');
        this.showError = true;
      })
    }
  }
}
</script>

<style scoped>

</style>
