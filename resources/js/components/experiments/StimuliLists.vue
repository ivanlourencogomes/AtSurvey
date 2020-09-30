<template>

    <div id="stimuli-lists">
        <div v-for="list in stimuliLists" :key="list.id">
            <h4 class="mt-4">{{list.list_info.list_name}} <edit-stimuli-list :list="list" /> </h4>
        </div>
    </div>
    
</template>

<script>
    export default {
        props: ['lists'],

        data: function() {
            return {
               stimuliLists: this.lists,
            };
        },
        mounted() {
           
        },
        methods: {
           
        }
    }

</script>

<style lang="scss">

    #stimuli-lists {
       opacity: 1;
    }
    

</style>
