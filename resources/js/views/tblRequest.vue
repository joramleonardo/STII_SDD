<template>
  <div class="container-fluid">
        <ol class="breadcrumb mt-4 mb-4" style="background-color: white; ">
            <li class="breadcrumb-item active">Home > Library > Request</li>
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
                            <b-form-group label="Status:" label-for="status" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                                <b-form-select v-model="trainingsData.status" id="status" :options="drop_status" required></b-form-select>
                            </b-form-group> 
                            <b-form-group label="Call Number:" label-for="callNumber" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData.callNumber" id="callNumber" type="text" placeholder="Enter name here..." required></b-form-input>
                            </b-form-group>
                            <b-form-group label="Source:" label-for="source" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData.source" id="source" type="text" placeholder="Enter name here..." required></b-form-input>
                            </b-form-group>
                            <b-form-group label="Title:" label-for="title" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData.title" id="title" type="text" placeholder="Enter name here..." required></b-form-input>
                            </b-form-group>
                            <b-form-group label="Vol Issue No:" label-for="volIssueNo" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData.volIssueNo" id="volIssueNo" type="text" placeholder="Enter name here..." required></b-form-input>
                            </b-form-group>
                            <b-form-group label="Num Pages:" label-for="numPages" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData.numPages" id="numPages" type="text" placeholder="Enter name here..." required></b-form-input>
                            </b-form-group>
                            <b-form-group label="Time Issued:" label-for="timeIssued" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-timepicker v-model="trainingsData.timeIssued" id="timeIssued" locale="en"></b-form-timepicker>
                            </b-form-group>
                            <b-form-group label="Time Received:" label-for="timeReceived" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-timepicker v-model="trainingsData.timeReceived" id="timeReceived" locale="en"></b-form-timepicker>
                            </b-form-group>
                            <b-form-group label="Time Returned:" label-for="timeReturned" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-timepicker v-model="trainingsData.timeReturned" id="timeReturned" locale="en"></b-form-timepicker>
                            </b-form-group>
                            <b-form-group label="Remarks:" label-for="remarks" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData.remarks" id="remarks" type="text" placeholder="Enter name here..." required></b-form-input>
                            </b-form-group>
                            <b-form-group label="Assisted By:" label-for="assistedBy" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData.assistedBy" id="assistedBy" type="text" placeholder="Enter name here..." required></b-form-input>
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
                            <b-form-group label="Status:" label-for="status" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                                <b-form-select v-model="trainingsData_update.status" id="status" :options="drop_status" required></b-form-select>
                            </b-form-group> 
                            <b-form-group label="Call Number:" label-for="callNumber" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData_update.callNumber" id="callNumber" type="text" placeholder="Enter name here..." required></b-form-input>
                            </b-form-group>
                            <b-form-group label="Source:" label-for="source" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData_update.source" id="source" type="text" placeholder="Enter name here..." required></b-form-input>
                            </b-form-group>
                            <b-form-group label="Title:" label-for="title" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData_update.title" id="title" type="text" placeholder="Enter name here..." required></b-form-input>
                            </b-form-group>
                            <b-form-group label="Vol Issue No:" label-for="volIssueNo" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData_update.volIssueNo" id="volIssueNo" type="text" placeholder="Enter name here..." required></b-form-input>
                            </b-form-group>
                            <b-form-group label="Num Pages:" label-for="numPages" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData_update.numPages" id="numPages" type="text" placeholder="Enter name here..." required></b-form-input>
                            </b-form-group>
                            <b-form-group label="Time Issued:" label-for="timeIssued" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-timepicker v-model="trainingsData_update.timeIssued" id="timeIssued" locale="en"></b-form-timepicker>
                            </b-form-group>
                            <b-form-group label="Time Received:" label-for="timeReceived" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-timepicker v-model="trainingsData_update.timeReceived" id="timeReceived" locale="en"></b-form-timepicker>
                            </b-form-group>
                            <b-form-group label="Time Returned:" label-for="timeReturned" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-timepicker v-model="trainingsData_update.timeReturned" id="timeReturned" locale="en"></b-form-timepicker>
                            </b-form-group>
                            <b-form-group label="Remarks:" label-for="remarks" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData_update.remarks" id="remarks" type="text" placeholder="Enter name here..." required></b-form-input>
                            </b-form-group>
                            <b-form-group label="Assisted By:" label-for="assistedBy" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData_update.assistedBy" id="assistedBy" type="text" placeholder="Enter name here..." required></b-form-input>
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
                    :items="trainings"
                    :fields="requestFields"
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
                status: null,
                callNumber:'',
                source:'',
                title:'',
                volIssueNo:'',
                numPages:'',
                timeIssued:'',
                timeReceived:'',
                timeReturned:'',
                remarks:'',
                assistedBy:''
            },
            trainingsData_update:{},
            drop_status: [{ text: 'Select Status here', value: null }, 'Hard copy', 'Digital copy', 'Not Available'],

            errors : '',
            totalRows: 1,
            currentPage: 1,
            perPage: 10,
            filterOn: [],
            filter: null,
            sortDirection: 'asc',
            sortBy: 'id',
            sortDesc: false,
            requestFields: [
                { key: 'name', label: 'Name' },
                { key: "transactionDate", label: "Transaction Date" },
                { key: "status", label: "Status" },
                { key: "callNumber", label: "Call Number" },
                { key: "source", label: "Source" },
                { key: "title", label: "Title" },
                { key: "volIssueNo", label: "Vol Issue No" },
                { key: "numPages", label: "Num Pages" },
                { key: "timeIssued", label: "Time Issued" },
                { key: "timeReceived", label: "Time Received" },
                { key: "timeReturned", label: "Time Returned" },
                { key: "remarks", label: "Remarks" },
                { key: "assistedBy", label: "Assisted By" },
                { key: 'actions', label: 'Action' }
            ]
            }
    },
    mounted() {
        this.loadTrainings();
        this.loadEmployees();
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
        loadEmployees: async function() {
            try{
                const response = await employeeService.loadEmployees();
                this.employees = response.data.data;
                this.totalRows = this.employees.length;
            } catch(error) {
                this.flashMessage.error({
                    message: 'Some error occured! Please try again.',
                    time: 5000
                });
            }
        },
        loadTrainings: async function() {
            try{
                const response = await employeeService.loadTrainings();
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
            formData.append('status', this.trainingsData.status);
            formData.append('callNumber', this.trainingsData.callNumber);
            formData.append('source', this.trainingsData.source);
            formData.append('title', this.trainingsData.title);
            formData.append('volIssueNo', this.trainingsData.volIssueNo);
            formData.append('numPages', this.trainingsData.numPages);
            formData.append('timeIssued', this.trainingsData.timeIssued);
            formData.append('timeReceived', this.trainingsData.timeReceived);
            formData.append('timeReturned', this.trainingsData.timeReturned);
            formData.append('remarks', this.trainingsData.remarks);
            formData.append('assistedBy', this.trainingsData.assistedBy);

            try {
                const response = await employeeService.createTraining(formData);
                console.log(response);
                this.hideEmployeeModal();
                this.flashMessage.success({
                    status: '',
                    message: 'Training added successfully!',
                    time: 5000
                });
                this.trainingsData = {
                    client_ID:'',
                    transactionDate:'',
                    status: null,
                    callNumber:'',
                    source:'',
                    title:'',
                    volIssueNo:'',
                    numPages:'',
                    timeIssued:'',
                    timeReceived:'',
                    timeReturned:'',
                    remarks:'',
                    assistedBy:''
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
                formData.append('status', this.trainingsData_update.status);
                formData.append('callNumber', this.trainingsData_update.callNumber);
                formData.append('source', this.trainingsData_update.source);
                formData.append('title', this.trainingsData_update.title);
                formData.append('volIssueNo', this.trainingsData_update.volIssueNo);
                formData.append('numPages', this.trainingsData_update.numPages);
                formData.append('timeIssued', this.trainingsData_update.timeIssued);
                formData.append('timeReceived', this.trainingsData_update.timeReceived);
                formData.append('timeReturned', this.trainingsData_update.timeReturned);
                formData.append('remarks', this.trainingsData_update.remarks);
                formData.append('assistedBy', this.trainingsData_update.assistedBy);

                formData.append("_method", "put");

                const response = await employeeService.updateTrainingData(this.trainingsData_update.id, formData);
                console.log(response);

                this.flashMessage.success({
                    status: '',
                    message: 'Training updated successfully!',
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
                const response = await employeeService.deleteTraining(trainings_Data.id);
                console.log(response);
                this.flashMessage.success({
                    status: '',
                    message: 'Training deleted successfully!',
                    time: 5000
                });
            }
            catch (e) {
                this.flashMessage.success({
                    status: '',
                    message: 'Training deleted successfully!',
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