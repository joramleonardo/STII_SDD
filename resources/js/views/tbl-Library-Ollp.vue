<template>
  <div class="container-fluid">
        <ol class="breadcrumb mt-4 mb-4" style="background-color: white; ">
            <li class="breadcrumb-item active">Home > Library > OLLP</li>
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

            <b-modal id="add-employee" ref="add-employee" title="Add New Data" hide-footer>
              <b-form v-on:submit.prevent="createTraining">
                <b-card no-body>
                    <b-tabs card> 
                        <b-tab title="Section 1 of 2">
                            <b-card bg-variant="light">
                                    <b-form-group label="Name of Personnel who assisted you?" label-for="assistedBy" class="font-weight-600"> 
                                        <b-form-select v-model="trainingsData.assistedBy" id="assistedBy" :options="drop_assistedBy" required></b-form-select>
                                    </b-form-group> 
                                    <b-form-group label="Client Type:" label-for="clientType" class="font-weight-600"> 
                                        <b-form-select v-model="trainingsData.clientType" id="clientType" :options="drop_clientType" required></b-form-select>
                                    </b-form-group> 
                                    <b-form-group label="RESPONSIVENESS:" label-cols-sm="2" class="font-weight-600">
                                        <p style="font-weight: normal; margin-top: 6px">My requests/queries were answered promptly during library hours (Mon-Friday / 8:00AM - 5:00 PM)</p>
                                        <b-form-radio-group v-model="trainingsData.responsiveness"
                                            :options="drop_evaluation"
                                            id="responsiveness">
                                        </b-form-radio-group>
                                    </b-form-group>
                                    <b-form-group label="RELIABILITY:" label-cols-sm="2" class="font-weight-600">
                                        <p style="font-weight: normal; margin-top: 6px">The reference service was able to provide accurate and relevant materials based on my needs.</p>
                                        <b-form-radio-group v-model="trainingsData.reliability"
                                            :options="drop_evaluation"
                                            id="reliability">
                                        </b-form-radio-group>
                                    </b-form-group>
                                    <b-form-group label="ACCESS AND FACILITIES:" label-cols-sm="2" class="font-weight-600">
                                        <p style="font-weight: normal; margin-top: 6px">Library service is available online through different platforms (Email, chat messaging).</p>
                                        <b-form-radio-group v-model="trainingsData.accessAndFacilities"
                                            :options="drop_evaluation"
                                            id="accessAndFacilities">
                                        </b-form-radio-group>
                                    </b-form-group>
                                    <b-form-group label="COMMUNICATION:" label-cols-sm="2" class="font-weight-600">
                                        <p style="font-weight: normal; margin-top: 6px">The instructions on how to avail the library services are clear and easy to understand.</p>
                                        <b-form-radio-group v-model="trainingsData.communication"
                                            :options="drop_evaluation"
                                            id="communication">
                                        </b-form-radio-group>
                                    </b-form-group>
                                    <b-form-group label="COSTS:" label-cols-sm="2" class="font-weight-600">
                                        <p style="font-weight: normal; margin-top: 6px">The service is free and accessible to the general public.</p>
                                        <b-form-radio-group v-model="trainingsData.costs"
                                            :options="drop_evaluation"
                                            id="costs">
                                        </b-form-radio-group>
                                    </b-form-group>
                                    <b-form-group label="INTEGRITY:" label-cols-sm="2" class="font-weight-600">
                                        <p style="font-weight: normal; margin-top: 6px">The library staff demonstrates consistently the general accepted values and norms of professional and ethical behavior in providing library service.</p>
                                        <b-form-radio-group v-model="trainingsData.integrity"
                                            :options="drop_evaluation"
                                            id="integrity">
                                        </b-form-radio-group>
                                    </b-form-group>
                                    <b-form-group label="ASSURANCE:" label-cols-sm="2" class="font-weight-600">
                                        <p style="font-weight: normal; margin-top: 6px">The library service reflects the competence and professionalism of staff in providing accurate and relevant S&T information.</p>
                                        <b-form-radio-group v-model="trainingsData.assurance"
                                            :options="drop_evaluation"
                                            id="assurance">
                                        </b-form-radio-group>
                                    </b-form-group>
                                    <b-form-group label="OUTCOME:" label-cols-sm="2" class="font-weight-600">
                                        <p style="font-weight: normal; margin-top: 6px">Library service utilizes its library collection in providing accurate, relevant and timely S&T information to the public.</p>
                                        <b-form-radio-group v-model="trainingsData.outcome"
                                            :options="drop_evaluation"
                                            id="outcome">
                                        </b-form-radio-group>
                                    </b-form-group>
                                    
                            </b-card> 
                        </b-tab>
                        <b-tab title="Section 2 of 2">
                            <b-card bg-variant="light">
                                    <b-form-group label="Sex:" label-for="status" class="font-weight-600"> 
                                        <b-form-select v-model="trainingsData.sex" id="sex" :options="drop_sex" required></b-form-select>
                                    </b-form-group> 
                                    <b-form-group label="Category:" label-for="status"  class="font-weight-600"> 
                                        <b-form-select v-model="trainingsData.category" id="category" :options="drop_category" required></b-form-select>
                                    </b-form-group> 
                                    <b-form-group label="Age Bracket:" label-for="status"  class="font-weight-600"> 
                                        <b-form-select v-model="trainingsData.ageBracket" id="ageBracket" :options="drop_ageBracket" required></b-form-select>
                                    </b-form-group> 
                                    <b-form-group label="Region:" label-for="status"  class="font-weight-600"> 
                                        <b-form-select v-model="trainingsData.region" id="region" :options="drop_region" required></b-form-select>
                                    </b-form-group> 
                                    <b-form-group label="Research Interests/Topics:" label-for="researchInterests"  class="font-weight-600">
                                        <b-form-input v-model="trainingsData.researchInterests" id="researchInterests" type="text" placeholder="Enter here..." required></b-form-input>
                                    </b-form-group>
                                    <b-form-group label="Topic / Title you would like to obtain but not found in the library:" label-for="title" class="font-weight-600">
                                        <b-form-input v-model="trainingsData.topic" id="topic" type="text" placeholder="Enter here..." required></b-form-input>
                                    </b-form-group>
                                    <b-form-group label="Message / Comment / Suggestion:" label-for="title"  class="font-weight-600">
                                        <b-form-input v-model="trainingsData.suggestion" id="suggestion" type="text" placeholder="Enter here..." required></b-form-input>
                                    </b-form-group>
                            </b-card> 
                        </b-tab>
                    </b-tabs> 
                </b-card>
                <div class="float-right">
                    <b-button type="button" class="btn btn-default" variant="outline-danger" v-on:click="hideEmployeeModal">Cancel</b-button>
                    <b-button type="submit" class="btn" variant="outline-success" >Save</b-button> 
                </div>
              </b-form>
            </b-modal>
            <!-- trainingsData_update -->
            <b-modal id="updateEmployeeModal" ref="updateEmployeeModal" title="Add New Training" hide-footer>
              <b-form v-on:submit.prevent="updateEmployee">
                <b-card no-body>
                    <b-tabs card> 
                        <b-tab title="Section 1 of 2">
                            <b-card bg-variant="light">
                                    <b-form-group label="Name of Personnel who assisted you?" label-for="assistedBy" class="font-weight-600"> 
                                        <b-form-select v-model="trainingsData_update.assistedBy" id="assistedBy" :options="drop_assistedBy" required></b-form-select>
                                    </b-form-group> 
                                    <b-form-group label="Client Type:" label-for="clientType" class="font-weight-600"> 
                                        <b-form-select v-model="trainingsData_update.clientType" id="clientType" :options="drop_clientType" required></b-form-select>
                                    </b-form-group> 

                                    <b-form-group label="RESPONSIVENESS:" label-cols-sm="2" class="font-weight-600">
                                        <p style="font-weight: normal; margin-top: 6px">My requests/queries were answered promptly during library hours (Mon-Friday / 8:00AM - 5:00 PM)</p>
                                        <b-form-radio-group v-model="trainingsData_update.responsiveness"
                                            :options="drop_evaluation"
                                            id="responsiveness">
                                        </b-form-radio-group>
                                    </b-form-group>
                                    <b-form-group label="RELIABILITY:" label-cols-sm="2" class="font-weight-600">
                                        <p style="font-weight: normal; margin-top: 6px">The reference service was able to provide accurate and relevant materials based on my needs.</p>
                                        <b-form-radio-group v-model="trainingsData_update.reliability"
                                            :options="drop_evaluation"
                                            id="reliability">
                                        </b-form-radio-group>
                                    </b-form-group>
                                    <b-form-group label="ACCESS AND FACILITIES:" label-cols-sm="2" class="font-weight-600">
                                        <p style="font-weight: normal; margin-top: 6px">Library service is available online through different platforms (Email, chat messaging).</p>
                                        <b-form-radio-group v-model="trainingsData_update.accessAndFacilities"
                                            :options="drop_evaluation"
                                            id="accessAndFacilities">
                                        </b-form-radio-group>
                                    </b-form-group>
                                    <b-form-group label="COMMUNICATION:" label-cols-sm="2" class="font-weight-600">
                                        <p style="font-weight: normal; margin-top: 6px">The instructions on how to avail the library services are clear and easy to understand.</p>
                                        <b-form-radio-group v-model="trainingsData_update.communication"
                                            :options="drop_evaluation"
                                            id="communication">
                                        </b-form-radio-group>
                                    </b-form-group>
                                    <b-form-group label="COSTS:" label-cols-sm="2" class="font-weight-600">
                                        <p style="font-weight: normal; margin-top: 6px">The service is free and accessible to the general public.</p>
                                        <b-form-radio-group v-model="trainingsData_update.costs"
                                            :options="drop_evaluation"
                                            id="costs">
                                        </b-form-radio-group>
                                    </b-form-group>
                                    <b-form-group label="INTEGRITY:" label-cols-sm="2" class="font-weight-600">
                                        <p style="font-weight: normal; margin-top: 6px">The library staff demonstrates consistently the general accepted values and norms of professional and ethical behavior in providing library service.</p>
                                        <b-form-radio-group v-model="trainingsData_update.integrity"
                                            :options="drop_evaluation"
                                            id="integrity">
                                        </b-form-radio-group>
                                    </b-form-group>
                                    <b-form-group label="ASSURANCE:" label-cols-sm="2" class="font-weight-600">
                                        <p style="font-weight: normal; margin-top: 6px">The library service reflects the competence and professionalism of staff in providing accurate and relevant S&T information.</p>
                                        <b-form-radio-group v-model="trainingsData_update.assurance"
                                            :options="drop_evaluation"
                                            id="assurance">
                                        </b-form-radio-group>
                                    </b-form-group>
                                    <b-form-group label="OUTCOME:" label-cols-sm="2" class="font-weight-600">
                                        <p style="font-weight: normal; margin-top: 6px">Library service utilizes its library collection in providing accurate, relevant and timely S&T information to the public.</p>
                                        <b-form-radio-group v-model="trainingsData_update.outcome"
                                            :options="drop_evaluation"
                                            id="outcome">
                                        </b-form-radio-group>
                                    </b-form-group>
                            </b-card> 
                        </b-tab>
                        <b-tab title="Section 2 of 2">
                            <b-card bg-variant="light">
                                    <b-form-group label="Sex:" label-for="status" class="font-weight-600"> 
                                        <b-form-select v-model="trainingsData_update.sex" id="sex" :options="drop_sex" required></b-form-select>
                                    </b-form-group> 
                                    <b-form-group label="Category:" label-for="status"  class="font-weight-600"> 
                                        <b-form-select v-model="trainingsData_update.category" id="category" :options="drop_category" required></b-form-select>
                                    </b-form-group> 
                                    <b-form-group label="Age Bracket:" label-for="status"  class="font-weight-600"> 
                                        <b-form-select v-model="trainingsData_update.ageBracket" id="ageBracket" :options="drop_ageBracket" required></b-form-select>
                                    </b-form-group> 
                                    <b-form-group label="Region:" label-for="status"  class="font-weight-600"> 
                                        <b-form-select v-model="trainingsData_update.region" id="region" :options="drop_region" required></b-form-select>
                                    </b-form-group> 
                                    <b-form-group label="Research Interests/Topics:" label-for="researchInterests"  class="font-weight-600">
                                        <b-form-input v-model="trainingsData_update.researchInterests" id="researchInterests" type="text" placeholder="Enter here..." required></b-form-input>
                                    </b-form-group>
                                    <b-form-group label="Topic / Title you would like to obtain but not found in the library:" label-for="title" class="font-weight-600">
                                        <b-form-input v-model="trainingsData_update.topic" id="topic" type="text" placeholder="Enter here..." required></b-form-input>
                                    </b-form-group>
                                    <b-form-group label="Message / Comment / Suggestion:" label-for="title"  class="font-weight-600">
                                        <b-form-input v-model="trainingsData_update.suggestion" id="suggestion" type="text" placeholder="Enter here..." required></b-form-input>
                                    </b-form-group>
                            </b-card> 
                        </b-tab>
                    </b-tabs> 
                </b-card>
                <div class="float-right">
                    <b-button type="button" class="btn btn-default" variant="outline-danger" v-on:click="hideEmployeeModal">Cancel</b-button>
                    <b-button type="submit" class="btn" variant="outline-success">Save</b-button> 
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
                    :items="employees2"
                    :fields="requestFields"
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
                    Total Rows: <b>{{totalRows}}</b>
                </div>
                <div class="my-1">
                    
                    <b-pagination
                        v-model="currentPage"
                        :total-rows="totalRows"
                        :per-page="perPage"
                        align="center"
                        class="my-0"
                    >
                    </b-pagination>
                </div>
            </div>
        </div>
      </div>
    </div>
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
            employees2: [],
            value1: null,
            value2: null,
            trainings: [],
            trainingsData:{
                assistedBy: '',
                clientType: null,
                responsiveness: '',
                reliability: '',
                accessAndFacilities:'',
                communication:'',
                costs:'',
                integrity: '',
                assurance: '',
                outcome: '',
                sex: null,
                category: null,
                ageBracket: null,
                region: null,
                researchInterests: '',
                topic: '',
                suggestion: '',

            },
            trainingsData_update:{},
            drop_assistedBy: [{ text: 'Select here', value: null }, 
                                                            'Lynderlitte Maglaque', 
                                                            'Irene Brillo', 
                                                            'Louie Marquez', 
                                                            'Elmer Generalao', 
                                                            'Arjay Escondo'],
            drop_clientType: [{text: 'Select here', value: null},
                                                            'Walk-in/On-site',
                                                            'Online',
                                                            'Library Tour/Visit'],
            drop_evaluation: [
                { text: ' 1', value: '1' },
                { text: ' 2', value: '2' },
                { text: ' 3', value: '3' },
                { text: ' 4', value: '4' },
                { text: ' 5', value: '5' },
            ],
            drop_sex: [{text: 'Select here', value: null},
                                                            'Male',
                                                            'Female'],
            drop_category: [{text: 'Select here', value: null},
                                                            'Student',
                                                            'Professional'],
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
            drop_region: [{text: 'Select here', value: null},
                                                            'Region I',
                                                            'Region II',
                                                            'Region III',
                                                            'National Capital Region',
                                                            'Region IV-A',
                                                            'Region IV-B',
                                                            'Region V',
                                                            'Region VI',
                                                            'Region VII',
                                                            'Region VIII',
                                                            'Region IX',
                                                            'Region X',
                                                            'Region XI',
                                                            'Region XII',
                                                            'Caraga Region',
                                                            'BARMM'],
            errors : '',
            totalRows: 1,
            currentPage: 1,
            perPage: 20,
            filterOn: [],
            filter: null,
            sortDirection: 'asc',
            sortBy: 'id',
            sortDesc: false,
            requestFields: [
                { key: 'startTime', label: 'Date' },
                { key: "sex", label: "Sex" },
                { key: "category", label: "Category" },
                { key: 'actions', label: 'Action' }]
            }
    },
    mounted() {
        this.loadTrainings();
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
        returnPaginate(){
            this.currentPage = 1;
        },
        loadTrainings: async function() {
            try{
                const response = await employeeService.loadOllpData();
                this.employees2 = response.data.data;
                this.totalRows = this.employees2.length;
            } catch(error) {
                this.flashMessage.error({
                message: 'Some error occured! Please refresh.',
                time: 5000
                });
            }
        },
        createTraining: async function() {
            let formData = new FormData();

            formData.append('assistedBy', this.trainingsData.assistedBy);
            formData.append('clientType', this.trainingsData.clientType);
            formData.append('responsiveness', this.trainingsData.responsiveness);
            formData.append('reliability', this.trainingsData.reliability);
            formData.append('accessAndFacilities', this.trainingsData.accessAndFacilities);
            formData.append('communication', this.trainingsData.communication);
            formData.append('costs', this.trainingsData.costs);
            formData.append('integrity', this.trainingsData.integrity);
            formData.append('assurance', this.trainingsData.assurance);
            formData.append('outcome', this.trainingsData.outcome);
            formData.append('sex', this.trainingsData.sex);
            formData.append('category', this.trainingsData.category);
            formData.append('ageBracket', this.trainingsData.ageBracket);
            formData.append('region', this.trainingsData.region);
            formData.append('researchInterests', this.trainingsData.researchInterests);
            formData.append('topic', this.trainingsData.topic);
            formData.append('suggestion', this.trainingsData.suggestion);

            try {
                const response = await employeeService.createMaterialRequest(formData);
                console.log(response);
                this.hideEmployeeModal();
                this.flashMessage.success({
                    status: '',
                    message: 'Training added successfully!',
                    time: 5000
                });
                this.trainingsData = {
                    assistedBy: '',
                    clientType: null,
                    responsiveness: '',
                    reliability: '',
                    accessAndFacilities:'',
                    communication:'',
                    costs:'',
                    integrity: '',
                    assurance: '',
                    outcome: '',
                    sex: null,
                    category: null,
                    ageBracket: null,
                    region: null,
                    researchInterests: '',
                    topic: '',
                    suggestion: '',
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
        },
        updateEmployee: async function() {
            try {

                let formData = new FormData();
                
                formData.append('assistedBy', this.trainingsData_update.assistedBy);
                formData.append('clientType', this.trainingsData_update.clientType);
                formData.append('responsiveness', this.trainingsData_update.responsiveness);
                formData.append('reliability', this.trainingsData_update.reliability);
                formData.append('accessAndFacilities', this.trainingsData_update.accessAndFacilities);
                formData.append('communication', this.trainingsData_update.communication);
                formData.append('costs', this.trainingsData_update.costs);
                formData.append('integrity', this.trainingsData_update.integrity);
                formData.append('assurance', this.trainingsData_update.assurance);
                formData.append('outcome', this.trainingsData_update.outcome);
                formData.append('sex', this.trainingsData_update.sex);
                formData.append('category', this.trainingsData_update.category);
                formData.append('ageBracket', this.trainingsData_update.ageBracket);
                formData.append('region', this.trainingsData_update.region);
                formData.append('researchInterests', this.trainingsData_update.researchInterests);
                formData.append('topic', this.trainingsData_update.topic);
                formData.append('suggestion', this.trainingsData_update.suggestion);

                formData.append("_method", "put");

                const response = await employeeService.updateMaterialRequest(this.trainingsData_update.id, formData);
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
                const response = await employeeService.deleteMaterialRequest(trainings_Data.id);
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