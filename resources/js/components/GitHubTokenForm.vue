<template>
    <div>
      <b-form @submit.prevent="saveToken">
        <b-form-input v-model="token" placeholder="Enter GitHub Token"></b-form-input>
        <b-button type="submit" variant="primary">Save Token</b-button>
      </b-form>
  
      <b-toast v-model="showSuccessToast" :auto-hide="5000" variant="success" no-fade>
        Token saved successfully!
      </b-toast>
      
      <b-toast v-model="showErrorToast" :auto-hide="5000" variant="danger" no-fade>
        {{ errorMessage }}
      </b-toast>
      <p v-if="decryptedToken">Decrypted Token: {{ decryptedToken }}</p>
    <p v-if="!decryptedToken">No Token? <a href="https://github.com/settings/tokens" target="_blank">Click here</a> to learn how to make a token.</p>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        token: '',
        showSuccessToast: false,
        showErrorToast: false,
        errorMessage: '',
        decryptedToken: null,
      };
    },
    mounted() {
    // Retrieve decrypted token from cookie when the component is mounted
    this.fetchDecryptedToken();
    //this.decryptedToken = this.$cookies.get('decryptedToken');
  },
    methods: {
      async saveToken() {
        try {
          await axios.post('/save-token', { token: this.token });
          this.token = '';
          this.showSuccessToast = true;
          // Fetch the decrypted token and emit event to parent component
          this.fetchDecryptedToken();
          // Fetch the decrypted token and emit event to parent component
        } catch (error) {
          console.error('Failed to save token:', error);
          this.errorMessage = 'Error saving token.';
          this.showErrorToast = true;
        }
      },
      async fetchDecryptedToken() {
          try {
            const response = await axios.get('/decrypted-token');
            //console.log(respo)
            this.decryptedToken = response.data.token
            //this.$cookies.set('decryptedToken', this.decryptedToken);
          } catch (error) {
            console.error('Failed to fetch decrypted token:', error);
          }
        },
    },
  };
  </script>
  