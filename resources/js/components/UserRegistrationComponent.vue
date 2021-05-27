<template>
  <b-card class="tw-container tw-w-1/2 tw-m-auto tw-mt-20">
    <b-card-title class="text-center text-2xl tw-font-bold">
      User Registration
    </b-card-title>
    <b-alert v-model="showError" variant="danger" dismissible>
      {{ error_message }}
    </b-alert>

    <b-form @submit.prevent="submit">
      <b-form-group
          class="m-4"
          id="name-group"
          label="Name"
          label-for="name-input"
      >
        <b-form-input
            id="name-input"
            v-model="name"
            type="text"
            placeholder="Enter Your Name"
            required
        ></b-form-input>
      </b-form-group>

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
        <b-button type="submit" variant="primary">Register</b-button>
      </b-form-group>
    </b-form>
  </b-card>
</template>

<script>
import get from 'lodash/get'

export default {
  name: "RegisterComponent",
  data() {
    return {
      name: '',
      email: '',
      password: '',
      error_message: '',
      showError: false
    }
  },
  methods: {
    submit() {
      this.$http.post('/auth/registration', {
        name: this.name,
        email: this.email,
        password: this.password
      })
          .then(() => {
            window.location.reload();
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
