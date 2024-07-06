<template>
  <div class="container-fluid">
    <h1 class="mt-4 stii-font-color-red">Health and Training Reports</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Home > Reports > Health and Training</li>
    </ol>
    
    <div class="row">
      <div class="col-xl-12">
        <div class="card mb-4">
          <div class="card-header" style="background-color: #ed262a; color: white">
            <i class="fas fa-list-alt mr-1"></i>
            LIST OF DATA
            <b-modal id="htData" ref="htData" title="Add New Employee" hide-footer>
              <!--
              <b-form v-on:submit.prevent="createEmployee">
                <b-card no-body>
                    <b-tabs card>  
                        <b-tab title="Trainings test">
                            <div class="card-body">
                                <table class="table">
                                <thead>
                                    <tr class="table-head">
                                    <td>Name</td>
                                    <td>Training Type</td>
                                    <td>Training Topic</td>
                                    <td>Training Title</td>
                                    <td>Start Date</td>
                                    <td>End Date</td>
                                    <td>No of Hours</td>
                                    <td>Training Provider</td>
                                    <td>Trainor</td>
                                    <td>Funding Source</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(employee, index) in employees" :key="index">
                                    <td>{{employee.name}}</td>
                                    <td>{{employee.trainingType}}</td>
                                    <td>{{employee.trainingTopic}}</td>
                                    <td>{{employee.trainingTitle}}</td>
                                    <td>{{employee.startDate}}</td>
                                    <td>{{employee.endDate}}</td>
                                    <td>{{employee.noHours}}</td>
                                    <td>{{employee.trainingProvider}}</td>
                                    <td>{{employee.trainor}}</td>
                                    <td>{{employee.fundingSource}}</td>
                                    </tr>
                                    <tr>
                                    </tr>
                                </tbody>
                                </table>
                            </div> 
                        </b-tab>
                        <b-tab title="Health Condition">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr class="table-head">
                                        <td>Employee Number</td>
                                        <td>Name</td>
                                        <td>Designation</td>
                                        <td>Nature</td>
                                        <td>Division</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(employee, index) in employees" :key="index">
                                        <td>{{employee.employee_number}}</td>
                                        <td>{{employee.name}}</td>
                                        <td>{{employee.designation}}</td>
                                        <td>{{employee.nature}}</td>
                                        <td>{{employee.division}}</td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    </tbody>
                                </table>
                            </div> 
                        </b-tab>
                    </b-tabs>
                </b-card>
              </b-form>
              -->
                <b-tabs card>  
                    <b-tab title="Trainings">
                        <div class="card-body table-responsive p-4">
                            <div>
                                <b-table striped hover 
                                    :items="employees_trainingData"
                                    :fields="trainingFields"
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
                    <b-tab title="Health Condition">
                        <div class="card-body table-responsive p-4">
                            <div>
                                <b-table striped hover 
                                    :items="employees_healthData"
                                    :fields="healthFields"
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
                  
                  <b-form v-on:submit.prevent="updateEmployee">
                    <b-card no-body>
                        <b-card bg-variant="light">
                                <b-form-group label="Sex:" 
                                              label-for="sex" 
                                              label-cols-sm="4" 
                                              label-cols-lg="3"
                                              content-cols-sm
                                              content-cols-lg="7" 
                                              class="font-weight-700"> 
                                    <b-form-select v-model="employeeData.sex" id="sex" :options="drop_nature" required ></b-form-select>
                                </b-form-group> 
                                <b-form-group label="Training Type:" 
                                              label-for="nature" 
                                              label-cols-sm="4" 
                                              label-cols-lg="3"
                                              content-cols-sm
                                              content-cols-lg="7" 
                                              class="font-weight-700"> 
                                    <b-form-select v-model="employeeData.level" id="level" :options="drop_level" required></b-form-select>
                                </b-form-group>
                                <b-form-group label="Training Topic:" 
                                              label-for="nature" 
                                              label-cols-sm="4" 
                                              label-cols-lg="3"
                                              content-cols-sm
                                              content-cols-lg="7" 
                                              class="font-weight-700"> 
                                    <b-form-select v-model="employeeData.division" id="division" :options="drop_division" required></b-form-select>
                                </b-form-group>
                        <div class="float-left">
                            <b-button type="submit" class="btn" variant="outline-success" >Generate Report</b-button> 
                        </div>
                        </b-card> 
                    </b-card>
                  </b-form>


                    <b-table striped hover 
                    :items="employees"
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
                            <b-button @click="loadEmployeeHealthAndTraining(row.item)" size="sm" class="mr-1" style="background-color: #3090C7">View Health and Training</b-button>
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
<script>

import * as healthAndTraining_service from '../services/healthandtraining_service';

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
            drop_nature: [{ text: 'Select Nature here', value: null }, 'Permanent', 'COS'],
            drop_level: [{ text: 'Select Level here', value: null }, 'Executive', 'Middle Manager', 'Staff'],
            drop_division: [{ text: 'Select Division here', value: null }, 'CRPD', 'IRAD', 'FAD', 'OD-MISPS'],

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
                { key: 'id', sortable: true, label: 'Employee ID'  },
                { key: 'employee_number', sortable: true, label: 'Employee Number' },
                { key: 'name', sortable: true, label: 'Name'},
                { key: 'sex', sortable: true, label: 'Sex'},
                { key: 'age', label: 'Age' },,
                { key: 'designation', label: 'Designation' },
                { key: 'nature', label: 'Nature' },
                { key: 'level', label: 'Level' },
                { key: 'division', label: 'Division' },
                { key: 'actions', label: 'Action' }
            ],
            trainingFields: [
                // { key: 'employee_number', sortable: true, label: 'Employee Number' },
                // { key: 'name', sortable: true, label: 'Name'},
                { key: 'trainingType', label: 'Training Type' },
                { key: 'trainingTopic', label: 'Training Topic'},
                { key: 'trainingTitle', label: 'Training Title'},
                { key: 'startDate', label: 'Start Date' },
                { key: 'endDate', label: 'End Date' },
                { key: 'noHours', label: 'No of Hours' },
                { key: 'trainingProvider', label: 'Training Provider' },
                { key: 'trainor', label: 'Trainor' },
                { key: 'fundingSource', label: 'Funding Source' }
            ],
           healthFields: [
                // { key: 'employee_number', sortable: true, label: 'Employee Number' },
                // { key: 'name', sortable: true, label: 'Name'},
                { key: 'ageRange', label: 'Age Range' },
                { key: 'yearCover', label: 'Year Cover' },
                { key: 'healthCondition', label: 'Health Condition' },
                { key: 'illnessType', label: 'Illness Type' },
                { key: 'fitStatus', label: 'Fit Status' }
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