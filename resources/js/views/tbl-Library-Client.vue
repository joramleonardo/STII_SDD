<template>
  <div class="container-fluid">
        <ol class="breadcrumb mt-4 mb-4" style="background-color: white; ">
            <li class="breadcrumb-item active">Home > Library > Client</li>
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
    <b-modal id="add-employee" ref="add-employee" title="Add New Data" hide-footer>
        <b-form v-on:submit.prevent="createEmployee">
        <b-card no-body>
            <b-card bg-variant="light">
                    <b-form-group label="Name:" label-for="name" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.name" id="name" type="text" placeholder="Enter name here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Client Type:" label-for="clientType" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData.clientType" id="clientType" :options="drop_clientType" required></b-form-select>
                    </b-form-group> 
                    <b-form-group label="Professional Type:" label-for="profType" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData.profType" id="profType" :options="drop_profType" required></b-form-select>
                    </b-form-group> 
                    <b-form-group label="Year Level:" label-for="yearLevel" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData.yearLevel" id="yearLevel" :options="drop_yearLevel" required></b-form-select>
                    </b-form-group> 
                    <b-form-group label="School Category:" label-for="schoolCategory" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData.schoolCategory" id="schoolCategory" :options="drop_schoolCategory" required></b-form-select>
                    </b-form-group> 
                    <b-form-group label="Sex:" label-cols-sm="2" label-align-sm="right" class="mb-0 font-weight-700"  v-slot="{ }" >
                        <b-form-radio-group v-model="employeeData.sex" id="sex" class="pt-2 font-weight-600" :options="radio_sex" ></b-form-radio-group>
                    </b-form-group>
                    <b-form-group label="Age Range:" label-for="ageRange" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData.ageRange" id="ageRange" :options="drop_ageRange" required></b-form-select>
                    </b-form-group>
                    <b-form-group label="Office/School:" label-for="office_school" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.office_school" id="office_school" type="text" placeholder="Enter name here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Date Visited:" label-for="dateVisited" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-datepicker v-model="employeeData.dateVisited" id="dateVisited" locale="en"></b-form-datepicker>
                    </b-form-group>
                    <b-form-group label="Time In:" label-for="timeIn" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-timepicker v-model="employeeData.timeIn" id="timeIn" locale="en"></b-form-timepicker>
                    </b-form-group>
                    <b-form-group label="Time Out:" label-for="timeOut" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-timepicker v-model="employeeData.timeOut" id="timeOut" locale="en"></b-form-timepicker>
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
                    <b-form-group label="Client Type:" label-for="clientType" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData_update.clientType" id="clientType" :options="drop_clientType" required></b-form-select>
                    </b-form-group> 
                    <b-form-group label="Professional Type:" label-for="profType" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData_update.profType" id="profType" :options="drop_profType" required></b-form-select>
                    </b-form-group> 
                    <b-form-group label="Year Level:" label-for="yearLevel" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData_update.yearLevel" id="yearLevel" :options="drop_yearLevel" required></b-form-select>
                    </b-form-group> 
                    <b-form-group label="School Category:" label-for="schoolCategory" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData_update.schoolCategory" id="schoolCategory" :options="drop_schoolCategory" required></b-form-select>
                    </b-form-group> 
                    <b-form-group label="Sex:" label-cols-sm="2" label-align-sm="right" class="mb-0 font-weight-700"  v-slot="{ }" >
                        <b-form-radio-group v-model="employeeData_update.sex" id="sex" class="pt-2 font-weight-600" :options="radio_sex" ></b-form-radio-group>
                    </b-form-group>
                    <b-form-group label="Age Range:" label-for="ageRange" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData_update.ageRange" id="ageRange" :options="drop_ageRange" required></b-form-select>
                    </b-form-group>
                    <b-form-group label="Office/School:" label-for="office_school" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.office_school" id="office_school" type="text" placeholder="Enter name here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Date Visited:" label-for="dateVisited" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-datepicker v-model="employeeData_update.dateVisited" id="dateVisited" locale="en"></b-form-datepicker>
                    </b-form-group>
                    <b-form-group label="Time In:" label-for="timeIn" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-timepicker v-model="employeeData_update.timeIn" id="timeIn" locale="en"></b-form-timepicker>
                    </b-form-group>
                    <b-form-group label="Time Out:" label-for="timeOut" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-timepicker v-model="employeeData_update.timeOut" id="timeOut" locale="en"></b-form-timepicker>
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
            employees: [],
            employeeData:{
                name:'',
                clientType: null,
                profType: null,
                yearLevel: null,
                schoolCategory: null,
                sex: null,
                ageRange: null,
                office_school:'',
                dateVisited:'',
                timeIn:'',
                timeOut:''
            },
            employeeData_update:{},

            radio_sex: [{ text: 'Male', value: 'Male' },{ text: 'Female', value: 'Female'}],
            drop_clientType:[{ text: 'Select Client Type here', value: null }, 'Student', 'Professional'],
            drop_profType:[{ text: 'Select Professional Type here', value: null }, 'Government Employee', 'Private Employee'],
            drop_yearLevel:[{ text: 'Select Year Level here', value: null }, 'Elementary', 'Junior High School', 'Senior High School', 'College', 'Post Graduate (Master’s/Ph.D.)', 'Tech Vocational Education'],
            drop_schoolCategory:[{ text: 'Select School Category here', value: null }, 'Public School/College/University', 'Private School/College/University'],
            drop_ageRange:[{ text: 'Select Age Range here', value: null }, 'below 18 years old', '18-24 years old', '25-34 years old', '35-44 years old', '45 years old and above'],


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
                { key: 'id', sortable: true, label: 'Client ID'  },
                { key: 'name', sortable: true, label: 'Name'},
                { key: 'clientType', sortable: true, label: 'Client Type'},
                { key: 'profType', label: 'Prof Type' },,
                { key: 'yearLevel', label: 'Year Level' },
                { key: 'schoolCategory', label: 'School Category' },
                { key: 'sex', label: 'Sex' },
                { key: 'ageRange', label: 'Age Range' },
                { key: 'office_school', label: 'Office/School' },
                { key: 'dateVisited', label: 'Date Visited' },
                { key: 'timeIn', label: 'Time In' },
                { key: 'timeOut', label: 'Time Out' },
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
            formData.append('clientType', this.employeeData.clientType);
            formData.append('profType', this.employeeData.profType);
            formData.append('yearLevel', this.employeeData.yearLevel);
            formData.append('schoolCategory', this.employeeData.schoolCategory);
            formData.append('sex', this.employeeData.sex);
            formData.append('ageRange', this.employeeData.ageRange);
            formData.append('office_school', this.employeeData.office_school);
            formData.append('dateVisited', this.employeeData.dateVisited);
            formData.append('timeIn', this.employeeData.timeIn);
            formData.append('timeOut', this.employeeData.timeOut);

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
                    name:'',
                    clientType: null,
                    profType: null,
                    yearLevel: null,
                    schoolCategory: null,
                    sex: null,
                    ageRange: null,
                    office_school:'',
                    dateVisited:'',
                    timeIn:'',
                    timeOut:''
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
                formData.append('clientType', this.employeeData_update.clientType);
                formData.append('profType', this.employeeData_update.profType);
                formData.append('yearLevel', this.employeeData_update.yearLevel);
                formData.append('schoolCategory', this.employeeData_update.schoolCategory);
                formData.append('sex', this.employeeData_update.sex);
                formData.append('ageRange', this.employeeData_update.ageRange);
                formData.append('office_school', this.employeeData_update.office_school);
                formData.append('dateVisited', this.employeeData_update.dateVisited);
                formData.append('timeIn', this.employeeData_update.timeIn);
                formData.append('timeOut', this.employeeData_update.timeOut);

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