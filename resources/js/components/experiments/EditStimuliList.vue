<template>

    <div id="edit-stimuli-list">
        
        <button @click="showEditModal = !showEditModal" type="button" class="btn btn-link no-padding">Edit</button> |
        <button type="button" class="btn btn-link no-padding">Delete</button>

        <modal v-if="showEditModal" v-on:close-modal="showEditModal = false">
            
            <div slot="header">
                <h4 class="mb-3">{{stimuliList.list_info.list_name}}</h4>
            </div>

           <div slot="content">
                 <vue-excel-editor v-model="stimuliList.stimuli" new-if-bottom autocomplete no-footer multi-update>
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
            $(".vue-excel-editor").bind('paste', function(e) {
                console.log(e);
            });
        },
        methods: {
            updateStimuliList() {

                let stList = {}
                
                stList.list_info = this.stimuliList.list_info;

                stList.stimuli = this.stimuliList.stimuli;
                stList.toDelete = [];

                stList.stimuli.forEach(function(item,index){
                    if (item.id) 
                        stList.toDelete.push(item.id)
                    if (!item.stimuli_text) 
                        stList.stimuli.splice(index, 1);

                    delete item.$id;
                    delete item.id;
                    delete item.created_at;
                    delete item.pivot;
                    delete item.updated_at;
                    delete item.user_id_owner;
                    item.stimuli_type_id = '1';
                });
                
                console.log('stList', stList);

                axios.post(
                    '/stimuli', {
                        data: stList,
                        _method: 'POST',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                ).then(function (response) {
                    console.log(response);
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
