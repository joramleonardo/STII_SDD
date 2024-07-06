<template>
  <div class="container-fluid">
    <h1 class="mt-4 stii-font-color-red">Admin Users</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Home > Admin Users </li>
    </ol>
    <div class="row">
      <div class="col-xl-12">
        <div class="card mb-4">
          <div class="card-header card-header-title" style="background-color: #ed262a; color: white">
            <i class="fas fa-list-alt mr-1"></i>
            LIST OF USERS
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
    <b-modal id="add-employee" ref="add-employee" title="Add New User" hide-footer>
        <b-form v-on:submit.prevent="createEmployee">
        <b-card no-body>
            <b-card bg-variant="light">
                    <b-form-group label="Name:" label-for="name" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.name" id="name" type="text" placeholder="Enter full name here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Username:" label-for="username" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.username" id="username" type="text" placeholder="Enter username here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Password:" label-for="password" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.password" id="password" type="text" placeholder="Enter password here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Role:" label-for="role" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData.role" id="role" :options="drop_userType" required></b-form-select>
                    </b-form-group>
                    <b-form-group label="Action:" label-for="isActivated" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData.isActivated" id="isActivated" :options="drop_isActivated" required></b-form-select>
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
                    <b-form-group label="Name:" label-for="name" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.name" id="name" type="text" placeholder="Enter name here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Username:" label-for="username" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.username" id="username" type="text" placeholder="Enter username here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Role:" label-for="role" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData_update.role" id="role" :options="drop_userType" required></b-form-select>
                    </b-form-group>
                    <b-form-group label="Action:" label-for="isActivated" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData_update.isActivated" id="isActivated" :options="drop_isActivated" required></b-form-select>
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
import * as employeeService from '../services/user_service.js';

export default {
    
    data() {
        return {
            employees: [],
            employeeData:{
                name:'',
                username:'',
                password:'',
                role: 'Admin',
                isActivated: 'null'
            },
            employeeData_update:{},

            radio_sex: [{ text: 'Male', value: 'Male' },{ text: 'Female', value: 'Female'}],
            
            drop_userType: [{ text: 'Select user type here', value: null }, 'Admin', 
                                                                            'Author HR', 
                                                                            'Author Libray', 
                                                                            'Author PJS', 
                                                                            'Author SJA', 
                                                                            'Author Starbooks', 
                                                                            'Author DOSTv'],
            drop_isActivated: [{ text: 'Select action here', value: null }, 'Activated', 'Not Activated'],

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
                { key: 'id', sortable: true, label: 'ID'  },
                { key: 'name', sortable: true, label: 'Name'},
                { key: 'username', sortable: true, label: 'Username'},
                { key: 'role', label: 'Role' },
                { key: 'isActivated', label: 'Active Status' },
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
            formData.append('name', this.employeeData.name);
            formData.append('username', this.employeeData.username);
            formData.append('password', this.employeeData.password);
            formData.append('role', this.employeeData.role);
            formData.append('isActivated', this.employeeData.isActivated);

            try {
                const response = await employeeService.createAccount(formData);
                console.log(response);
                this.hideEmployeeModal();
                this.flashMessage.success({
                    status: '',
                    message: 'User added successfully!',
                    time: 5000
                });
                this.employeeData = {
                    name:'',
                    username:'',
                    password:'',
                    role: 'Admin',
                    isActivated: 'null'
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
                    formData.append('name', this.employeeData_update.name);
                    formData.append('username', this.employeeData_update.username);
                    formData.append('role', this.employeeData_update.role);
                    formData.append('isActivated', this.employeeData_update.isActivated);

                formData.append("_method", "put");

                const response = await employeeService.updateEmployeeData(this.employeeData_update.id, formData);
                console.log(response);

                this.flashMessage.success({
                    status: '',
                    message: 'User updated successfully!',
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
                    message: 'User deleted successfully!',
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