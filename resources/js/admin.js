require('./bootstrap');

window.Vue = require('vue');

const files = require.context('./components/admin', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('example-component', require('./components/SomeComponent.vue').default);
//Vue.component('ajax-component', require('./components/AjaxComponent.vue').default);

const admin = new Vue({
    el: '#admin',
});

