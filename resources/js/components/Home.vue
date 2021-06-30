<template>
<div>
  <b-form @submit="onSubmit" v-if="show" inline>
    <label class="mr-sm-2" for="inline-form-input-name">GitHub Token</label>
    <b-form-input
      id="inline-form-input-name"
      v-model="form.git_hub_token"
      class="mb-2 mr-sm-2 mb-sm-0"
      placeholder=""
    ></b-form-input>
    <b-button type="submit" variant="primary">Save</b-button>
  </b-form>
  <a
    v-if="showLink"
    href="https://docs.github.com/en/github/authenticating-to-github/keeping-your-account-and-data-secure/creating-a-personal-access-token"
    target="_blank"
    class="card-link"
  >No Token? Click here to learn how to make a token</a>
</div>
</template>
<script>
export default {
  mounted() {
    console.log('Component mounted.')
  },
  data() {
    return {
      form: {
        git_hub_token: '',
      },
      show: true,
      showLink: false
    }
  },
  created () {
    this.initialize()
  },
  methods: {
    initialize () {
      axios.get('/githubtoken', this.form).then(response => {
        if (response.data == 'no_token') {
          this.showLink = true;
        }else{
          this.form.git_hub_token = response.data;
        }
      }).catch(error => console.log(error));
    },
    onSubmit(event) {
      event.preventDefault()
      axios.post('/githubtoken', this.form).then(response => {
        this.form.git_hub_token = response.data;
        this.showLink = false;
      }).catch(error => console.log(error));
    }
  }
}
</script>