<template>
  <div class="container-fluid">
    <h1 class="mt-4 stii-font-color-red">Health and Training</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Home > Health and Training > Training </li>
    </ol>
    <div class="row">
      <div class="col-xl-12">
        <div class="card mb-4">
          <div class="card-header card-header-title" style="background-color: #ed262a; color: white">
            <i class="fas fa-list-alt mr-1"></i>
            LIST OF TRAININGS
            <!--<b-button v-b-modal.add-employee class="float-right" style="background-color:white; color:black"><i class="fas fa-plus-square"></i></b-button>-->

            <b-button v-b-modal.add-participant class="float-right add-specific-button" style="background-color:white; color:black">
                <i class="fas fa-plus-square"> Participant</i>
            </b-button>
            <b-button v-b-modal.add-employee class="float-right add-specific-button" style="background-color:white; color:black">
                <i class="fas fa-plus-square"> Training</i>
            </b-button>

            <b-modal id="add-employee" ref="add-employee" title="Add New Training" hide-footer>
              <b-form v-on:submit.prevent="createTraining">
                <b-card no-body>
                    <b-card bg-variant="light">
                            <b-form-group label="Event Title/Topic:" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData.trainingTitle" id="trainingTitle" type="text" placeholder="Enter Training Title here..." required></b-form-input>
                            </b-form-group>
                            <b-form-group label="Nature of Training:" label-cols-sm="2" label-align-sm="right" class=" font-weight-700" > 
                                <b-form-select v-model="trainingsData.trainor" id="trainor" :options="drop_nature" required></b-form-select>
                            </b-form-group> 
                            <b-form-group label="Start Date:" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-datepicker v-model="trainingsData.startDate" id="startDate" locale="en" required></b-form-datepicker>
                            </b-form-group>
                            <b-form-group label="End Date:"  label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-datepicker v-model="trainingsData.endDate" id="endDate" locale="en" required></b-form-datepicker>
                            </b-form-group>
                            <b-form-group label="Location:"  label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData.fundingSource" id="fundingSource" type="text" placeholder="Enter Location here..."></b-form-input>
                            </b-form-group>
                            <!--
                            <b-form-group label="Employee ID:" label-for="employeeID" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData.employeeID" id="employeeID" type="text" placeholder="Enter Employee ID here..." required></b-form-input>
                            </b-form-group>
                            -->
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
                            <b-form-group label="Event Title/Topic:" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData_update.trainingTitle" id="trainingTitle" type="text" placeholder="Enter Training Title here..." required></b-form-input>
                            </b-form-group>
                            <b-form-group label="Nature of Training:" label-cols-sm="2" label-align-sm="right" class=" font-weight-700" > 
                                <b-form-select v-model="trainingsData_update.trainor" id="trainor" :options="drop_nature" required></b-form-select>
                            </b-form-group> 
                            <b-form-group label="Start Date:" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-datepicker v-model="trainingsData_update.startDate" id="startDate" locale="en" required></b-form-datepicker>
                            </b-form-group>
                            <b-form-group label="End Date:"  label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-datepicker v-model="trainingsData_update.endDate" id="endDate" locale="en" required></b-form-datepicker>
                            </b-form-group>
                            <b-form-group label="Location:"  label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData_update.fundingSource" id="fundingSource" type="text" placeholder="Enter Location here..."></b-form-input>
                            </b-form-group>
                            <!--<b-form-group label="Employee ID:" label-for="employeeID" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData_update.employeeID" id="employeeID" type="text" placeholder="Enter Employee ID here..." required></b-form-input>
                            </b-form-group>
                            -->
                    </b-card> 
                </b-card>
                <div class="float-right">
                    <b-button type="button" class="btn btn-default" variant="outline-danger" v-on:click="hideEmployeeModal">Cancel</b-button>
                    <b-button type="submit" class="btn" variant="outline-success">Save</b-button> 
                </div>
              </b-form>
            </b-modal>

            <b-modal id="add-participant" ref="add-employee" title="Add New Training" hide-footer>
              <b-form v-on:submit.prevent="createParticipant">
                <b-card no-body>
                    <b-card bg-variant="light">
                            <b-form-group label="Select Training:" label-cols-sm="2" label-align-sm="right" class=" font-weight-700" > 
                                <b-form-select v-model="trainingsData.trainingID" id="trainingID" :options="trainings_title" required></b-form-select>
                            </b-form-group>
                            <b-form-group label="Participant Name" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData.employeeID" id="employeeID" type="text" placeholder="Enter name here..." required></b-form-input>
                            </b-form-group>
                            <b-form-group label="Position Title" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData.position_title" id="position_title" type="text" placeholder="Enter position here..."></b-form-input>
                            </b-form-group>
                            <b-form-group label="Sex:" label-cols-sm="2" label-align-sm="right" class="mb-0 font-weight-700"  v-slot="{ }" >
                                <b-form-radio-group v-model="trainingsData.sex" id="sex" class="pt-2 font-weight-600" :options="radio_sex" required></b-form-radio-group>
                            </b-form-group>
                            <b-form-group label="Division:" label-cols-sm="2" label-align-sm="right" class=" font-weight-700" > 
                                <b-form-select v-model="trainingsData.division" id="division" :options="drop_division" ></b-form-select>
                            </b-form-group>

                            <!--
                            <b-form-group label="Select Participant:" label-cols-sm="2" label-align-sm="right" class=" font-weight-700" > 
                                <b-form-select v-model="trainingsData.employeeID" id="employeeID" :options="employees_name" required></b-form-select>
                            </b-form-group>
                            -->
                            <!--
                            <b-form-group label="Employee ID:" label-for="employeeID" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                                <b-form-input v-model="trainingsData.employeeID" id="employeeID" type="text" placeholder="Enter Employee ID here..." required></b-form-input>
                            </b-form-group>
                            -->
                    </b-card> 
                </b-card>
                <div class="float-right">
                    <b-button type="button" class="btn btn-default" variant="outline-danger" v-on:click="hideEmployeeModal">Cancel</b-button>
                    <b-button type="submit" class="btn" variant="outline-success" >Save</b-button> 
                </div>
              </b-form>
            </b-modal>  
            
            <b-modal id="htData" ref="htData" title="Add New Employee" hide-footer>
                <b-tabs card>  
                    <b-tab title="Participants">
                        <div class="card-body table-responsive p-4">
                            <div>
                                <b-table striped hover 
                                    :items="employees_trainingData"
                                    :fields="participantsFields"
                                    :sort-by.sync="sortBy2"
                                    :sort-desc.sync="sortDesc2"
                                    sort-icon-left
                                    responsive="sm"
                                    :filter="filter2"
                                    :current-page="currentPage2"
                                    :per-page="perPage2"
                                    :filter-included-fields="filterOn2">
                                </b-table>
                            </div>
                            <div class="my-1">
                                <b-pagination v-model="currentPage2" :total-rows="totalRows2" :per-page="perPage2" align="center" class="my-0">
                                </b-pagination>
                            </div>
                        </div>
                    </b-tab>
                </b-tabs>
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
                    :fields="fields"
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
                        <template #cell(viewParticipant)="row">
                            <b-button @click="loadEmployeeHealthAndTraining(row.item)" size="sm" class="mr-1 jkl-btn-view" style="background-color: #3090C7">View Participants</b-button>
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
import * as employeeService from '../services/healthandtraining_service';

export default {
    name: 'employee',
    data() {
        return {
            
            user_datas : {},
            employees: {},
            trainings: [],
            trainings_title: [],
            employees_name: [],
            
            employees_healthData: [],
            employees_trainingData: [],


            trainingsData:{
                employeeID:'',
                trainingType: '',
                trainingTopic: '',
                trainingTitle:'',
                startDate:'',
                endDate:'',
                noHours:'',
                trainingProvider:'',
                trainor: '',
                fundingSource: ''
            },
            trainingsData_update:{},
            drop_division: [    'CRPD', 
                                'FAD', 
                                'IRAD',
                                'OD-MISPS',],
            drop_nature: [      'In-House', 
                                'External'],
            drop_trainingType: ['Managerial/ Leadership ', 
                                'Administrative', 
                                'Technical Information (library/IT)',
                                'Communication/Media',
                                'GAD Training',
                                'OSH Training'],
            drop_trainingTopic:['Leadership', 
                                'Communication (writing, audio-visual, etc.)', 
                                'Digital', 
                                'Finance & admin related', 
                                'Library-science related', , 
                                'IT related',
                                'Others'],
            radio_trainor: [{ text: 'In-house', value: 'In-house' },
                            { text: 'Contracted', value: 'Contracted'}],
            radio_fundingSource: [  { text: 'DOST-STII', value: 'DOST-STII' },
                                    { text: 'External Fund', value: 'External Fund'}],
            radio_sex: [{ text: 'Male', value: 'Male' },
                        { text: 'Female', value: 'Female'}],

            errors : '',
            totalRows: 1,
            currentPage: 1,
            perPage: 10,
            filterOn: [],
            filter: null,
            sortDirection: 'asc',
            sortBy: 'id',
            sortDesc: false,

            totalRows2: 1,
            currentPage2: 1,
            perPage2: 10,
            filterOn2: [],
            filter2: null,
            sortDirection2: 'asc',
            sortBy2: 'id',
            sortDesc2: false,
            fields: [
                // { key: 'totalCount', label: 'No.'},
                { key: 'id', label: 'No.'},
                { key: 'trainingTitle', label: 'Event Title/Topic'},
                { key: 'startDate', sortable: true,label: 'Start Date' },
                { key: 'endDate', label: 'End Date' },
                { key: 'trainor', label: 'Nature of Training' },
                { key: 'fundingSource', label: 'Location' },
                { key: 'viewParticipant', label: 'Participant'},
                { key: 'actions', label: 'Action' }
            ],
            participantsFields: [
                { key: 'employee_id', label: 'Name' },
            ],
            // speakerFields: [
            //     { key: 'name', label: 'Name' },
            // ]
            }
    },
    mounted() {
        this.loadTrainings();
        // this.loadEmployees();
        this.getListOfTraining();
        this.getNamesOfEmployees();
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
        // loadEmployees: async function() {
        //     try{
        //         const response = await employeeService.loadEmployees();
        //         this.employees = response.data.data;
        //         this.totalRows = this.employees.length;
        //     } catch(error) {
        //         this.flashMessage.error({
        //             message: 'Some error occured! Please try again.',
        //             time: 5000
        //         });
        //     }
        // },
        loadEmployeeHealthAndTraining: async function(data) {
            this.$refs['htData'].show();
            
            const employees_tData = {...data}
                
            try{
                console.log(employees_tData.id);
                const response = await employeeService.loadTrainingParticipants(employees_tData.id);

                this.employees_trainingData = response.data;
                this.totalRows2 = this.employees_trainingData.length;

            } catch(error) {
                this.flashMessage.error({
                message: 'Some error occured! Please refresh.',
                time: 5000
                });
            }
        },
        getAllUsers: async function(){  
            try { 
                const response = await employeeService.loadEmployees()
                this.user_datas = response.data
            } catch (e) {

            }
        },
        getListOfTraining: async function(){
            try{
                // const response = await employeeService.loadTrainings();
                const response = await employeeService.getTrainings();
                // console.log(response.data);
                for (let i=0; i<response.data.length; i++){
                    // console.log(response.data[i]);
                    // console.log(response.data[i]['id']);
                    this.trainings_title.push({ value: response.data[i]['id'], text: response.data[i]['trainingTitle'] })
                }
                
            } catch(error) {
                this.flashMessage.error({
                message: 'Some error occured! Please try again.',
                time: 5000
                });
            }
        },
        getNamesOfEmployees: async function(){
            try{
                // const response = await employeeService.loadTrainings();
                const response = await employeeService.getEmployees();
                // console.log(response.data);
                for (let i=0; i<response.data.length; i++){
                    // console.log(response.data[i]);
                    // console.log(response.data[i]['id']);
                    this.employees_name.push({ value: response.data[i]['id'], text: response.data[i]['name'] })
                }
                
            } catch(error) {
                this.flashMessage.error({
                message: 'Some error occured! Please try again.',
                time: 5000
                });
            }
        },
        loadTrainings: async function() {
            try{
                const response = await employeeService.getAll();
                this.trainings = response.data.data;
                this.totalRows = this.trainings.length;
                console.log(this.totalRows);
            } catch(error) {
                this.flashMessage.error({
                message: 'Some error occured! Please try again.',
                time: 5000
                });
            }
        },
        createTraining: async function() {
            let formData = new FormData();

            formData.append('employeeID', this.trainingsData.employeeID);
            formData.append('trainingType', this.trainingsData.trainingType);
            formData.append('trainingTopic', this.trainingsData.trainingTopic);
            formData.append('trainingTitle', this.trainingsData.trainingTitle);
            formData.append('startDate', this.trainingsData.startDate);
            formData.append('endDate', this.trainingsData.endDate);
            formData.append('noHours', this.trainingsData.noHours);
            formData.append('trainingProvider', this.trainingsData.trainingProvider);
            formData.append('trainor', this.trainingsData.trainor);
            formData.append('fundingSource', this.trainingsData.fundingSource);

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
                    employeeID:'',
                    trainingType: '',
                    trainingTopic: '',
                    trainingTitle:'',
                    startDate:'',
                    endDate:'',
                    noHours:'',
                    trainingProvider:'',
                    trainor: '',
                    fundingSource: ''
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
            this.getListOfTraining();
        },
        createParticipant: async function() {

            const trainingData_response = await employeeService.loadTrainingData(this.trainingsData.trainingID);
            // const employeeData_response = await employeeService.loadEmployeeData(this.trainingsData.employeeID);
            
            this.employees_trainingData = trainingData_response.data;
            // this.employees_employeeData = employeeData_response.data;

            console.log(this.employees_trainingData[0]['id']);
            // console.log(this.employees_employeeData[0]['id']);

            let formData = new FormData();

            formData.append('employee_id', this.trainingsData.employeeID); //employee name
            formData.append('training_id', this.employees_trainingData[0]['id']); //training id
            formData.append('position_title', this.trainingsData.position_title); //position title
            formData.append('sex', this.trainingsData.sex);                       //sex
            formData.append('division', this.trainingsData.division);             //division

            try {
                const response = await employeeService.addParticipant(formData);
                console.log(response);
                
                this.flashMessage.success({
                    status: '',
                    message: 'Training added successfully!',
                    time: 5000
                });
                this.trainingsData = {
                    employeeID:'',
                    trainingTitle: '',
                    position_title: '',
                    sex:'',
                    division:''
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
            // this.loadTrainings();
            // this.clearModal();
        },
        updateEmployee: async function() {
            try {

                let formData = new FormData();
                formData.append('trainingType', this.trainingsData_update.trainingType);
                formData.append('trainingTopic', this.trainingsData_update.trainingTopic);
                formData.append('trainingTitle', this.trainingsData_update.trainingTitle);
                formData.append('startDate', this.trainingsData_update.startDate);
                formData.append('endDate', this.trainingsData_update.endDate);
                formData.append('noHours', this.trainingsData_update.noHours);
                formData.append('trainingProvider', this.trainingsData_update.trainingProvider);
                formData.append('trainor', this.trainingsData_update.trainor);
                formData.append('fundingSource', this.trainingsData_update.fundingSource);

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
            
            this.getListOfTraining();
            // this.getNamesOfEmployees();
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