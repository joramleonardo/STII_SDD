<template>
  <div class="container-fluid">
        <ol class="breadcrumb mt-4 mb-4" style="background-color: white; ">
            <li class="breadcrumb-item active">Home > Records > Science Journo Ako</li>
        </ol>
    
    <div class="row">
      <div class="col-xl-12">
        <div class="card mb-4">
          <div class="card-header card-header-title" style="background-color: #ed262a; color: white">
            <i class="fas fa-list-alt mr-1"></i>
            LIST OF DATA
            <b-modal id="htData" ref="htData" title="Add New Employee" hide-footer>
                <b-tabs card>  
                    <b-tab title="Speaker">
                        <div class="card-body table-responsive p-4">
                            <div>
                                <b-table striped hover 
                                    :items="employees_trainingData"
                                    :fields="speakerFields"
                                    :sort-by.sync="sortBy"
                                    :sort-desc.sync="sortDesc"
                                    sort-icon-left
                                    responsive="sm"
                                    :filter="filter"
                                    :current-page="currentPage"
                                    :per-page="perPage"
                                    :filter-included-fields="filterOn">
                                </b-table>
                            </div>
                            <div class="my-1">
                                <b-pagination v-model="currentPage" :total-rows="totalRows" :per-page="perPage" align="center" class="my-0">
                                </b-pagination>
                            </div>
                        </div>
                    </b-tab>
                    <b-tab title="Participants">
                        <div class="card-body table-responsive p-4">
                            <div>
                                <b-table striped hover 
                                    :items="employees_healthData"
                                    :fields="participantsFields"
                                    :sort-by.sync="sortBy"
                                    :sort-desc.sync="sortDesc"
                                    sort-icon-left
                                    responsive="sm"
                                    :filter="filter"
                                    :current-page="currentPage"
                                    :per-page="perPage"
                                    :filter-included-fields="filterOn">
                                </b-table>
                            </div>
                            <div class="my-1">
                                <b-pagination v-model="currentPage" :total-rows="totalRows" :per-page="perPage" align="center" class="my-0">
                                </b-pagination>
                            </div>
                        </div>
                    </b-tab>
                </b-tabs>
            </b-modal>
          </div>

            <div class="card-body table-responsive p-4">
                <div>

                    <!--
                    <b-tabs card>  
                        <b-tab title="Advanced Search">
                            <b-form inline v-on:submit.prevent="filterTraining">
                                    <label class="mr-sm-2 font-weight-700" for="inline-form-custom-select-pref">Select Year:</label>
                                    <b-form-datepicker class="mr-sm-4" v-model="employeeData.dateVisited" id="dateVisited" locale="en"></b-form-datepicker>
                                    
                                    <label class="mr-sm-2 font-weight-700" for="inline-form-custom-select-pref">Select Month:</label>
                                    <b-form-datepicker class="mr-sm-4" v-model="employeeData.dateVisited" id="dateVisited" locale="en"></b-form-datepicker>
                                    
                                    <label class="mr-sm-2 font-weight-700" for="inline-form-custom-select-pref">Select Date:</label>
                                    <b-form-datepicker class="mr-sm-4" v-model="employeeData.dateVisited" id="dateVisited" locale="en"></b-form-datepicker>
                                    
                                    <b-button variant="primary">Search</b-button>
                            </b-form>
                        </b-tab>
                    </b-tabs>
                    -->

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

                    <b-table striped hover 
                    :items="employees"
                    :fields="fields"
                    :sort-by.sync="sortBy2"
                    :sort-desc.sync="sortDesc2"
                    sort-icon-left
                    responsive="sm"
                    :filter="filterOn2"
                    :current-page="currentPage2"
                    :per-page="perPage2"
                    :filter-included-fields="filterOn2">
                        <template #cell(actions)="row">
                            <b-button @click="loadEmployeeHealthAndTraining(row.item)" size="sm" class="mr-1 jkl-btn-view">View Speaker and Participants</b-button>
                        </template>
                    </b-table>
                </div>
                <div class="my-1">
                    <b-pagination v-model="currentPage2" :total-rows="totalRows2" :per-page="perPage2" align="center" class="my-0">
                    </b-pagination>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import * as healthAndTraining_service from '../services/sja_service';

export default {
    name: 'employee',
    data() {
        return {
            employees: [],
            employees_healthData: [],
            employees_trainingData: [],
            employeeData:{
                name:'',
                sex: null,
                age:'',
                designation:'',
                nature: null,
                level: null,
                division: null
            },
            radio_sex: [{ text: 'Male', value: 'Male' },{ text: 'Female', value: 'Female'}],
            drop_status: [{ text: 'Select Status here', value: null }, 'Requested', 'Initiated'],
            drop_participantType: [{ text: 'Select Paticipant Type here', value: null }, 'Student', 'Professional'],
            drop_PWD: [{ text: 'Select here', value: null }, 'Yes', 'No'],

            errors : '',

            totalRows: 1,
            totalRows2: 1,
            currentPage: 1,
            currentPage2: 1,
            perPage: 10,
            perPage2: 10,
            filterOn: [],
            filterOn2: [],
            filter: null,
            filter2: null,
            sortDirection: 'asc',
            sortDirection2: 'asc',
            sortBy: 'id',
            sortBy2: 'id',
            sortDesc: false,
            sortDesc2: false,
            fields: [
                // { key: 'id', label: 'Event ID'  },
                // { key: 'topic', label: 'Topic'},
                // { key: 'title', label: 'Title'},
                // { key: 'eventDate', label: 'Event Date' },
                // { key: 'eventPlace', label: 'Event Place' },
                // { key: 'eventHost', label: 'Event Host' },
                // { key: 'targetParticipants', label: 'Target Participants'},
                // { key: 'requested_initiated', label: 'Status'},
                // { key: 'actions', label: 'Action' }
                
                // { key: 'id', label: 'Event ID'},
                { key: 'activityTitle', label: 'Activity Title'},
                { key: 'date', label: 'Date'},
                { key: 'venue', label: 'Venue'},
                { key: 'partnerInstitutions', label: 'Partner Institutions' },
                { key: 'topic', label: 'Topic'},
                // { key: 'speaker_id', label: 'Resource Speakers'},
                { key: 'status', label: 'Status'},
                { key: 'actions', label: 'Action' }
            ],
            speakerFields: [
                { key: 'name', label: 'Name' },
                { key: 'sex', label: 'Sex' },
                { key: 'affiliation', label: 'Affiliation' },
                { key: 'designation', label: 'Designation' },
            ],
           participantsFields: [
                { key: 'name', label: 'Name' },
                { key: 'sex', label: 'Sex' },
                { key: 'age', label: 'Age' },
                { key: 'participantType', label: 'Participant Type' }
            ]
        }
    },
    mounted() {
        this.loadEmployees();
       
    },
    methods: {
        showMdl(data){
            this.healthData_update = {...data}
            this.$refs.updateEmployeeModal.show()
        },
        loadEmployees: async function() {
            try{
                const response = await healthAndTraining_service.loadEmployees();
                this.employees = response.data.data;
            } catch(error) {
                this.flashMessage.error({
                message: 'Some error occured! Please refresh.',
                time: 5000
                });
            }
        },
        loadEmployeeHealthAndTraining: async function(data) {
            this.$refs['htData'].show();
            
            const employees_tData = {...data}
            const employees_hData = {...data}
            try{
                const training_response = await healthAndTraining_service.loadEmployeeTraining(employees_tData.id);
                const health_response = await healthAndTraining_service.loadEmployeeHealth(employees_hData.id);

                console.log(training_response);
                console.log(health_response);

                this.employees_trainingData = training_response.data;
                this.employees_healthData = health_response.data;

            } catch(error) {
                this.flashMessage.error({
                message: 'Some error occured! Please refresh.',
                time: 5000
                });
            }
        },
        createEmployee: async function() {
        let formData = new FormData();
            formData.append('name', this.employeeData.name);
            formData.append('sex', this.employeeData.sex);
            formData.append('age', this.employeeData.age);
            formData.append('designation', this.employeeData.designation);
            formData.append('nature', this.employeeData.nature);
            formData.append('level', this.employeeData.level);
            formData.append('division', this.employeeData.division);

            try {
                const response = await healthAndTraining_service.createAccount(formData);
                console.log(response);
                this.hideEmployeeModal();
                this.flashMessage.success({
                    status: '',
                    message: 'Employee added successfully!',
                    time: 5000
                });
                this.employeeData = {
                    name:'',
                    sex: null,
                    age:'',
                    designation:'',
                    nature: null,
                    level: null,
                    division: null
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
            this.loadEmployees();
        },
        deleteEmployee: async function(employee) {
            if (!window.confirm(`Are you sure you want to delete ${employee.name}`)){
            return;
            }
            try {
                await healthAndTraining_service.deleteEmployee(employee.id);
                
                this.employees = this.employees.filter(obj => {
                    return obj.id != employee.id;
                });
                this.flashMessage.success({
                message: 'Account deleted succesfully!',
                time: 5000
                });
            } catch (error){
                this.flashMessage.error({
                  message: 'Some error occured! Please refresh.',
                  time: 5000
                });
            }
        },
        hideEmployeeModal() {
            this.$refs['htData'].hide();
        },
        showEmployeeModal() {
            this.$refs['htData'].show();
        }
    }
}

</script>