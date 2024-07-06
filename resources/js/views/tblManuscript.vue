<template>
  <div class="container-fluid">
    <h1 class="mt-4 stii-font-color-red">Philippine Journal of Science</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Home > Philippine Journal of Science > Manuscript</li>
    </ol>
    <div class="row">
      <div class="col-xl-12">
        <div class="card mb-4">
          <div class="card-header card-header-title" style="background-color: #ed262a; color: white">
            <i class="fas fa-list-alt mr-1"></i>
            LIST OF MANUSCRIPTS
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
                    <!--<b-form-group label="Employee Number:" label-for="employee_number" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.employee_number" id="employee_number" type="text" placeholder="Enter Employee ID here..." required></b-form-input>
                    </b-form-group>-->
                    <b-form-group label="Researcher ID:" label-for="researcher_id" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.researcher_id" id="researcher_id" type="text" placeholder="Enter Researcher ID here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Title:" label-for="title" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.title" id="title" type="text" placeholder="Enter title here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Area:" label-for="area" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData.area" id="area" :options="drop_area" required></b-form-select>
                    </b-form-group> 
                    <b-form-group label="Location:" label-for="location" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData.location" id="location" :options="drop_location" required></b-form-select>
                    </b-form-group> 
                    <b-form-group label="Discipline:" label-for="discipline" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData.discipline" id="discipline" :options="drop_discipline" required></b-form-select>
                    </b-form-group> 
                    <b-form-group label="Other Discipline:" label-for="otherDiscipline" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.otherDiscipline" id="otherDiscipline" type="text" placeholder="Enter Other Discipline here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Date Received:" label-for="dateReceived" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-datepicker v-model="employeeData.dateReceived" id="dateReceived" locale="en"></b-form-datepicker>
                    </b-form-group>
                    <b-form-group label="Status:" label-for="status" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData.status" id="status" :options="drop_status" required></b-form-select>
                    </b-form-group> 
                    <b-form-group label="Issue No:" label-for="issueNo" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.issueNo" id="issueNo" type="text" placeholder="Enter Issue No here..." required></b-form-input>
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
                    <b-form-group label="Researcher ID:" label-for="researcher_id" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.researcher_id" id="researcher_id" type="text" placeholder="Enter Researcher ID here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Title:" label-for="title" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.title" id="title" type="text" placeholder="Enter title here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Area:" label-for="area" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData_update.area" id="area" :options="drop_area" required></b-form-select>
                    </b-form-group> 
                    <b-form-group label="Location:" label-for="location" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData_update.location" id="location" :options="drop_location" required></b-form-select>
                    </b-form-group> 
                    <b-form-group label="Discipline:" label-for="discipline" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData_update.discipline" id="discipline" :options="drop_discipline" required></b-form-select>
                    </b-form-group> 
                    <b-form-group label="Other Discipline:" label-for="otherDiscipline" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.otherDiscipline" id="otherDiscipline" type="text" placeholder="Enter Other Discipline here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Date Received:" label-for="dateReceived" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-datepicker v-model="employeeData_update.dateReceived" id="dateReceived" locale="en"></b-form-datepicker>
                    </b-form-group>
                    <b-form-group label="Status:" label-for="status" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData_update.status" id="status" :options="drop_status" required></b-form-select>
                    </b-form-group> 
                    <b-form-group label="Issue No:" label-for="issueNo" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.issueNo" id="issueNo" type="text" placeholder="Enter Issue No here..." required></b-form-input>
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
import * as employeeService from '../services/pjs_service';

export default {
    name: 'employee',
    data() {
        return {
            employees: [],
            employeeData:{
                researcher_id:'',
                title:'',
                area: null,
                location: null,
                discipline: null,
                otherDiscipline:'',
                dateReceived:'',
                status: null,
                issueNo:''
            },
            employeeData_update:{},

            drop_area: [{ text: 'Select Area here', value: null }, 'Local', 'Overseas/Foreign'],
            drop_location: [{ text: 'Select Location here', value: null }, 'Metro Manila', 'Luzon', 'Visayas', 'Mindanao', 'Overseas'],
            drop_discipline: [{ text: 'Select Discipline here', value: null },  'Agriculture',
                                                                                'Biology', 
                                                                                'Chemistry', 
                                                                                'Computer Science', 
                                                                                'Earth Science', 
                                                                                'Engineering', 
                                                                                'Food Science and Technology', 
                                                                                'Forensics', 
                                                                                'Forestry', 
                                                                                'Mathematics', 
                                                                                'Medicine', 
                                                                                'Nutrition', 
                                                                                'Physics', 
                                                                                'Public Admin & Governance', 
                                                                                'Statistics', 
                                                                                'Social Science', 
                                                                                'Others'],
            drop_status: [{ text: 'Select Status here', value: null }, 'Accepted', 'Rejected'],

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
                { key: 'researcher_id', sortable: true, label: 'Researcher ID'},
                { key: 'title', sortable: true, label: 'Title'},
                { key: 'area', sortable: true, label: 'Area'},
                { key: 'location', label: 'location' },
                { key: 'discipline', sortable: true, label: 'Discipline'},
                { key: 'otherDiscipline', label: 'Other Discipline' },
                { key: 'dateReceived', label: 'Date Received' },
                { key: 'status', label: 'Status' },
                { key: 'issueNo', label: 'Issue No' },
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
                const response = await employeeService.loadManuscripts();
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
            formData.append('researcher_id', this.employeeData.researcher_id);
            formData.append('title', this.employeeData.title);
            formData.append('area', this.employeeData.area);
            formData.append('location', this.employeeData.location);
            formData.append('discipline', this.employeeData.discipline);
            formData.append('otherDiscipline', this.employeeData.otherDiscipline);
            formData.append('dateReceived', this.employeeData.dateReceived);
            formData.append('status', this.employeeData.status);
            formData.append('issueNo', this.employeeData.issueNo);

            try {
                const response = await employeeService.createManuscript(formData);
                console.log(response);
                this.hideEmployeeModal();
                this.flashMessage.success({
                    status: '',
                    message: 'Employee added successfully!',
                    time: 5000
                });
                this.employeeData = {
                    title:'',
                    area: null,
                    location: null,
                    discipline: null,
                    otherDiscipline:'',
                    dateReceived:'',
                    status: null,
                    issueNo:''
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
                formData.append('researcher_id', this.employeeData_update.researcher_id);
                formData.append('title', this.employeeData_update.title);
                formData.append('area', this.employeeData_update.area);
                formData.append('location', this.employeeData_update.location);
                formData.append('discipline', this.employeeData_update.discipline);
                formData.append('otherDiscipline', this.employeeData_update.otherDiscipline);
                formData.append('dateReceived', this.employeeData_update.dateReceived);
                formData.append('status', this.employeeData_update.status);
                formData.append('issueNo', this.employeeData_update.issueNo);

                formData.append("_method", "put");

                const response = await employeeService.updateManuscriptData(this.employeeData_update.id, formData);
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
                const response = await employeeService.deleteManuscript(employee_data.id);
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