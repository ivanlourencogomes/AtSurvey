<template>

    <div id="edit-stimuli-list">
        
        <button @click="showEditModal = !showEditModal" type="button" class="btn btn-link no-padding">Edit</button> |
        <button type="button" class="btn btn-link no-padding">Delete</button>

        <modal v-if="showEditModal" v-on:close-modal="showEditModal = false">
            
            <div slot="header">
                <h4 class="mb-3">{{stimuliList.list_info.list_name}}</h4>
            </div>

           <div slot="content">
                 <vue-excel-editor v-if="stimuliList.stimuli" v-model="stimuliList.stimuli" new-if-bottom autocomplete no-footer multi-update enterToSouth>
                    <vue-excel-column field="stimuli_text"   label="Stimuli Text" width="400px" />
                    <vue-excel-column field="condition"   label="Condition" />
                    <vue-excel-column field="condition_code"   label="Condition Code" />
                    <vue-excel-column field="item"   label="Item" />
                    <vue-excel-column field="item_id"   label="Item Id" />
                    <vue-excel-column field="trial"   label="Trial" />
                </vue-excel-editor>

                <button @click="updateStimuliList" class="d-block btn btn-primary mt-4">Save</button>
            </div>

            
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
            
        },
        methods: {
            updateStimuliList() {

                let stimList = {}
                
                stimList.list_info = this.stimuliList.list_info;

                stimList.stimuli = this.stimuliList.stimuli;
                stimList.toDelete = [];
                let indexDeleted = [];

                stimList.stimuli.forEach(function(item,index){
                    if (item.id) 
                        stimList.toDelete.push(item.id)
                        
                    delete item.$id;
                    delete item.id;
                    delete item.created_at;
                    delete item.pivot;
                    delete item.updated_at;
                    delete item.user_id_owner;
                    item.stimuli_type_id = '1';

                    if (!item.stimuli_text) 
                        indexDeleted.push(index) 
                });

                for (var i = indexDeleted.length -1; i >= 0; i--)
                    stimList.stimuli.splice(indexDeleted[i],1);
                
                const _this = this;

                axios.post(
                    '/stimuli', {
                        data: stimList,
                        _method: 'POST',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                ).then(function (response) {
                    _this.stimuliList.stimuli = response.data;
                })
                .catch(function (error) {
                    console.log(error);            
                });
            }
        }
    }
</script>

<style lang="scss">

    #edit-stimuli-list {
        display: inline;
        font-weight: 400;
            
            font-size: 0.9rem;

        button.no-padding {
            padding: 0;
            vertical-align: baseline;
        }

        .vue-excel-editor {
            tbody {
                td {
                    white-space: normal;
                }
            }
        }
    }
    

</style>
