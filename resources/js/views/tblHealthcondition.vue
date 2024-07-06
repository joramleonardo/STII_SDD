<template>
  <div class="container-fluid">
    <h1 class="mt-4 stii-font-color-red">Health and Training</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Home > Health and Training > Health Condition </li>
    </ol>
    
    <div class="row">
      <div class="col-xl-12">
        <div class="card mb-4">
          <div class="card-header card-header-title" style="background-color: #ed262a; color: white">
            <i class="fas fa-list-alt mr-1"></i>
            LIST OF EMPLOYEES' HEALTH CONDITIONS
            <b-button v-b-modal.add-employee class="float-right" style="background-color:white; color:black"><i class="fas fa-plus-square"></i></b-button>
            <b-modal id="add-employee" ref="add-employee" title="Add New Employee" hide-footer>
              <b-form v-on:submit.prevent="createHealth">
                <b-card no-body>
                    <b-card bg-variant="light">
                        <b-form-group label="Employee ID:" label-for="employeeID" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                            <b-form-input v-model="healthData.employeeID" id="employeeID" type="text" placeholder="Enter Employee ID here..." required></b-form-input>
                        </b-form-group>
                        <b-form-group id="input-group-5" label="Age Range:" label-for="ageRange" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                            <b-form-select v-model="healthData.ageRange" id="ageRange" :options="drop_ageRange" required></b-form-select>
                        </b-form-group> 
                        <b-form-group label="Year Cover:" label-cols-sm="2" label-align-sm="right" class="mb-0 font-weight-700"  v-slot="{  }" >
                            <b-form-radio-group v-model="healthData.yearCover" id="yearCover" class="pt-2 font-weight-600" :options="radio_yearCover" ></b-form-radio-group>
                        </b-form-group>
                        <b-form-group label="Health Condition:" label-cols-sm="2" label-align-sm="right" class="mb-0 font-weight-700"  v-slot="{  }" >
                            <b-form-radio-group v-model="healthData.healthCondition" id="healthCondition" class="pt-2 font-weight-600" :options="radio_healthCondition" ></b-form-radio-group>
                        </b-form-group>
                        <b-form-group id="input-group-5" label="Illness Type:" label-for="illnessType" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                            <b-form-select v-model="healthData.illnessType" id="illnessType" :options="drop_illnessType" required></b-form-select>
                        </b-form-group> 
                        <b-form-group id="input-group-5" label="Fit Status:" label-for="fitStatus" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                            <b-form-select v-model="healthData.fitStatus" id="fitStatus" :options="drop_fitStatus" required></b-form-select>
                        </b-form-group> 
                        <b-form-group id="input-group-5" label="Vaccine Status:" label-for="vaccineStatus" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                            <b-form-select v-model="healthData.vaccineStatus" id="vaccineStatus" :options="drop_vaccine" required></b-form-select>
                        </b-form-group> 
                        <b-form-group id="input-group-5" label="Booster Status:" label-for="boosterStatus" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                            <b-form-select v-model="healthData.boosterStatus" id="boosterStatus" :options="drop_booster" required></b-form-select>
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
                        
                        <b-form-group id="input-group-5" label="Age Range:" label-for="ageRange" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                            <b-form-select v-model="healthData_update.ageRange" id="ageRange" :options="drop_ageRange" required></b-form-select>
                        </b-form-group> 
                        <b-form-group label="Year Cover:" label-cols-sm="2" label-align-sm="right" class="mb-0 font-weight-700"  v-slot="{  }" >
                            <b-form-radio-group v-model="healthData_update.yearCover" id="yearCover" class="pt-2 font-weight-600" :options="radio_yearCover" ></b-form-radio-group>
                        </b-form-group>
                        <b-form-group label="Health Condition:" label-cols-sm="2" label-align-sm="right" class="mb-0 font-weight-700"  v-slot="{  }" >
                            <b-form-radio-group v-model="healthData_update.healthCondition" id="healthCondition" class="pt-2 font-weight-600" :options="radio_healthCondition" ></b-form-radio-group>
                        </b-form-group>
                        <b-form-group id="input-group-5" label="Illness Type:" label-for="illnessType" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                            <b-form-select v-model="healthData_update.illnessType" id="illnessType" :options="drop_illnessType" required></b-form-select>
                        </b-form-group> 
                        <b-form-group id="input-group-5" label="Fit Status:" label-for="fitStatus" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                            <b-form-select v-model="healthData_update.fitStatus" id="fitStatus" :options="drop_fitStatus" required></b-form-select>
                        </b-form-group> 
                        <b-form-group id="input-group-5" label="Vaccine Status:" label-for="vaccineStatus" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                            <b-form-select v-model="healthData_update.vaccineStatus" id="vaccineStatus" :options="drop_vaccine" required></b-form-select>
                        </b-form-group> 
                        <b-form-group id="input-group-5" label="Booster Status:" label-for="boosterStatus" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                            <b-form-select v-model="healthData_update.boosterStatus" id="boosterStatus" :options="drop_booster" required></b-form-select>
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
                    :items="healths"
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
            healths: [],
            healthData:{
                employeeID:'',
                ageRange: null,
                yearCover: null,
                healthCondition: null,
                illnessType: null,
                fitStatus: null
            },
            healthData_update:{},
            // drop_ageRange: [{ text: 'Select Age Range here', value: null }, '20-29', '30-39', '40-49', '50-59', '60-65'],
            drop_ageRange: [{ text: 'Select Age Range here', value: null }, '20', '30', '40', '50', '60'],
            radio_yearCover: [{ text: '2019', value: '2019' },{ text: '2020', value: '2020'}],
            radio_healthCondition: [{ text: 'With condition', value: 'With condition' },
                                    { text: 'Without condition', value: 'Without condition'}],
            drop_illnessType: [{ text: 'Select Illness Type here', value: null }, 'Cardio-related', 
                                                                                  'Pulmonary/respiratory/respiratoryD', 
                                                                                  'EENT', 
                                                                                  'Overweight', 
                                                                                  'Hemorrhoids'],
            drop_fitStatus: [{ text: 'Select Fit Status here', value: null }, 'Class A - Fit to Work', 
                                                                              'Class B - Fit to work but needs treatment of minor ailments', 
                                                                              'Class D - Unfit to work'],
            drop_vaccine: [{ text: 'Select Vaccine Status here', value: null }, 'Unvaccinated', 
                                                                                'Partially Vaccinated', 
                                                                                'Fully Vaccinated'],
            drop_booster: [{ text: 'Select Booster Status here', value: null }, 'With 1 booster shot', 
                                                                                'With 2 booster shots', 
                                                                                'None'],

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
                { key: 'employee_number', sortable: true, label: 'Employee Number' },
                { key: 'name', label: 'Name' },
                { key: 'ageRange', label: 'Age Range' },
                { key: 'yearCover', label: 'Year Cover' },
                { key: 'healthCondition', label: 'Health Condition' },
                { key: 'illnessType', label: 'Illness Type' },
                { key: 'fitStatus', label: 'Fit Status' },
                { key: 'actions', label: 'Action' }
            ]
        }
    },
    mounted() {
        this.loadHealth();
       
    },
    methods: {
        showUpdateMdl(data){
            this.healthData_update = {...data}
            this.$refs.updateEmployeeModal.show()
        },
        hideUpdateMdl(data){
            this.healthData_update = {...data}
            this.$refs.updateEmployeeModal.hide()
        },
        clearModal(){
            this.$refs.add-employee.removeData();
        },
        loadHealth: async function() {
            try{
                const response = await employeeService.loadHealth();
                this.healths = response.data;
            } catch(error) {
                this.flashMessage.error({
                message: 'Some error occured! Please try again.',
                time: 5000
                });
            }
        },
        createHealth: async function() {
            let formData = new FormData();
            formData.append('employeeID', this.healthData.employeeID);
            formData.append('ageRange', this.healthData.ageRange);
            formData.append('yearCover', this.healthData.yearCover);
            formData.append('healthCondition', this.healthData.healthCondition);
            formData.append('illnessType', this.healthData.illnessType);
            formData.append('fitStatus', this.healthData.fitStatus);

            try {
                const response = await employeeService.createHealth(formData);
                console.log(response);
                this.hideEmployeeModal();
                this.flashMessage.success({
                    status: '',
                    message: 'Health condition added successfully!',
                    time: 5000
                });
                this.healthData = {
                    employeeID:'',
                    ageRange: null,
                    yearCover: null,
                    healthCondition: null,
                    illnessType: null,
                    fitStatus: null
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
            this.loadHealth();
            this.clearModal();
        },
        updateEmployee: async function() {
            try {

                let formData = new FormData();
                formData.append('ageRange', this.healthData_update.ageRange);
                formData.append('yearCover', this.healthData_update.yearCover);
                formData.append('healthCondition', this.healthData_update.healthCondition);
                formData.append('illnessType', this.healthData_update.illnessType);
                formData.append('fitStatus', this.healthData_update.fitStatus);

                formData.append("_method", "put");

                const response = await employeeService.updateHealthData(this.healthData_update.id, formData);
                console.log(response);

                this.flashMessage.success({
                    status: '',
                    message: 'Health condition updated successfully!',
                    time: 5000
                });

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
            this.loadHealth();
            this.hideUpdateMdl();
        },
        deleteEmployee: async function(data){
            var health_Data = {...data}
            try {
                const response = await employeeService.deleteHealths(health_Data.id);
                console.log(response);
                this.flashMessage.success({
                    status: '',
                    message: 'Health Condition deleted successfully!',
                    time: 5000
                });
            }
            catch (e) {
                this.flashMessage.error({
                    message: 'Some error occured! Please try again.',
                    time: 5000
                    });
            }
            this.loadHealth();
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