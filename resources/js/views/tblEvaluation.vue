<template>
  <div class="container-fluid">
        <ol class="breadcrumb mt-4 mb-4" style="background-color: white; ">
            <li class="breadcrumb-item active">Home > Library > Evaluation</li>
        </ol>
    <div class="row">
      <div class="col-xl-12">
        <div class="card mb-4">
          <div class="card-header card-header-title" style="background-color: #ed262a; color: white">
            <!--
            <i class="fas fa-list-alt mr-1"></i>
            LIST OF DATA
            -->
            <b-button v-b-modal.add-employee class="float-right" style="background-color:white; color:black"><i class="fas fa-plus-square"></i></b-button>
            <b-modal id="add-employee" ref="add-employee" title="Add New Data" hide-footer>
              <b-form v-on:submit.prevent="createHealth">
                <b-card no-body>
                    <b-card bg-variant="light">
                        <b-form-group label="Client ID:" label-for="client_ID" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                            <b-form-input v-model="healthData.client_ID" id="client_ID" type="text" placeholder="Enter name here..." required></b-form-input>
                        </b-form-group>
                        <b-form-group label="Transaction Date:" label-for="transactionDate" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                            <b-form-datepicker v-model="healthData.transactionDate" id="transactionDate" locale="en"></b-form-datepicker>
                        </b-form-group>
                        <b-form-group label="Relevance of the collection to the information needs:" label-for="eval_1" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                            <b-form-select v-model="healthData.eval_1" id="eval_1" :options="drop_eval_1" required></b-form-select>
                        </b-form-group> 
                        <b-form-group label="Promptness and immediate attention of staff:" label-for="eval_2" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                            <b-form-select v-model="healthData.eval_2" id="eval_2" :options="drop_eval_2" required></b-form-select>
                        </b-form-group> 
                        <b-form-group label="Knowledgeable and competent staff:" label-for="eval_3" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                            <b-form-select v-model="healthData.eval_3" id="eval_3" :options="drop_eval_3" required></b-form-select>
                        </b-form-group> 
                        <b-form-group label="Courteousness and approachability of staff:" label-for="eval_4" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                            <b-form-select v-model="healthData.eval_4" id="eval_4" :options="drop_eval_4" required></b-form-select>
                        </b-form-group> 
                        <b-form-group label="Material Not Found:" label-for="materialNotFound" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                            <b-form-input v-model="healthData.materialNotFound" id="materialNotFound" type="text" placeholder="Enter name here..." required></b-form-input>
                        </b-form-group>
                        <b-form-group label="Suggestions:" label-for="suggestions" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                            <b-form-input v-model="healthData.suggestions" id="suggestions" type="text" placeholder="Enter name here..." required></b-form-input>
                        </b-form-group>

                    </b-card> 
                </b-card>
                <div class="float-right">
                    <b-button type="button" class="btn btn-default" variant="outline-danger" v-on:click="hideEmployeeModal">Cancel</b-button>
                    <b-button type="submit" class="btn" variant="outline-success" >Save</b-button> 
                </div>
              </b-form>
            </b-modal>
            <b-modal id="updateEmployeeModal" ref="updateEmployeeModal" title="Add New Employee" hide-footer>
              <b-form v-on:submit.prevent="updateEmployee">
                <b-card no-body>
                    <b-card bg-variant="light">
                        <b-form-group label="Client ID:" label-for="client_ID" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                            <b-form-input v-model="healthData_update.client_ID" id="client_ID" type="text" placeholder="Enter name here..." required></b-form-input>
                        </b-form-group>
                        <b-form-group label="Transaction Date:" label-for="transactionDate" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                            <b-form-datepicker v-model="healthData_update.transactionDate" id="transactionDate" locale="en"></b-form-datepicker>
                        </b-form-group>
                        <b-form-group label="Relevance of the collection to the information needs:" label-for="eval_1" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                            <b-form-select v-model="healthData_update.eval_1" id="eval_1" :options="drop_eval_1" required></b-form-select>
                        </b-form-group> 
                        <b-form-group label="Promptness and immediate attention of staff:" label-for="eval_2" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                            <b-form-select v-model="healthData_update.eval_2" id="eval_2" :options="drop_eval_2" required></b-form-select>
                        </b-form-group> 
                        <b-form-group label="Knowledgeable and competent staff:" label-for="eval_3" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                            <b-form-select v-model="healthData_update.eval_3" id="eval_3" :options="drop_eval_3" required></b-form-select>
                        </b-form-group> 
                        <b-form-group label="Courteousness and approachability of staff:" label-for="eval_4" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                            <b-form-select v-model="healthData_update.eval_4" id="eval_4" :options="drop_eval_4" required></b-form-select>
                        </b-form-group> 
                        <b-form-group label="Material Not Found:" label-for="materialNotFound" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                            <b-form-input v-model="healthData_update.materialNotFound" id="materialNotFound" type="text" placeholder="Enter name here..." required></b-form-input>
                        </b-form-group>
                        <b-form-group label="Suggestions:" label-for="suggestions" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                            <b-form-input v-model="healthData_update.suggestions" id="suggestions" type="text" placeholder="Enter name here..." required></b-form-input>
                        </b-form-group>
                    </b-card> 
                </b-card>
                <div class="float-right">
                    <b-button type="button" class="btn btn-default" variant="outline-danger" v-on:click="hideEmployeeModal">Cancel</b-button>
                    <b-button type="submit" class="btn" variant="outline-success" >Save</b-button> 
                </div>
              </b-form>
            </b-modal>
          </div>
            <div class="card-tools">
                <b-row >
                    <b-col lg="10" class="mt-3">
                        <b-form-group label="Search" label-for="filter-input" label-cols-sm="2" label-align-sm="center">
                            <b-input-group>
                                <b-form-input id="filter-input" v-model="filter" type="search" placeholder="Type to Search" v-on:keydown="returnPaginate($event)"></b-form-input>
                            </b-input-group>
                        </b-form-group>
                    </b-col>
                </b-row>
            </div>
            <div class="card-body table-responsive p-4">
                <div>
                    <b-table striped hover 
                    :items="healths"
                    :fields="evaluationFields"
                    :sort-by.sync="sortBy"
                    :sort-desc.sync="sortDesc"
                    sort-icon-left
                    responsive="sm"
                    :filter="filter"
                    :current-page="currentPage"
                    :per-page="perPage"
                    :filter-included-fields="filterOn">
                        <template #cell(actions)="row">
                            <b-button size="sm" variant="success" @click="showUpdateMdl(row.item, row.index, $event.target)" class="mr-1 button-shadow jkl-btn-edit">
                                <i class="fas fa-user-edit"></i>
                            </b-button>
                            <b-button size="sm" variant="danger" @click="deleteEmployee(row.item, row.index, $event.target)" class="mr-1 button-shadow jkl-btn-delete">
                                <i class="fas fa-trash"></i>
                            </b-button>
                        </template>
                    </b-table>
                </div>
                <div class="my-1">
                    <b-pagination v-model="currentPage" :total-rows="totalRows" :per-page="perPage" align="center" class="my-0">
                    </b-pagination>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
    .breadcrumb-item.active{
        color:black;
    }
    .font-weight-800{
        font-weight: 800;
    }
    .font-weight-700{
        font-weight: 700;
    }
    .font-weight-600{
        font-weight: 600;
    }
</style>

<script>
import * as employeeService from '../services/library_service';
export default {
    name: 'employee',
    data() {
        return {
            healths: [],
            healthData:{
                client_ID:'',
                transactionDate:'',
                eval_1: null,
                eval_2: null,
                eval_3: null,
                eval_4: null,
                materialNotFound:'',
                suggestions:''
            },
            healthData_update:{},
            drop_eval_1: [{ text: 'Select Rating here', value: null }, '5 - Outstanding', '4 - VS', '3 - Satisfactory', '2 - Fair', '1 - Poor'],
            drop_eval_2: [{ text: 'Select Rating here', value: null }, '5 - Outstanding', '4 - VS', '3 - Satisfactory', '2 - Fair', '1 - Poor'],
            drop_eval_3: [{ text: 'Select Rating here', value: null }, '5 - Outstanding', '4 - VS', '3 - Satisfactory', '2 - Fair', '1 - Poor'],
            drop_eval_4: [{ text: 'Select Rating here', value: null }, '5 - Outstanding', '4 - VS', '3 - Satisfactory', '2 - Fair', '1 - Poor'],

            errors : '',
            totalRows: 1,
            currentPage: 1,
            perPage: 10,
            filterOn: [],
            filter: null,
            sortDirection: 'asc',
            sortBy: 'id',
            sortDesc: false,
            evaluationFields: [
                { key: 'name', label: 'Name' },
                { key: "transactionDate", label: "Transaction Date" },
                { key: "eval_1",label:"Relevance of the collection to the information needs"},
                { key: "eval_2",label: "Promptness and immediate attention of staff"},
                { key: "eval_3",label: "Knowledgeable and competent staff"},
                { key: "eval_4",label: "Courteousness and approachability of staff"},
                { key: "materialNotFound", label: "Material Not Found" },
                { key: "suggestions", label: "Suggestions / Recommendations" },
                { key: 'actions', label: 'Action' }
            ]
        }
    },
    mounted() {
        this.loadHealth();
       
    },
    methods: {
        showUpdateMdl(data){
            this.healthData_update = {...data}
            this.$refs.updateEmployeeModal.show()
        },
        hideUpdateMdl(data){
            this.healthData_update = {...data}
            this.$refs.updateEmployeeModal.hide()
        },
        clearModal(){
            this.$refs.add-employee.removeData();
        },
        loadHealth: async function() {
            try{
                const response = await employeeService.loadHealth();
                this.healths = response.data;
            } catch(error) {
                this.flashMessage.error({
                message: 'Some error occured! Please try again.',
                time: 5000
                });
            }
        },
        createHealth: async function() {
            let formData = new FormData();
            formData.append('client_ID', this.healthData.client_ID);
            formData.append('transactionDate', this.healthData.transactionDate);
            formData.append('eval_1', this.healthData.eval_1);
            formData.append('eval_2', this.healthData.eval_1);
            formData.append('eval_3', this.healthData.eval_1);
            formData.append('eval_4', this.healthData.eval_1);
            formData.append('materialNotFound', this.healthData.materialNotFound);
            formData.append('suggestions', this.healthData.suggestions);

            try {
                const response = await employeeService.createHealth(formData);
                console.log(response);
                this.hideEmployeeModal();
                this.flashMessage.success({
                    status: '',
                    message: 'Health condition added successfully!',
                    time: 5000
                });
                this.healthData = {
                    client_ID:'',
                    transactionDate:'',
                    eval_1: null,
                    eval_2: null,
                    eval_3: null,
                    eval_4: null,
                    materialNotFound:'',
                    suggestions:''
                }
            } catch (error) {
                switch (error.response.status) {
                    case 422:
                        this.errors = error.response.data.errors;
                        break;
                    default:
                        this.flashMessage.error({
                            message: 'Some error occurred, Please try again!',
                            time: 5000
                        });
                    break;
                }
            }
            this.loadHealth();
            this.clearModal();
        },
        updateEmployee: async function() {
            try {

                let formData = new FormData();
                formData.append('client_ID', this.healthData_update.client_ID);
                formData.append('transactionDate', this.healthData_update.transactionDate);
                formData.append('eval_1', this.healthData_update.eval_1);
                formData.append('eval_2', this.healthData_update.eval_1);
                formData.append('eval_3', this.healthData_update.eval_1);
                formData.append('eval_4', this.healthData_update.eval_1);
                formData.append('materialNotFound', this.healthData_update.materialNotFound);
                formData.append('suggestions', this.healthData_update.suggestions);

                formData.append("_method", "put");

                const response = await employeeService.updateHealthData(this.healthData_update.id, formData);
                console.log(response);

                this.flashMessage.success({
                    status: '',
                    message: 'Health condition updated successfully!',
                    time: 5000
                });

            } catch (error) {
                switch (error.response.status) {
                    case 422:
                        this.errors = error.response.data.errors;
                        break;
                    default:
                        this.flashMessage.error({
                            message: 'Some error occurred, Please try again!',
                            time: 5000
                        });
                    break;
                }
            }
            this.loadHealth();
            this.hideUpdateMdl();
        },
        deleteEmployee: async function(data){
            var health_Data = {...data}
            try {
                const response = await employeeService.deleteHealths(health_Data.id);
                console.log(response);
                this.flashMessage.success({
                    status: '',
                    message: 'Health Condition deleted successfully!',
                    time: 5000
                });
            }
            catch (e) {
                this.flashMessage.error({
                    message: 'Some error occured! Please try again.',
                    time: 5000
                    });
            }
            this.loadHealth();
        },
        hideEmployeeModal() {
            this.$refs['add-employee'].hide();
        },
        showEmployeeModal() {
            this.$refs.add-employee.show();
        }
    }
}

</script>