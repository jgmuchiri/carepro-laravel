
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import VueI18n from 'vue-i18n';
import Locales from './vue-i18n-locales.generated.js';

Vue.use(VueRouter);
Vue.use(VueI18n);

Vue.prototype.$http = axios;

const routes = [
    { path: '/groups', name: 'groups.index', component: require('./components/Groups/Index.vue')},
    { path: '/groups/:group_id', name: 'groups.show', component: require('./components/Groups/Show.vue'), props: true},
    { path: '/roles', name: 'roles.index', component: require('./components/Roles/Index.vue')},
    { path: '/roles/create', name: 'roles.create', component: require('./components/Roles/CreateEdit.vue')},
    { path: '/roles/:role_id/edit', name: 'roles.edit', component: require('./components/Roles/CreateEdit.vue'), props: true},
    { path: '/home', name: 'home', component: require('./components/Dashboard/Index.vue')}
];

Vue.component('CreateEditGroupModal', require('./components/Groups/CreateEditModal.vue'));
Vue.component('GroupMassAssign', require('./components/Groups/MassAssign.vue'));
Vue.component('draggable', require('vuedraggable'));
Vue.component('CreateStaffModal', require('./components/StaffMembers/CreateModal'));
Vue.component('CreateParentModal', require('./components/Parents/CreateModal'));
Vue.component('CreateChildModal', require('./components/Children/CreateModal'));

Vue.mixin({
    methods: {
        notifyError: function(message)
        {
            $.notify({
                icon: 'ti-check',
                message: message

            }, {
                type: 'danger',
                timer: 4000
            });
        },
        notifySuccess: function(message)
        {
            $.notify({
                icon: 'ti-check',
                message: message

            }, {
                type: 'success',
                timer: 4000
            });
        }
    }
});

const i18n = new VueI18n({
    locale: 'en',
    fallbackLocale: 'en',
    messages: Locales
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router,
    i18n: i18n
});
