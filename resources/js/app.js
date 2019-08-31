/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
var Editor = require('@tinymce/tinymce-vue').default;
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('question', require('./components/Question.vue').default);
Vue.component('add_question', require('./components/Add_question.vue').default);
Vue.component('radio', require('./components/Radio_button.vue').default);
Vue.component('delete_confirm', require('./components/Delete_confirm.vue').default);
Vue.component('search_quiz', require('./components/Search_quiz.vue').default);
// Vue.component('editor', require('./components/Editor.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
	  components: {
    'editor': Editor // <- Important part
  },
});

