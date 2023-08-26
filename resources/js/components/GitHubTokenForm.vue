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
      };
    },
    methods: {
      async saveToken() {
        try {
          await axios.post('/save-token', { token: this.token });
          this.token = '';
          //this.showSuccessToast = true;
  
          // Fetch the decrypted token and emit event to parent component
        } catch (error) {
          console.error('Failed to save token:', error);
          this.errorMessage = 'Error saving token.';
          this.showErrorToast = true;
        }
      },
    },
  };
  </script>
  