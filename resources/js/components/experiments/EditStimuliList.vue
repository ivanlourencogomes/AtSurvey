<template>

    <div id="edit-stimuli-list">
        
        <button @click="showEditModal = !showEditModal" type="button" class="btn btn-link no-padding">Edit</button> |
        <button type="button" class="btn btn-link no-padding">Delete</button>

        <modal v-if="showEditModal" v-on:close-modal="showEditModal = false">
            
            <div slot="header" class="header-area pb-4 w-100">
                <h4 class="mb-3">
                    <input 
                        @change="onDataChange()"
                        id="list_name" 
                        v-model="stimuliList.list_info.list_name"
                        type="text" 
                        class="form-control border-bottom-only pl-0" 
                        name="list_name" 
                        autofocus>
                        <span class="expand" @click="expandListInfo()"></span>
                </h4>
                <div class="expansible">
                            
                    <label for="list_description" class="col-form-label">List Description</label>

                    <div class="">
                        <textarea 
                        @change="onDataChange()"
                        id="list_description"  
                        class="form-control" 
                        name="list_description"
                        v-model="stimuliList.list_info.list_description">
                        </textarea>
                        
                    </div>
                    
                    <label for="list_description" class="col-form-label">Stimuli per Page</label>

                    <div>
                        <input 
                        @change="onDataChange()"
                        id="stimuli_per_page" 
                        v-model="stimuliList.list_info.stimuli_per_page"
                        type="number" 
                        class="form-control" 
                        name="stimuli_per_page" 
                        autofocus>
                    </div>

                   
                    <div> 
                        <input 
                        @change="onDataChange()"
                        type="checkbox" 
                        id="is_public" 
                        class="mr-1"
                        name="is_public" 
                        v-bind:true-value="1"
                        v-bind:false-value="0"
                        v-model="stimuliList.list_info.is_public"
                        value="stimuliList.list_info.is_public">
                         <label class="col-form-label" for="is_public">Make this list public</label>
                    </div>


                </div>
            </div>

           <div slot="content">
                 <vue-excel-editor @update="onDataChange" v-if="stimuliList.stimuli" v-model="stimuliList.stimuli" new-if-bottom autocomplete no-footer multi-update enterToSouth>
                    <vue-excel-column field="stimuli_text"   label="Stimuli Text" width="400px" />
                    <vue-excel-column field="condition"   label="Condition" />
                    <vue-excel-column field="condition_code"   label="Condition Code" />
                    <vue-excel-column field="item"   label="Item" />
                    <vue-excel-column field="item_id"   label="Item Id" />
                    <vue-excel-column field="trial"   label="Trial" />
                </vue-excel-editor>

                <button :disabled="!listChanged" @click="updateStimuliList" class="px-4 d-block btn btn-primary mt-4">Save</button>
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
                showEditModal: false,
                listChanged: false
            };
        },
        mounted() {
            if(!this.stimuliList.stimuli.length) {
                this.stimuliList.stimuli = [{
                    condition: "",
                    condition_code: "",
                    item: "",
                    item_id: "",
                    stimuli_text: "",
                    stimuli_type_id: "",
                    trial: ""
                }];
            }
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
                    
                    
                    if(!_this.stimuliList.stimuli.length) {
                        _this.stimuliList.stimuli = [{
                            condition: "",
                            condition_code: "",
                            item: "",
                            item_id: "",
                            stimuli_text: "",
                            stimuli_type_id: "",
                            trial: ""
                        }];
                    }

                    _this.listChanged = false;
                })
                .catch(function (error) {
                    console.log(error);            
                });
            },

            onDataChange () {
                this.listChanged = true;
            },

            expandListInfo() {
                $(".expansible").slideToggle();
                $(".modal-header h4 .expand").toggleClass("rotate");
                $(".modal-header .header-area ").toggleClass("border-bottom");
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

        .modal-body {
            
            .modal-header {
                border: none;
            }

            h4 {
                display: flex;
                align-items: center;

                input {
                    font-size: 1.35rem;
                    color: black;
                }

                .expand {
                    display: inline-block;
                    width: 20px;
                    height: 20px;
                    background-image: url('/images/down-arrow.png');
                    background-size: contain;
                    opacity: 0.8;
                    cursor: pointer;
                    transition: 0.4s;
                    position: absolute;
                    right: 30px;

                    &.rotate {
                        transform: rotate(180deg);
                        transition: 0.4s;
                    }
                }
            }
            

            .expansible {
                width: 400px;
                max-width: 100%;
                display: none;

                input, textarea {
                    margin-bottom: 8px;
                }

            }
        }
    }
    

</style>
