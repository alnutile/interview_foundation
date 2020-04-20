require('./bootstrap');

window.Vue = require('vue');
import BootstrapVue from 'bootstrap-vue'
window.Vue.use(BootstrapVue) 

const app = new Vue({
    el: '#app',
    data() {
    	return {
    		github_token: '',
    		starred_repositories: [],
            loadingRepositories: false
    	}    	
    },
    methods: {
    	saveGithubToken(e) {
    		e.preventDefault();
    		if (this.github_token == '')
    			return;
            let currentObj = this;
            axios.post('/saveGithubToken', {
                github_token: this.github_token
            })
            .then(function (response) {
                alert("Github token saved");
                window.location.reload();
            })
            .catch(function (error) {
                console.log(error);
                alert('An error occurred saving your token');
            });
    	},
        getGithubRepositories() {
            
            let currentObj = this;

            currentObj.loadingRepositories = true;
            axios.get('/github/callback')
            .then(function (response) {
                if(response.status == 200 && response.data.length > 0)
                {
                    currentObj.starred_repositories = response.data;
                }
                currentObj.loadingRepositories = false;
            })
            .catch(function (error) {
                console.log(error);
                currentObj.loadingRepositories = false;
            });
        }
    }
});
