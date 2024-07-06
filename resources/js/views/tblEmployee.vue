<template>
  <div class="container-fluid">
    <h1 class="mt-4 stii-font-color-red">Health and Training</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Home > Health and Training > Employee </li>
    </ol>
    <div class="row">
      <div class="col-xl-12">
        <div class="card mb-4">
          <div class="card-header card-header-title" style="background-color: #ed262a; color: white">
            <i class="fas fa-list-alt mr-1"></i>
            LIST OF EMPLOYEES
            <b-button v-b-modal.add-employee class="float-right" style="background-color:white; color:black"><i class="fas fa-plus-square"></i></b-button>
            
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
    <b-modal id="add-employee" ref="add-employee" title="Add New Employee" hide-footer>
        <b-form v-on:submit.prevent="createEmployee">
        <b-card no-body>
            <b-card bg-variant="light">
                    <b-form-group label="Employee Number:" label-for="employee_number" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.employee_number" id="employee_number" type="text" placeholder="Enter Employee ID here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Name:" label-for="name" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.name" id="name" type="text" placeholder="Enter name here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Sex:" label-cols-sm="2" label-align-sm="right" class="mb-0 font-weight-700"  v-slot="{ }" >
                        <b-form-radio-group v-model="employeeData.sex" id="sex" class="pt-2 font-weight-600" :options="radio_sex" ></b-form-radio-group>
                    </b-form-group>
                    <!--<b-form-group label="Age:" label-for="age" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.age" id="age" type="text" placeholder="Enter age here..." ></b-form-input>
                    </b-form-group>-->
                    <b-form-group label="Age Bracket:" label-cols-sm="2" label-align-sm="right" class=" font-weight-700" > 
                        <b-form-select v-model="employeeData.age" id="age" :options="drop_ageBracket"></b-form-select>
                    </b-form-group> 
                    <b-form-group label="Position title:" label-for="designation" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.designation" id="designation" type="text" placeholder="Enter Position title here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Nature:" label-for="nature" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData.nature" id="nature" :options="drop_nature"></b-form-select>
                    </b-form-group> 
                    <b-form-group label="Level:" label-for="level" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData.level" id="level" :options="drop_level"></b-form-select>
                    </b-form-group>
                    <b-form-group label="Division:" label-for="division" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData.division" id="division" :options="drop_division" required></b-form-select>
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
                    <b-form-group label="Employee Number:" label-for="employee_number" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.employee_number" id="employee_number" type="text" placeholder="Enter Employee ID here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Name:" label-for="name" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.name" id="name" type="text" placeholder="Enter name here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Sex:" label-cols-sm="2" label-align-sm="right" class="mb-0 font-weight-700"  v-slot="{ }" >
                        <b-form-radio-group v-model="employeeData_update.sex" id="sex" class="pt-2 font-weight-600" :options="radio_sex" ></b-form-radio-group>
                    </b-form-group>
                    <!--<b-form-group label="Age:" label-for="age" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.age" id="age" type="text" placeholder="Enter age here..." ></b-form-input>
                    </b-form-group>-->
                    <b-form-group label="Age Bracket:" label-cols-sm="2" label-align-sm="right" class=" font-weight-700" > 
                        <b-form-select v-model="employeeData_update.age" id="age" :options="drop_ageBracket" required></b-form-select>
                    </b-form-group> 
                    <b-form-group label="Position title:" label-for="designation" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.designation" id="designation" type="text" placeholder="Enter Position title here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Nature:" label-for="nature" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData_update.nature" id="nature" :options="drop_nature"></b-form-select>
                    </b-form-group> 
                    <b-form-group label="Level:" label-for="level" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData_update.level" id="level" :options="drop_level"></b-form-select>
                    </b-form-group>
                    <b-form-group label="Division:" label-for="division" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData_update.division" id="division" :options="drop_division" required></b-form-select>
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
            employees: [],
            employeeData:{
                employee_number:'',
                name:'',
                sex: '',
                age:'',
                designation:'',
                nature: '',
                level: '',
                division: ''
            },
            employeeData_update:{},

            radio_sex: [{ text: 'Male', value: 'Male' },{ text: 'Female', value: 'Female'}],
            drop_nature: [{ text: 'Select Nature here', value: null }, 'Permanent', 'COS'],
            drop_level: [{ text: 'Select Level here', value: null }, 'Executive', 'Middle Manager', 'Staff'],
            drop_division: [{ text: 'Select Division here', value: null }, 'CRPD', 'IRAD', 'FAD', 'OD-MISPS'],
            drop_ageBracket: [{text: 'Select here', value: null},
                                                            '20 years old and below',
                                                            '21 - 25 years old',
                                                            '26 - 30 years old',
                                                            '31 - 35 years old',
                                                            '36 - 40 years old',
                                                            '41 - 45 years old',
                                                            '46 - 50 years old',
                                                            '51 - 55 years old',
                                                            '56 - 60 years old',
                                                            '61 years old and above'],

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
                // { key: 'id', sortable: true, label: 'No'  },
                { key: 'employee_number', sortable: true, label: 'Employee Number' },
                { key: 'name', sortable: true, label: 'Name'},
                { key: 'sex', sortable: true, label: 'Sex'},
                { key: 'age', label: 'Age' },,
                { key: 'designation', label: 'Designation' },
                { key: 'nature', label: 'Nature' },
                { key: 'level', label: 'Level' },
                { key: 'division', label: 'Division' },
                { key: 'actions', label: 'Action' }
            ]
            }
    },
    mounted() {
        this.loadEmployees();
       
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
        createEmployee: async function() {
            let formData = new FormData();
            formData.append('employee_number', this.employeeData.employee_number);
            formData.append('name', this.employeeData.name);
            formData.append('sex', this.employeeData.sex);
            formData.append('age', this.employeeData.age);
            formData.append('designation', this.employeeData.designation);
            formData.append('nature', this.employeeData.nature);
            formData.append('level', this.employeeData.level);
            formData.append('division', this.employeeData.division);

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
                    employee_number:'',
                    name:'',
                    sex: '',
                    age:'',
                    designation:'',
                    nature: '',
                    level: '',
                    division: ''
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
            this.loadEmployees();
            this.clearModal();
        },
        updateEmployee: async function() {
            try {

                let formData = new FormData();
                formData.append('employee_number', this.employeeData_update.employee_number);
                formData.append('name', this.employeeData_update.name);
                formData.append('sex', this.employeeData_update.sex);
                formData.append('age', this.employeeData_update.age);
                formData.append('designation', this.employeeData_update.designation);
                formData.append('nature', this.employeeData_update.nature);
                formData.append('level', this.employeeData_update.level);
                formData.append('division', this.employeeData_update.division);

                formData.append("_method", "put");

                const response = await employeeService.updateEmployeeData(this.employeeData_update.id, formData);
                console.log(response);

                this.flashMessage.success({
                    status: '',
                    message: 'Employee updated successfully!',
                    time: 5000
                });
                this.loadEmployees();

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
            this.loadEmployees();
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