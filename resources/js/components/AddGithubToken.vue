<template>
    <div class="container">
        <div class="row justify-content-center">
            <div v-if="show_stars" class="col-md-8">
                <!-- Show Github Stars -->
            </div>
            <div v-else class="col-md-8">
                Set your Github token:
                <b-form inline>
                    <label class="sr-only" for="inline-form-input-name">Name</label>
                    <b-form-input
                        v-model="token"
                        class="mb-2 mr-sm-2 mb-sm-0"
                        placeholder="token"
                    ></b-form-input>
                    <b-button @click="addGithubToken" variant="primary">Save</b-button>
                    <div>
                        <b-link target="_blank" href="https://docs.github.com/en/github/authenticating-to-github/keeping-your-account-and-data-secure/creating-a-personal-access-token">
                            No Token? Click here to learn how to make token
                        </b-link>
                    </div>
                </b-form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                token: '',
                show_stars: false,
            }
        },

        mounted() {
            console.log('Component mounted.')
        },

        methods: {
            async addGithubToken() {
                try {
                    const { response } = await axios.post('/token', { token : this.token })
                } catch ({ response }) {
                   // toast message
                   console.log(response.error)
                }
            }
        }
    }
</script>
