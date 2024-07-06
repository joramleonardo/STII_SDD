<template>
  <div class="container-fluid">
        <ol class="breadcrumb mt-4 mb-4" style="background-color: white; ">
            <li class="breadcrumb-item active">Home > Library > Research Log</li>
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
              <b-form v-on:submit.prevent="createTraining">
                <b-card no-body>
                    <b-card bg-variant="light">
                            <b-form-group label="Client ID:" label-for="client_ID" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData.client_ID" id="client_ID" type="text" placeholder="Enter name here..." required></b-form-input>
                            </b-form-group>
                            <b-form-group label="Transaction Date:" label-for="transactionDate" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-datepicker v-model="trainingsData.transactionDate" id="transactionDate" locale="en"></b-form-datepicker>
                            </b-form-group>
                            <b-form-group label="Subject Research:" label-for="subjectResearch" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                                <b-form-select v-model="trainingsData.subjectResearch" id="subjectResearch" :options="drop_subjectResearch" required></b-form-select>
                            </b-form-group> 
                    </b-card> 
                </b-card>
                <div class="float-right">
                    <b-button type="button" class="btn btn-default" variant="outline-danger" v-on:click="hideEmployeeModal">Cancel</b-button>
                    <b-button type="submit" class="btn" variant="outline-success" >Save</b-button> 
                </div>
              </b-form>
            </b-modal>
            
            <b-modal id="updateEmployeeModal" ref="updateEmployeeModal" title="Add New Training" hide-footer>
              <b-form v-on:submit.prevent="updateEmployee">
                <b-card no-body>
                    <b-card bg-variant="light">
                            <b-form-group label="Client ID:" label-for="client_ID" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData_update.client_ID" id="client_ID" type="text" placeholder="Enter name here..." required></b-form-input>
                            </b-form-group>
                            <b-form-group label="Transaction Date:" label-for="transactionDate" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-datepicker v-model="trainingsData_update.transactionDate" id="transactionDate" locale="en"></b-form-datepicker>
                            </b-form-group>
                            <b-form-group label="Subject Research:" label-for="subjectResearch" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                                <b-form-select v-model="trainingsData_update.subjectResearch" id="subjectResearch" :options="drop_subjectResearch" required></b-form-select>
                            </b-form-group> 
                    </b-card> 
                </b-card>
                <div class="float-right">
                    <b-button type="button" class="btn btn-default" variant="outline-danger" v-on:click="hideEmployeeModal">Cancel</b-button>
                    <b-button type="submit" class="btn" variant="outline-success">Save</b-button> 
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
                    
                    :fields="researchLogFields"
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
            trainings: [],
            trainingsData:{
                client_ID:'',
                transactionDate:'',
                subjectResearch: null,
            },
            trainingsData_update:{},
            drop_subjectResearch: [{ text: 'Select Status here', value: null }, 'Acoustics',
                                                                                'Agricultural Economics & Policy',
                                                                                'Agricultural Engineering',
                                                                                'Agriculture, Dairy & Animal Science',
                                                                                'Agriculture, Multidisciplinary',
                                                                                'Agriculture, Soil Science',
                                                                                'Agronomy',
                                                                                'Allergy',
                                                                                'Anatomy & Morphology',
                                                                                'Andrology',
                                                                                'Anesthesiology'],

            errors : '',
            totalRows: 1,
            currentPage: 1,
            perPage: 10,
            filterOn: [],
            filter: null,
            sortDirection: 'asc',
            sortBy: 'id',
            sortDesc: false,
            researchLogFields: [
                { key: 'name', label: 'Name' },
                { key: "transactionDate", label: "Transaction Date" },
                { key: "subjectResearch", label: "Subject Research" },
                { key: 'actions', label: 'Action' }
            ]
            }
    },
    mounted() {
        this.loadTrainings();
    },
    methods: {
        showUpdateMdl(data){
            this.trainingsData_update = {...data}
            this.$refs.updateEmployeeModal.show()
        },
        hideUpdateMdl(data){
            this.trainingsData_update = {...data}
            this.$refs.updateEmployeeModal.hide()
        },
        clearModal(){
            this.$refs.add-employee.removeData();
        },
        loadTrainings: async function() {
            try{
                const response = await employeeService.loadResearchLog();
                this.trainings = response.data;
                console.log(this.trainings);
            } catch(error) {
                this.flashMessage.error({
                message: 'Some error occured! Please try again.',
                time: 5000
                });
            }
        },
        createTraining: async function() {
            let formData = new FormData();

            formData.append('client_ID', this.trainingsData.client_ID);
            formData.append('transactionDate', this.trainingsData.transactionDate);
            formData.append('subjectResearch', this.trainingsData.subjectResearch);

            try {
                const response = await employeeService.createResearchLog(formData);
                console.log(response);
                this.hideEmployeeModal();
                this.flashMessage.success({
                    status: '',
                    message: 'Research Log added successfully!',
                    time: 5000
                });
                this.trainingsData = {
                    client_ID:'',
                    transactionDate:'',
                    subjectResearch: null
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
            this.loadTrainings();
            this.clearModal();
        },
        updateEmployee: async function() {
            try {

                let formData = new FormData();
                
                formData.append('client_ID', this.trainingsData_update.client_ID);
                formData.append('transactionDate', this.trainingsData_update.transactionDate);
                formData.append('subjectResearch', this.trainingsData_update.subjectResearch);

                formData.append("_method", "put");

                const response = await employeeService.updateResearchLogData(this.trainingsData_update.id, formData);
                console.log(response);

                this.flashMessage.success({
                    status: '',
                    message: 'Research Log updated successfully!',
                    time: 5000
                });
                this.loadTrainings();

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
            this.loadTrainings();
            this.hideUpdateMdl();
        },
        deleteEmployee: async function(data){
            var trainings_Data = {...data}
            try {
                const response = await employeeService.deleteResearchLog(trainings_Data.id);
                console.log(response);
                this.flashMessage.success({
                    status: '',
                    message: 'Research Log deleted successfully!',
                    time: 5000
                });
            }
            catch (e) {
                this.flashMessage.success({
                    status: '',
                    message: 'Research Log deleted successfully!',
                    time: 5000
                });
            }
            this.loadTrainings();
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