<template>
    <component v-if="child.id"
               v-bind:is="currentView"
               :child="child"
               v-on:viewSwitched="switchView"
    ></component>
</template>

<script>
    export default {
        mounted()
        {
        },
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
