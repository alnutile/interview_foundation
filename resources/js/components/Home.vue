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
      <!-- <b-button type="submit" variant="primary">Submit</b-button> -->
    <b-button type="submit" variant="primary">Save</b-button>
  </b-form>
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
      show: true
    }
  },
  created () {
    this.initialize()
  },
  methods: {
    initialize () {
      axios.get('/githubtoken', this.form).then(response => {
        this.form.git_hub_token = response.data.git_hub_token;
      }).catch(error => console.log(error));
    },
    onSubmit(event) {
      event.preventDefault()
      axios.post('/githubtoken', this.form).then(response => {
        this.form.git_hub_token = response.data.git_hub_token;
      }).catch(error => console.log(error));
    }
  }
}
</script>