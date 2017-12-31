<template>
    <div class="content-wrapper">
        <div v-if="this.can_manage_children">
            <a href="#" class="label label-default" data-toggle="modal" data-target="#attachChildren" data-backdrop="false">{{ $t('Assign new child') }}</a>
            <AssignChildrenModal :parent_id="parent.id" :initial_selected_children="parent.children"></AssignChildrenModal>
        </div>
    </div>
</template>

<script>
    export default {
        created()
        {
            this.$http.get('/api/parents/' + this.parent_id)
                .then(response => {
                    this.parent = response.data.parent;
                    this.can_manage_children = response.data.can_manage_children;
                })
                .catch(error => {
                    alert("Something went wrong. Please try reloading the page");
                });
        },
        data() {
            return {
                parent: {},
                can_manage_children: false
            }
        },
        props: ['parent_id']
    }
</script>
