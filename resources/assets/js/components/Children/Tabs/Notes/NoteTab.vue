<template>
    <keep-alive>
        <component v-if="child.id"
                   v-bind:is="currentView"
                   :child="child"
                   v-on:viewSwitched="switchView"
        ></component>
    </keep-alive>
</template>

<script>
    export default {
        data() {
            return {
                currentView: 'NoteIndex'
            }
        },
        methods: {
            switchView: function (view) {
                this.currentView = view;
            }
        },
        props: ['child']
    }
</script>
