<template>

    <div id="edit-stimuli-list">
        
        <button @click="showEditModal = !showEditModal" type="button" class="btn btn-link">Edit</button> |
        <button type="button" class="btn btn-link">Delete</button>

        <modal v-if="showEditModal" v-on:close-modal="showEditModal = false">

        </modal>

    </div>
    
</template>

<script>
    export default {
        props: ['list'],

        data: function() {
            return {
                stimuliList: this.list,
                showEditModal: false
            };
        },
        mounted() {
            
        }
    }
</script>

<style lang="scss" scoped>

    #edit-stimuli-list {
        display: inline;
        font-weight: 400;
            
            font-size: 0.9rem;

        button {
            padding: 0;
            vertical-align: baseline;
        }
    }
    

</style>
