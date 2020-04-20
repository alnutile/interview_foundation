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
            loadingRepositories: false,
            name: [],
            description: [],
            url: []
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
                    let arr = [];
                    for (var i = response.data.length - 1; i >= 0; i--) {
                        let repo = response.data[i];
                        //arr[arr.length] = {name:repo.name, url:repo.html_url};
                        arr[arr.length] = repo;
                        currentObj.name[currentObj.name.length] = repo.name;
                        currentObj.url[currentObj.url.length] = repo.html_url;
                        currentObj.description[currentObj.description.length] = repo.description;
                    }
                    currentObj.starred_repositories = arr;
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
