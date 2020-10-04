<template>

    <div id="edit-stimuli">
      
    </div>
    
</template>

<script>
    export default {
        props: ['theStimuli, theFieldTypes'],

        data: function() {
            return {
               selectedFieldType: null,
               stimuli: null,
            };
        },
        mounted() {
           this.stimuli = this.theStimuli;
           this.fieldTypes = this.theFieldTypes;
        },
        methods: {
           
        }
    }

</script>

<style lang="scss">

    
    

</style>
