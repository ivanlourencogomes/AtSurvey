<template>

    <div id="edit-stimuli-list">
        
        <button @click="showEditModal = !showEditModal" type="button" class="btn btn-link">Edit</button> |
        <button type="button" class="btn btn-link">Delete</button>

        <modal v-if="showEditModal" v-on:close-modal="showEditModal = false">
            <div slot="header">
                <h4 class="mb-3">{{stimuliList.list_info.list_name}}</h4>
            </div>
            <table slot="content" class="table table-hover">
                <thead>
                    <tr>
                        <th>Stimuli text</th>
                        <th>Trial</th>
                        <th>Item</th>
                        <th>Item Id</th>
                        <th>Condition</th>
                        <th>Condition Code</th>
                        <th>Instruction Text</th>
                        <!-- <th>Last modified</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="stimuli in stimuliList.stimuli" :key="stimuli.id">
                        <td>{{stimuli.stimuli_text || ''}}</td>
                        <td>{{stimuli.trial || ''}}</td>
                        <td>{{stimuli.item || ''}}</td>
                        <td>{{stimuli.item_id || ''}}</td>
                        <td>{{stimuli.condition || ''}}</td>
                        <td>{{stimuli.condition_code || ''}}</td>
                        <td>{{stimuli.instruction_text || ''}}</td>
                        <!-- <th>{{stimuli.updated_at ? stimuli.updated_at : stimuli.created_at}}</th> -->
                    </tr>
                </tbody>

            </table>
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
