<template>
<div>
  <b-card title="Login"
    tag="article"
    style="max-width: 30rem;"
    class="mb-3"
  >
    <b-form @submit="onSubmit" v-if="show">
      <b-form-group
        id="input-group-1"
        label="Email:"
        label-for="input-1"
        description="We'll never share your email with anyone else."
      >
        <b-form-input
          id="input-1"
          v-model="form.email"
          type="email"
          placeholder="Enter email"
          required
        ></b-form-input>
      </b-form-group>
      <b-form-group id="input-group-2" label="Password:" label-for="input-2">
        <b-form-input
          id="input-2"
          type="password"
          v-model="form.password"
          placeholder="Enter name"
          required
        ></b-form-input>
      </b-form-group>
      <b-button type="submit" variant="primary">Submit</b-button>
    </b-form>
  </b-card>
</div>
</template>
<script>
export default {
  data() {
    return {
      form: {
        email: '',
        password: '',
      },
      show: true
    }
  },
  methods: {
    onSubmit(event) {
      event.preventDefault()
      axios.post('/login', this.form).then(response => {
        localStorage.setItem('user-token', 'Bearer ' + response.config.headers['X-XSRF-TOKEN'])
        axios.defaults.headers.common['Authorization'] = localStorage.getItem('user-token');
        this.$router.replace('/')
      }).catch(error => console.log(error)); // credentials didn't match
    }
  }
}
</script>