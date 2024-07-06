<template>
  <div class="container-fluid">
    <h1 class="mt-4 stii-font-color-red">DOSTv</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Home > DOSTv > ExperTalk Views</li>
    </ol>
    <div class="row">
      <div class="col-xl-12">
        <div class="card mb-4">
          <div class="card-header card-header-title" style="background-color: #ed262a; color: white">
            <i class="fas fa-list-alt mr-1"></i>
            LIST OF EXPERTALK VIEWS
            <b-button v-b-modal.add-employee class="float-right" style="background-color:white; color:black">
                <i class="fas fa-plus-square"></i>
            </b-button>
          </div>
            <div class="card-tools">
                <!--<b-row align-h="end">-->
                <b-row >
                    <b-col lg="10" class="mt-3">
                        <b-form-group label="Search" label-for="filter-input" label-cols-sm="2" label-align-sm="center">
                            <b-input-group>
                                <b-form-input id="filter-input" v-model="filter" type="search" placeholder="Type to Search" v-on:keydown="returnPaginate($event)"></b-form-input>
                                <!--<b-input-group-append>
                                    <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
                                </b-input-group-append>-->
                            </b-input-group>
                        </b-form-group>
                    </b-col>
                </b-row>
            </div>
            <div class="card-body table-responsive p-4">
                <div>
                    <b-table striped hover 
                    :items="employees"
                    :fields="expertalkFields"
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
    <b-modal id="add-employee" ref="add-employee" title="Add New Event" hide-footer>
        <b-form v-on:submit.prevent="createEmployee">
        <b-card no-body>
            <b-card bg-variant="light">
                    <b-form-group label="Activity Title:" label-for="activityTitle" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.activityTitle" id="activityTitle" type="text" placeholder="Enter Activity Title here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Date:" label-for="date" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-datepicker v-model="employeeData.date" id="date" locale="en"></b-form-datepicker>
                    </b-form-group>
                    <b-form-group label="Venue:" label-for="venue" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.venue" id="venue" type="text" placeholder="Enter venue here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Partner Institutions:" label-for="partnerInstitutions" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.partnerInstitutions" id="partnerInstitutions" type="text" placeholder="Enter Partner Institutions here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Topic:" label-for="topic" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.topic" id="topic" type="text" placeholder="Enter topic here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Speaker ID:" label-for="speaker_id" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.speaker_id" id="speaker_id" type="text" placeholder="Enter Speaker ID here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Status:" label-for="status" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData.status" id="status" :options="drop_status" required></b-form-select>
                    </b-form-group>
            </b-card> 
        </b-card>
        <div class="float-right">
            <b-button type="button" class="btn btn-default" variant="outline-danger" v-on:click="hideEmployeeModal">Cancel</b-button>
            <b-button type="submit" class="btn" variant="outline-success" >Save</b-button> 
        </div>
        </b-form>
    </b-modal>
    <b-modal id="updateEmployeeModal" ref="updateEmployeeModal" title="Update Event Details" hide-footer>
        <b-form v-on:submit.prevent="updateEmployee">
        <b-card no-body>
            <b-card bg-variant="light">
                    <b-form-group label="Date Aired:" label-for="dateAired" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-datepicker v-model="employeeData_update.dateAired" id="dateAired" locale="en"></b-form-datepicker>
                    </b-form-group>
                    <b-form-group label="Topic:" label-for="topic" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.topic" id="topic" type="text" placeholder="Enter Activity Title here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Description:" label-for="description" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.description" id="description" type="text" placeholder="Enter Activity Title here..." required></b-form-input>
                    </b-form-group>


                    <!--
                    <b-form-group label="Venue:" label-for="venue" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.venue" id="venue" type="text" placeholder="Enter venue here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Partner Institutions:" label-for="partnerInstitutions" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.partnerInstitutions" id="partnerInstitutions" type="text" placeholder="Enter Partner Institutions here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Topic:" label-for="topic" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.topic" id="topic" type="text" placeholder="Enter topic here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Speaker ID:" label-for="speaker_id" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.speaker_id" id="speaker_id" type="text" placeholder="Enter Speaker ID here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Status:" label-for="status" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData_update.status" id="status" :options="drop_status" required></b-form-select>
                    </b-form-group>
                    -->
                    <!--
                        activityTitle
                        venue
                        partnerInstitutions
                        topic
                        speaker_id
                        status
                    -->
            </b-card> 
        </b-card>
        <div class="float-right">
            <b-button type="button" class="btn btn-default" variant="outline-danger" v-on:click="hideEmployeeModal">Cancel</b-button>
            <b-button type="submit" class="btn" variant="outline-success" >Save</b-button> 
        </div>
        </b-form>
    </b-modal>
  </div>
  
</template>

<style>
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
import * as employeeService from '../services/dostv_service';

export default {
    name: 'employee',
    data() {
        return {
            employees: [],
            employeeData:{
                activityTitle:'',
                date:'',
                venue:'',
                partnerInstitutions:'',
                topic:'',
                speaker_id:'',
                status:null,
            },
            employeeData_update:{},
            radio_sex: [{ text: 'Male', value: 'Male' },{ text: 'Female', value: 'Female'}],
            drop_status: [{ text: 'Select Status here', value: null }, 'Requested', 'Initiated'],

            errors : '',
            totalRows: 1,
            currentPage: 1,
            perPage: 10,
            filterOn: [],
            filter: null,
            sortDirection: 'asc',
            sortBy: 'id',
            sortDesc: false,
            fields: [
                { key: 'id', label: 'Event ID'},
                { key: 'activityTitle', label: 'Activity Title'},
                { key: 'venue', label: 'Venue'},
                { key: 'partnerInstitutions', label: 'Partner Institutions' },
                { key: 'topic', label: 'Topic'},
                // { key: 'speaker_id', label: 'Resource Speakers'},
                // { key: 'status', label: 'Status'},
                { key: 'actions', label: 'Action' }
            ],
            expertalkFields: [
                { key: 'reach', label: 'Reach' },
                { key: 'views', label: 'Views' },
                { key: 'engagement', label: 'Engagement' },
                { key: 'platform', label: 'Platform' },
            ]
            }
    },
    mounted() {
        this.loadExpertalkViews();
       
    },
    methods: {
        showUpdateMdl(data){
            this.employeeData_update = {...data}
            this.$refs.updateEmployeeModal.show()
        },
        hideUpdateMdl(data){
            this.employeeData_update = {...data}
            this.$refs.updateEmployeeModal.hide()
        },
        clearModal(){
            this.$refs.add-employee.removeData();
        },
        loadExpertalkViews: async function() {
            try{
                const response = await employeeService.loadExpertalkViews();
                this.employees = response.data.data;
                this.totalRows = this.employees.length;
            } catch(error) {
                this.flashMessage.error({
                message: 'Some error occured! Please try again.',
                time: 5000
                });
            }
        },
        createEmployee: async function() {
            let formData = new FormData();
            formData.append('activityTitle', this.employeeData.activityTitle);
            formData.append('date', this.employeeData.date);
            formData.append('venue', this.employeeData.venue);
            formData.append('partnerInstitutions', this.employeeData.partnerInstitutions);
            formData.append('topic', this.employeeData.topic);
            formData.append('speaker_id', this.employeeData.speaker_id);
            formData.append('status', this.employeeData.status);

            try {
                const response = await employeeService.createAccount(formData);
                console.log(response);
                this.hideEmployeeModal();
                this.flashMessage.success({
                    status: '',
                    message: 'Employee added successfully!',
                    time: 5000
                });
                this.employeeData = {
                    activityTitle:'',
                    date:'',
                    venue:'',
                    partnerInstitutions:'',
                    topic:'',
                    speaker_id:'',
                    status:null,
                }
            } catch (error) {
                switch (error.response.status) {
                    case 422:
                        this.errors = error.response.data.errors;
                        break;
                    default:
                        this.flashMessage.error({
                            message: 'Some error occured! Please try again.',
                            time: 5000
                        });
                    break;
                }
            }
            this.loadExpertalkViews();
            this.clearModal();
        },
        updateEmployee: async function() {
            try {

                let formData = new FormData();
                formData.append('activityTitle', this.employeeData_update.activityTitle);
                formData.append('date', this.employeeData_update.date);
                formData.append('venue', this.employeeData_update.venue);
                formData.append('partnerInstitutions', this.employeeData_update.partnerInstitutions);
                formData.append('topic', this.employeeData_update.topic);
                formData.append('speaker_id', this.employeeData_update.speaker_id);
                formData.append('status', this.employeeData_update.status);

                formData.append("_method", "put");

                const response = await employeeService.updateEmployeeData(this.employeeData_update.id, formData);
                console.log(response);

                this.flashMessage.success({
                    status: '',
                    message: 'Employee updated successfully!',
                    time: 5000
                });
                this.loadExpertalkViews();

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
            this.loadExpertalkViews();
            this.hideUpdateMdl();
        },
        deleteEmployee: async function(data){
            var employee_data = {...data}
            try {
                const response = await employeeService.deleteEmployee(employee_data.id);
                console.log(response);
                this.flashMessage.success({
                    status: '',
                    message: 'Employee deleted successfully!',
                    time: 5000
                });
            }
            catch (e) {

            }
            this.loadExpertalkViews();
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