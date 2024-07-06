<template>
  <div class="container-fluid">
        <ol class="breadcrumb mt-4 mb-4" style="background-color: white; ">
            <li class="breadcrumb-item active">Home > Records > STARBOOKS</li>
        </ol>
    
    <div class="row">
      <div class="col-xl-12">
        <div class="card mb-4">
          <div class="card-header card-header-title" style="background-color: #ed262a; color: white">
            <i class="fas fa-list-alt mr-1"></i>
            LIST OF DATA
          </div>

            <div class="card-body table-responsive p-4">
                <div>
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
                    </b-table>
                            Total Rows: <b>{{totalRows}}</b>
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

import * as healthAndTraining_service from '../services/starbooks_service.js';

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
            currentPage: 1,
            perPage: 10,
            filterOn: [],
            filter: null,
            sortDirection: 'asc',
            sortBy: 'id',
            sortDesc: false,
            fields: [
                { key: 'id', label: 'Logbook ID'},
                { key: 'intAge', label: 'Age'},
                { key: 'intGender', label: 'Gender'},
                { key: 'intCategory', label: 'Category'},
                { key: 'SchoolType', label: 'School Type'},

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
                { key: 'participantType', label: 'Participant Type' },
                { key: 'affiliation', label: 'Affiliation' },
                { key: 'pwd', label: 'PWD' },
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
                this.totalRows = this.employees.length;
                console.log(response);
            } catch(error) {
                this.flashMessage.error({
                message: 'Some error occured! Please refresh.',
                time: 5000
                });
            }
        },
        // loadEmployeeHealthAndTraining: async function(data) {
        //     this.$refs['htData'].show();
            
        //     const employees_tData = {...data}
        //     const employees_hData = {...data}
        //     try{
        //         const training_response = await healthAndTraining_service.loadEmployeeTraining(employees_tData.id);
        //         const health_response = await healthAndTraining_service.loadEmployeeHealth(employees_hData.id);

        //         console.log(training_response);
        //         console.log(health_response);

        //         this.employees_trainingData = training_response.data;
        //         this.employees_healthData = health_response.data;

        //     } catch(error) {
        //         this.flashMessage.error({
        //         message: 'Some error occured! Please refresh.',
        //         time: 5000
        //         });
        //     }
        // },
        // createEmployee: async function() {
        // let formData = new FormData();
        //     formData.append('name', this.employeeData.name);
        //     formData.append('sex', this.employeeData.sex);
        //     formData.append('age', this.employeeData.age);
        //     formData.append('designation', this.employeeData.designation);
        //     formData.append('nature', this.employeeData.nature);
        //     formData.append('level', this.employeeData.level);
        //     formData.append('division', this.employeeData.division);

        //     try {
        //         const response = await healthAndTraining_service.createAccount(formData);
        //         console.log(response);
        //         this.hideEmployeeModal();
        //         this.flashMessage.success({
        //             status: '',
        //             message: 'Employee added successfully!',
        //             time: 5000
        //         });
        //         this.employeeData = {
        //             name:'',
        //             sex: null,
        //             age:'',
        //             designation:'',
        //             nature: null,
        //             level: null,
        //             division: null
        //         }
        //     } catch (error) {
        //         switch (error.response.status) {
        //             case 422:
        //                 this.errors = error.response.data.errors;
        //                 break;
        //             default:
        //                 this.flashMessage.error({
        //                     message: 'Some error occurred, Please try again!',
        //                     time: 5000
        //                 });
        //             break;
        //         }
        //     }
        //     this.loadEmployees();
        // },
        // deleteEmployee: async function(employee) {
        //     if (!window.confirm(`Are you sure you want to delete ${employee.name}`)){
        //     return;
        //     }
        //     try {
        //         await healthAndTraining_service.deleteEmployee(employee.id);
                
        //         this.employees = this.employees.filter(obj => {
        //             return obj.id != employee.id;
        //         });
        //         this.flashMessage.success({
        //         message: 'Account deleted succesfully!',
        //         time: 5000
        //         });
        //     } catch (error){
        //         this.flashMessage.error({
        //           message: 'Some error occured! Please refresh.',
        //           time: 5000
        //         });
        //     }
        // },
        hideEmployeeModal() {
            this.$refs['htData'].hide();
        },
        showEmployeeModal() {
            this.$refs['htData'].show();
        }
    }
}

</script>