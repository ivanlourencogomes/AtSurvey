<template>

    <div id="edit-stimuli-list">

        <button @click="showEditModal = !showEditModal" type="button" class="btn btn-link no-padding">Edit</button> |
        <button type="button" class="btn btn-link no-padding">Delete</button>

        <modal v-if="showEditModal" v-on:close-modal="showEditModal = false">

            <div slot="header" class="header-area w-100 expansible-parent">
                <h4 class="mb-3">
                    <input
                        @change="onDataChange()"
                        id="list_name"
                        v-model="stimuliList.list_info.list_name"
                        type="text"
                        class="form-control border-bottom-only pl-0"
                        name="list_name"
                        autofocus>
                        <span class="expand" @click="expandListInfo($event)"></span>
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

                <div class="view-filter">
                    <span @click="viewChange('card')" :class="{'selected' : isCardView == true }" class="card"></span>
                    <span @click="viewChange('list')" :class="{'selected' : isListView == true }" class="list"></span>
                </div>
                <div v-if="isListView" @click="this.deleteRow">
                        <vue-excel-editor   ref="grid" @update="onDataChange" :row-style="this.rowStyleC"    v-model="stimuliList.stimuli" new-if-bottom autocomplete no-footer multi-update enterToSouth>
                            <vue-excel-column   label="" field="deleteText"  width="40px" readonly />
                            <vue-excel-column field="stimuli_text"   label="Stimuli Text" width="400px" />
                            <vue-excel-column field="condition"   label="Condition" />
                            <vue-excel-column field="condition_code"   label="Condition Code" />
                            <vue-excel-column field="item"   label="Item" />
                            <vue-excel-column field="item_id"   label="Item Id" />
                            <vue-excel-column field="trial"   label="Trial" />

                        </vue-excel-editor>
                         <div class="add-record-btn">
                            <span >+</span> <a  @click="createRecord('list')">Add Stimuli</a>
                        </div>
                </div>

                <div class="card-view" v-else-if="isCardView">
<ul>
                        <li class="border-bottom border-top" v-for="(stimuli,index) in stimuliList.stimuli" :key="stimuli.id">
                            <span class='delete-icon' @click="deleteCardRecord(stimuli,index)" ></span>
                                <div v-if="stimuli.id || stimuli.new">
                            <!-- <edit-stimuli :stimuli="stimuli" :fieldTypes="fieldTypes" /> -->
                            <div class="row pb-3">
                                <h6>
                                    <textarea type="text" v-model="stimuli.stimuli_text" @keyup="onDataChange" />
                                </h6>
                            </div>

                            <div class="row mt-3">
                                <select class="fieldTypes" v-if="fieldTypes && stimuli.answerField" v-model="stimuli.answerField.field_type_id" @change = "answerFieldChange(stimuli,$event)">
                                    <option  v-for="fieldType in fieldTypes" :selected="stimuli.answerField && stimuli.answerField.field_type_id == fieldType.id" :key="fieldType.id"  :value="fieldType.id">{{fieldType.field_type_name}}</option>
                                </select>
                            </div>

                            <div class="row mt-3 d-block">
                                <template v-if="stimuli.answerField && stimuli.answerField.options && ([3,4,'3','4'].includes(stimuli.answerField.field_type_id))">
                                    <input
                                        class="d-block border-0"
                                        @change="onDataChange()"
                                        type="text"
                                        v-model="stimuli.answerField.label">

                                    <div v-for="(option, index) in stimuli.answerField.options" :key="index">
                                        <input :type="[4,'4'].includes(stimuli.answerField.field_type_id) ? 'radio' : 'checkbox'" :name="stimuli.answerField.label">
                                       <input
                                            class="mb-2 border-0 border-top-0 border-left-0 border-right-0"
                                            @change="onDataChange()"
                                            type="text"
                                            v-bind:placeholder="stimuli.answerField.options[index]"
                                            >
                                    </div>

                                </template>

                                <template v-else-if="stimuli.answerField">

                                    <label v-text="stimuli.answerField.label">

                                    </label>

                                    <input
                                        class="d-block mt-2"
                                        @change="onDataChange()"
                                        type="text"
                                        v-model="stimuli.answerField.placeholder">
                                </template>

                            </div>
                                </div>

                        </li>
                    </ul>
                    <div class="add-record-btn">
                            <span >+</span> <a  @click="createRecord('card')">Add Stimuli</a>
                        </div>
                </div>


                <!-- <table class="table stimuli-table border-bottom">
                    <thead>
                        <th></th>
                        <th>Stimuli Text</th>
                        <th>Condition</th>
                        <th>Condition Code</th>
                        <th>Item</th>
                        <th>Item Id</th>
                        <th>Trial</th>
                    </thead>
                    <tbody class="expansible-parent" v-for="stimuli in stimuliList.stimuli" :key="stimuli.id">

                        <tr class="main">
                            <td class="expand" @click="expandListInfo($event)"></td>
                            <td class="large"><textarea type="text" v-model="stimuli.stimuli_text" @keyup="onDataChange" /></td>
                            <td><input type="text" v-model="stimuli.condition" @keyup="onDataChange"></td>
                            <td><input type="text" v-model="stimuli.condition_code" @keyup="onDataChange"></td>
                            <td><input type="text" v-model="stimuli.item" @keyup="onDataChange"></td>
                            <td><input type="text" v-model="stimuli.item_id" @keyup="onDataChange"></td>
                            <td><input type="text" v-model="stimuli.trial" @keyup="onDataChange"></td>
                        </tr>
                        <tr class="expansible">
                            answer will go here
                        </tr>

                    </tbody>
                </table> -->

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
                listChanged: false,
                isListView: false,
                isCardView:false,
                toDelete:[]
            };
        },

        created(){

            let _this = this;
        console.log("CREATED stimuli length",this.stimuliList.stimuli.length);
             axios.post(
                    '/fieldtypes', {
                        data: '',
                        _method: 'GET',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                ).then(function (response) {

                    Vue.prototype.fieldTypes = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        mounted() {
            console.log("Stumuli",this.stimuliList.stimuli);

                this.isListView=true;



        },
        methods: {
            answerFieldChange(stimuli,e){
                const selectedValueText = e.target.selectedOptions[0].innerText;
                //LOOP THORUGH ALL FIELDTYPES AND FIND WHICH ONE IS SELECTED AND THEN POPULATE THE RESPECTIVE OPTIONS
                Vue.prototype.fieldTypes.forEach(element => {
                    if(element.field_type_name==selectedValueText){
                        var options = false;
                        try{
                            element.answer_field[0].options = JSON.parse(element.answer_field[0].options);

                        }
                        catch(err){
                            console.log(err);
                        }

                        stimuli.answerField = element.answer_field[0];

                    }
                });
            },
            viewChange(type){
                if(this.stimuliList.stimuli){
                    if(type=="card"){
                            this.isListView=false;
                            this.isCardView=true;
                }
                if(type=="list"){
                    this.isListView=true;
                    this.isCardView=false;
                }

                }

            },
            updateStimuliList() {

                let stimList = {}
        console.log("THIS STIMULI LIST",this.stimuliList);
                stimList.list_info = this.stimuliList.list_info;
                stimList.toDelete = this.toDelete;
                stimList.stimuli = this.stimuliList.stimuli;

                // let indexDeleted = [];

                // stimList.stimuli.forEach(function(item,index){
                //     if (item.id)
                //         stimList.toDelete.push(item.id)

                //     delete item.$id;
                //     delete item.id;
                //     delete item.created_at;
                //     delete item.pivot;
                //     delete item.updated_at;
                //     delete item.user_id_owner;
                //     item.stimuli_type_id = '1';

                //     if (!item.stimuli_text)
                //         indexDeleted.push(index)
                // });

                // for (var i = indexDeleted.length -1; i >= 0; i--)
                //     stimList.stimuli.splice(indexDeleted[i],1);

                const _this = this;

                axios.post(
                    '/stimuli', {
                        data: stimList,
                        _method: 'POST',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                ).then(function (response) {
                    console.log(response)

                    _this.stimuliList.stimuli = response.data;


                    if(!_this.stimuliList.stimuli.length) {
                        _this.stimuliList.stimuli = [{

                            deleteText:"",
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
             createRecord (type) {
                        console.log(type)
                 if(type=="card"){
                        console.log(this.stimuliList.stimuli)
                        var first_field = Vue.prototype.fieldTypes[0];
                        console.log(first_field)
                        this.stimuliList.stimuli.push({
                            answerField:first_field.answer_field[0],
                            deleteText:"",
                            condition: "",
                            condition_code: "",
                            item: "",
                            item_id: "",
                            stimuli_text: "",
                            stimuli_type_id: "",
                            trial: "",
                            new:true
                        });
                 }
                 if(type=="list"){
                     const rec = {
                    deleteText:"",
                    condition: "",
                    condition_code: "",
                    item: "",
                    item_id: "",
                    stimuli_text: "",
                    stimuli_type_id: "",
                    trial: ""
                }

        // Call this to new record
        this.$refs.grid.newRecord(rec)
                 }


    },
    deleteCardRecord(stimuli,index){
        console.log("TO DELETE ROW",stimuli);
        var deleteConfirm = confirm("Do you really want to delete ?");

            if(deleteConfirm == true){
                //DELETE THE ROW IF IT's NEWLY CREATED WITHOUT ADDITION TO DB
                if(stimuli.id == undefined){
                    console.log("DELETING")
                        this.stimuliList.stimuli.splice(index,1);
                }else{
                this.toDelete.push(stimuli.id);
               this.stimuliList.stimuli.splice(index,1);
                }
                this.listChanged=true;
            }
    }
    ,
    deleteRow(e){
        if(e.target.matches('.delete-icon')){
                //GET ROW NUMBEr
                var rows = Array.prototype.slice.call($("#systable tbody").children());
                var rowNo = rows.indexOf($(e.target).closest("tr")[0]);



            var deleteConfirm = confirm("Do you really want to delete ?");

            if(deleteConfirm == true){
                //DELETE THE ROW IF IT's NEWLY CREATED WITHOUT ADDITION TO DB
                if(this.stimuliList.stimuli[rowNo].id == undefined){
                        this.$refs.grid.deleteRecord(rowNo);
                        return;
                }
            this.toDelete.push(this.stimuliList.stimuli[rowNo].id);

                this.$refs.grid.deleteRecord(rowNo);
                this.listChanged=true;

                //SCRIPT FOR LIVE DELETING OF ROW
                // axios.post(
                //     '/stimuli', {
                //         data: {
                //             id:this.stimuliList.stimuli[rowNo].id
                //         },
                //         _method: 'DELETE',
                //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                //     }
                // ).then(function (response) {
                // if(response.status==200 && response.data.count>0){
                //         refData.grid.deleteRecord(rowNo);
                //     }
                //     console.log(response);
                //

                // })
                // .catch(function (error) {
                //     console.log(error);
                // });

            //
            }

        }
    }
    ,
    rowStyleC(row){
        //y.delete = "<i>SOMETHING</i>";
        if(document.getElementById("id-"+row.$id + "-deleteText") != null){
            document.getElementById("id-"+row.$id + "-deleteText").innerHTML = "<span class='delete-icon' ></span>";
        }



    }
    ,
            onDataChange () {
                this.listChanged = true;
                console.log(this.stimuliList)
            },

            expandListInfo(event) {
                $(event.target).closest(".expansible-parent").find(".expansible").first().slideToggle();
                $(event.target).toggleClass("rotate");
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
                        span{
                        &.delete-icon{

                        background-image: url('/images/delete.png');
                        width: 28px;
    height: 22px;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    display: inline-block;
    border: none;
    cursor: pointer !important;
    border-radius: 4px;
                        }
                        }
                }
            }
        }

        .modal-body {

            // .stimuli-table {

            //     thead {
            //         th:first-of-type {
            //             padding-left: 30px;
            //         }
            //     }
            //     tbody {

            //         tr.main {
            //             td > input, td > textarea {
            //                 border: none;
            //                 min-height: 40px;
            //             }

            //             td {
            //                 vertical-align: middle;
            //                 padding: 6px;
            //                 position: relative;

            //                 input {
            //                     min-height: 30px;
            //                 }

            //                 &.expand {
            //                     background-image: url(/images/down-arrow.png);
            //                     background-size: 12px;
            //                     background-position: center;
            //                     background-repeat: no-repeat;
            //                     opacity: 0.8;
            //                     cursor: pointer;
            //                     transition: 0.4s;
            //                     &.rotate {
            //                         transform: rotate(180deg);
            //                         transition: 0.4s;
            //                     }
            //                 }
            //             }
            //             td.large {
            //                 min-width: 360px;

            //                 input,textarea {
            //                     width: 100%;
            //                 }
            //             }
            //         }
            //     }
            // }

            .modal-header {
                border: none;
            }

            .view-filter {
                span {
                    width: 28px;
                    height: 22px;
                    background-size: contain;
                    background-repeat: no-repeat;
                    background-position: center;
                    display: inline-block;
                    border: none;
                    cursor: pointer;
                    border-radius: 4px;

                        &.card {
                            background-image: url('/images/view_visual.png');
                            &.selected {
                                background-image: url('/images/view_visual_selected.png');
                                background-color: black;
                            }
                        }

                        &.list {
                            background-image: url('/images/view_list.png');

                            &.selected {
                                background-image: url('/images/view_list_selected.png');
                                background-color: black;
                            }
                        }
                }
            }

            .card-view {
                ul {
                    padding: 0;
                    li {
                        padding: 15px;
                        span{
                        &.delete-icon{

                        background-image: url('/images/delete.png');
                        width: 28px;
    height: 22px;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    display: inline-block;
    border: none;
    cursor: pointer !important;
    border-radius: 4px;
    position: absolute;
    right: 0;
                        }
                        }
                        .row {

                            &.flex {
                                display: flex;
                                justify-content: space-between;
                            }
                            h6 {
                                margin: 0;
                                textarea {
                                    width: 400px;
                                    max-width: 100%;
                                    padding: 6px;
                                }
                            }

                            select {
                                    min-width: 120px;
                                    max-height: 40px;
                            }
                        }
                    }
                }
            }

            .modal-content {
                padding-top: 0;
            }

            h4 {
                display: flex;
                align-items: center;

                input {
                    font-size: 1.35rem;
                    color: black;
                    border: none;
                }

                .expand {
                    display: inline-block;
                    width: 14px;
                    height: 14px;
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
                padding-bottom: 24px;

                input, textarea {
                    margin-bottom: 8px;
                }

            }



            // .vue-excel-editor {
            //     tr td span {
            //         display: none;
            //     }
            // }
        }
    }


</style>
