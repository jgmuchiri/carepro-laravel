
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.moment = require('moment');
import Lightbox from 'vue-pure-lightbox'
import VueRouter from 'vue-router';
import VueI18n from 'vue-i18n';
import Locales from './vue-i18n-locales.generated.js';
import Vue from 'vue';
import VueNoty from 'vuejs-noty';
import wysiwyg from "vue-wysiwyg";
Vue.use(wysiwyg, {
    hideModules: { "image": true }
});

window.bus = new Vue();

Vue.use(VueNoty);
Vue.use(VueRouter);
Vue.use(VueI18n);
Vue.use(Lightbox)

Vue.prototype.$http = axios;

const routes = [
    { path: '/groups', name: 'groups.index', component: require('./components/Groups/Index.vue')},
    { path: '/groups/:group_id', name: 'groups.show', component: require('./components/Groups/Show.vue'), props: true},
    { path: '/roles', name: 'roles.index', component: require('./components/Roles/Index.vue')},
    { path: '/roles/create', name: 'roles.create', component: require('./components/Roles/CreateEdit.vue')},
    { path: '/roles/:role_id/edit', name: 'roles.edit', component: require('./components/Roles/CreateEdit.vue'), props: true},
    { path: '/home', name: 'home', component: require('./components/Dashboard/Index.vue')},
    { path: '/staff', name: 'staff.index', component: require('./components/StaffMembers/Index.vue')},
    { path: '/staff/:staff_id/edit', name: 'staff.edit', component: require('./components/StaffMembers/Edit.vue'), props: true},
    { path: '/parents', name: 'parents.index', component: require('./components/Parents/Index.vue')},
    { path: '/parents/:parent_id', name: 'parents.show', component: require('./components/Parents/Show.vue'), props: true},
    { path: '/children/', name: 'children.index', component: require('./components/Children/Index.vue')},
    { path: '/children/:child_id', name: 'children.show', component: require('./components/Children/Show.vue'), props: true}
];

Vue.component('CreateEditGroupModal', require('./components/Groups/CreateEditModal.vue'));
Vue.component('GroupMassAssign', require('./components/Groups/MassAssign.vue'));
Vue.component('draggable', require('vuedraggable'));
Vue.component('CreateStaffModal', require('./components/StaffMembers/CreateModal'));
Vue.component('CreateEditParentModal', require('./components/Parents/CreateEditModal'));
Vue.component('CreateChildModal', require('./components/Children/CreateModal'));
Vue.component('AssignChildrenModal', require('./components/Parents/AssignChildrenModal'));
Vue.component('AddToGroupModal', require('./components/Groups/AddToGroupModal.vue'));
Vue.component('ChildrenHomeTab', require('./components/Children/Tabs/Home.vue'));
Vue.component('ChildrenPhotoTab', require('./components/Children/Tabs/Photo.vue'));
Vue.component('ChildrenNoteTab', require('./components/Children/Tabs/Notes/NoteTab.vue'));
Vue.component('NoteIndex', require('./components/Children/Tabs/Notes/Index.vue'));
Vue.component('CreateIncident', require('./components/Children/Tabs/Notes/CreateIncident.vue'));
Vue.component('CreateNote', require('./components/Children/Tabs/Notes/CreateNote.vue'));
Vue.component('ChildrenAttendanceTab', require('./components/Children/Tabs/Attendance.vue'));
Vue.component('ChildrenBillingTab', require('./components/Children/Tabs/Billing.vue'));
Vue.component('ChildrenHealthTab', require('./components/Children/Tabs/Health.vue'));
Vue.component('ChildrenAttachParentModal', require('./components/Children/AttachParentModal.vue'));
Vue.component('ChildrenAttachGroupModal', require('./components/Children/AttachGroupModal.vue'));
Vue.component('DropzoneModal', require('./components/DropzoneModal.vue'));
Vue.component('CreateEditPickupUserModal', require('./components/Children/Tabs/CreateEditPickupUserModal.vue'));
Vue.component('ToggleCheckInModal', require('./components/Children/ToggleCheckInModal.vue'));
Vue.component('CreateEditEmergencyContactModal', require('./components/Children/CreateEditEmergencyContactModal.vue'));
Vue.component('CreateEditHealthProviderModal', require('./components/Children/CreateEditHealthProviderModal.vue'));

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
        },
        createMomentDate: function (date) {
            return window.moment(date);
        },
        formatDate: function (date) {
            return window.moment(date).format("D MMMM YYYY");
        },
        formatTime: function (date) {
            return window.moment(date).format("LT");
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
