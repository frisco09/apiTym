
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import VuePagination from './components/Pagination.vue';
import axios from 'axios';

window.Vue = require('vue');

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component(
	'passport-personal-access-tokens',
	require('./components/passport/PersonalAccessTokens.vue'));

Vue.component(
	'passport-clients',
	require('./components/passport/Clients.vue'));

Vue.component(
	'passport-authorized-clients',
require('./components/passport/AuthorizedClients.vue'));

const  app = new Vue({
    el: '#app',
    data: {
        users: {
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1
        },
        offset: 4,
    },
    mounted() {
        this.getUsers();
    },
    components: {
        VuePagination,
    },
    methods: {
        getUsers() {
            axios.get(`/user/api?page=${this.users.current_page}`)
                .then((response) => {
                    this.users = response.data;
                })
                .catch(() => {
                    console.log('handle server error from here');
                });
        }
    }
});
