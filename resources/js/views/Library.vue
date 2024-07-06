<template>
    <div class="container-fluid">
        <!--
        <h1 class="mt-4 stii-font-color-red">Library</h1>
        -->
        <ol class="breadcrumb mt-4 mb-4" style="background-color: white; ">
            <li class="breadcrumb-item active">Home > Records > Library</li>
        </ol>

        <div class="warpper">
            <input class="radio" id="one" name="group" type="radio" checked>
            <input class="radio" id="two" name="group" type="radio">
            <input class="radio" id="three" name="group" type="radio">
            <div class="tabs">
                <!--<label class="tab" id="one-tab" for="one">Material Request</label> -->
                <label class="tab" id="one-tab" for="one">Reference Service</label>
                <label class="tab" id="two-tab" for="two">OLLP</label>
                <label class="tab" id="three-tab" for="three">Webinars</label>
            </div>
            <div class="panels">
                <div class="panel" id="one-panel">
                    <div class="card mb-4">
                        <div class="card-header card-header-title" style="background-color: #ed262a; color: white" >
            <!--
            <i class="fas fa-list-alt mr-1"></i>
            LIST OF DATA
            -->
                            <b-modal id="htData" ref="htData" title="Add New Employee" hide-footer>
                                <b-tabs card>
                                    <b-tab title="Evaluation">
                                        <div class="card-body table-responsive p-4">
                                            <div>
                                                <b-table
                                                    striped
                                                    hover
                                                    :items="employees_evaluationData"
                                                    :fields="fields_materialRequest"
                                                    :sort-by.sync="sortBy"
                                                    :sort-desc.sync="sortDesc"
                                                    sort-icon-left
                                                    responsive="sm"
                                                    :filter="filter"
                                                    :current-page="currentPage"
                                                    :per-page="perPage"
                                                    :filter-included-fields="
                                                        filterOn
                                                    "
                                                >
                                                </b-table>
                                            </div>
                                        </div>
                                    </b-tab>
                                </b-tabs>
                            </b-modal>
                        </div>
                        <div class="card-body table-responsive p-4">
                            <div>
                                <div class="card-tools">
                                    <b-row >
                                        <b-col lg="10" class=" mb-1">
                                            <b-form-group label="Search" label-for="filter-input" label-cols-sm="2" label-align-sm="center">
                                                <b-input-group>
                                                    <b-form-input id="filter-input" v-model="filter" type="search" placeholder="Type to Search" v-on:keydown="returnPaginate($event)"></b-form-input>
                                                </b-input-group>
                                            </b-form-group>
                                        </b-col>
                                    </b-row>
                                </div>
                                <b-table
                                    striped
                                    hover
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
                                        <b-button @click="loadEmployeeHealthAndTraining(row.item)" size="sm" class="mr-1 jkl-btn-view">View Evaluation Data</b-button>
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
                <div class="panel" id="two-panel">
                    <div class="card mb-4">
                        <div class="card-header card-header-title" style="background-color: #ed262a; color: white" >
            <!--
            <i class="fas fa-list-alt mr-1"></i>
            LIST OF DATA
            -->
                            <b-modal id="evalQuizData" ref="evalQuizData" title="Add New Employee" hide-footer>
                                <b-tabs card>
                                    <b-tab title="Evaluation Data">
                                        <div class="card-body table-responsive p-4">
                                            <div>
                                                <b-table
                                                    striped
                                                    hover
                                                    :items="ollp_evalData"
                                                    :fields="fields_ollpEval"
                                                    :sort-by.sync="sortBy"
                                                    :sort-desc.sync="sortDesc"
                                                    sort-icon-left
                                                    responsive="sm"
                                                    :filter="filter"
                                                    :current-page="currentPage"
                                                    :per-page="perPage"
                                                    :filter-included-fields="
                                                        filterOn
                                                    "
                                                >
                                                </b-table>
                                            </div>
                                        </div>
                                    </b-tab>
                                    <b-tab title="Quiz Data">
                                        <div class="card-body table-responsive p-4">
                                            <div>
                                                <b-table
                                                    striped
                                                    hover
                                                    :items="ollp_quizData"
                                                    :fields="fields_ollpQuiz"
                                                    :sort-by.sync="sortBy"
                                                    :sort-desc.sync="sortDesc"
                                                    sort-icon-left
                                                    responsive="sm"
                                                    :filter="filter"
                                                    :current-page="currentPage"
                                                    :per-page="perPage"
                                                    :filter-included-fields="
                                                        filterOn
                                                    "
                                                >
                                                </b-table>
                                            </div>
                                        </div>
                                    </b-tab>
                                </b-tabs>
                            </b-modal>
                        </div>
                        <div class="card-body table-responsive p-4">
                            <div>
                                <div class="card-tools">
                                    <b-row >
                                        <b-col lg="10" class=" mb-1">
                                            <b-form-group label="Search" label-for="filter-input" label-cols-sm="2" label-align-sm="center">
                                                <b-input-group>
                                                    <b-form-input id="filter-input" v-model="filter" type="search" placeholder="Type to Search" v-on:keydown="returnPaginate($event)"></b-form-input>
                                                </b-input-group>
                                            </b-form-group>
                                        </b-col>
                                    </b-row>
                                </div>
                                <b-table striped hover 
                                    :items="employees2"
                                    :fields="ollpFields"
                                    :sort-by.sync="sortBy"
                                    :sort-desc.sync="sortDesc"
                                    sort-icon-left
                                    responsive="sm"
                                    :filter="filter"
                                    :current-page="currentPage"
                                    :per-page="perPage"
                                    :filter-included-fields="filterOn">
                                    <template #cell(actions)="row">
                                        <b-button @click="loadEvalAndQuiz(row.item)" size="sm" class="mr-1 jkl-btn-view">View Evaluation and Quiz Data</b-button>
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
                <div class="panel" id="three-panel">
                    <div class="card mb-4">
                        <div class="card-header card-header-title" style="background-color: #ed262a; color: white" >
            <!--
            <i class="fas fa-list-alt mr-1"></i>
            LIST OF DATA
            -->
                            <b-modal id="evalQuizData" ref="evalQuizData" title="Add New Employee" hide-footer>
                                <b-tabs card>
                                    <b-tab title="Evaluation Data">
                                        <div class="card-body table-responsive p-4">
                                            <div>
                                                <b-table
                                                    striped
                                                    hover
                                                    :items="ollp_evalData"
                                                    :fields="fields_ollpEval"
                                                    :sort-by.sync="sortBy"
                                                    :sort-desc.sync="sortDesc"
                                                    sort-icon-left
                                                    responsive="sm"
                                                    :filter="filter"
                                                    :current-page="currentPage"
                                                    :per-page="perPage"
                                                    :filter-included-fields="
                                                        filterOn
                                                    "
                                                >
                                                </b-table>
                                            </div>
                                        </div>
                                    </b-tab>
                                    <b-tab title="Quiz Data">
                                        <div class="card-body table-responsive p-4">
                                            <div>
                                                <b-table
                                                    striped
                                                    hover
                                                    :items="ollp_quizData"
                                                    :fields="fields_ollpQuiz"
                                                    :sort-by.sync="sortBy"
                                                    :sort-desc.sync="sortDesc"
                                                    sort-icon-left
                                                    responsive="sm"
                                                    :filter="filter"
                                                    :current-page="currentPage"
                                                    :per-page="perPage"
                                                    :filter-included-fields="
                                                        filterOn
                                                    "
                                                >
                                                </b-table>
                                            </div>
                                        </div>
                                    </b-tab>
                                </b-tabs>
                            </b-modal>
                        </div>
                        <div class="card-body table-responsive p-4">
                            <div>
                                <div class="card-tools">
                                    <b-row >
                                        <b-col lg="10" class=" mb-1">
                                            <b-form-group label="Search" label-for="filter-input" label-cols-sm="2" label-align-sm="center">
                                                <b-input-group>
                                                    <b-form-input id="filter-input" v-model="filter" type="search" placeholder="Type to Search" v-on:keydown="returnPaginate($event)"></b-form-input>
                                                </b-input-group>
                                            </b-form-group>
                                        </b-col>
                                    </b-row>
                                </div>
                                <b-table striped hover 
                                    :items="employees2"
                                    :fields="ollpFields"
                                    :sort-by.sync="sortBy"
                                    :sort-desc.sync="sortDesc"
                                    sort-icon-left
                                    responsive="sm"
                                    :filter="filter"
                                    :current-page="currentPage"
                                    :per-page="perPage"
                                    :filter-included-fields="filterOn">
                                    <template #cell(actions)="row">
                                        <b-button @click="loadEvalAndQuiz(row.item)" size="sm" class="mr-1 jkl-btn-view">View Evaluation and Quiz Data</b-button>
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

        
    </div>
</template>

<style scoped>
    /* .breadcrumb-item.active{
        color:black;
    } */
</style>

<script>
import * as healthAndTraining_service from "../services/library_service";
import * as employeeService from '../services/library_service';


export default {
    name: "employee",
    data() {
        return {
            employees: [],
            employees2: [],
            // employees_healthData: [],
            // employees_trainingData: [],
            employees_data: [],
            employees_clientData: [],
            employees_requesttData: [],
            employees_evaluationData: [],
            employees_researchlogData: [],
            ollp_evalData: [],
            ollp_quizData: [],

            employeeData: {
                name: "",
                sex: null,
                age: "",
                designation: "",
                nature: null,
                level: null,
                division: null
            },
            drop_sex: [{ text: 'Select Sex here', value: null }, 'Female', 'Male'],
            radio_sex: [
                { text: "Male", value: "Male" },
                { text: "Female", value: "Female" }
            ],
            drop_nature: [
                { text: "Select Nature here", value: null },
                "Permanent",
                "COS"
            ],
            drop_level: [
                { text: "Select Level here", value: null },
                "Executive",
                "Middle Manager",
                "Staff"
            ],
            drop_division: [
                { text: "Select Division here", value: null },
                "CRPD",
                "IRAD",
                "FAD",
                "OD-MISPS"
            ],
            drop_clientType:[{ text: 'Select Client Type here', value: null }, 'Student', 'Professional'],

            errors: "",
            totalRows: 1,
            currentPage: 1,
            perPage: 10,
            filterOn: [],
            filter: null,
            sortDirection: "asc",
            sortBy: "id",
            sortDesc: false,
            fields: [
                { key: 'clientType', label: 'Client Type' },
                { key: "category", label: "Category" },
                { key: "ageBracket", label: "Age Bracket" },
                { key: "sex", label: "Sex" },
                { key: "topic", label: "Topic/Title not found in the Library" },
                { key: "", label: "Date" },
                { key: 'actions', label: 'Action' }
            ],
            fields_materialRequest: [
                { key: "responsiveness", label: "Responsiveness" },
                { key: "reliability", label: "Reliability" },
                { key: "accessAndFacilities", label: "Access and Facilities" },
                { key: "communication", label: "Communication" },
                { key: "costs", label: "Costs" },
                { key: "integrity", label: "Integrity" },
                { key: "assurance", label: "Assurance" },
                { key: "outcome", label: "Outcome" },
            ],
            requestFields: [
                { key: "transactionDate", label: "Transaction Date" },
                { key: "status", label: "Status" },
                { key: "callNumber", label: "Call Number" },
                { key: "source", label: "Source" },
                { key: "title", label: "Title" },
                { key: "volIssueNo", label: "Vol Issue No" },
                { key: "numPages", label: "Num Pages" },
                { key: "timeIssued", label: "Time Issued" },
                { key: "timeReceived", label: "Time Received" },
                { key: "timeReturned", label: "Time Returned" },
                { key: "remarks", label: "Remarks" },
                { key: "assistedBy", label: "Assisted By" }
            ],
            evaluationFields: [
                { key: "transactionDate", label: "Transaction Date" },
                { key: "eval_1",label:"Relevance of the collection to the information needs"},
                { key: "eval_2",label: "Promptness and immediate attention of staff"},
                { key: "eval_3",label: "Knowledgeable and competent staff"},
                { key: "eval_4",label: "Courteousness and approachability of staff"},
                { key: "materialNotFound", label: "Material Not Found" },
                { key: "suggestions", label: "Suggestions / Recommendations" }
            ],
            researchLogFields: [
                { key: "transactionDate", label: "Transaction Date" },
                { key: "subjectResearch", label: "Subject Research" }
            ],
            ollpFields: [
                { key: 'startTime', label: 'Date' },
                { key: "sex", label: "Sex" },
                { key: "category", label: "Category" },
                { key: 'actions', label: 'Action' }
            ],
            fields_ollpEval: [
                { key: 'eval1', label: 'Eval 1' },
                { key: "eval2", label: "Eval 2" },
                { key: "eval3", label: "Eval 3" },
                { key: 'eval4', label: 'Eval 4' },
                { key: 'eval5', label: 'Eval 5' },
                { key: "eval6", label: "Eval 6" },
                { key: "eval7", label: "Eval 7" },
                { key: 'eval8', label: 'Eval 8' },
                { key: 'eval9', label: 'Eval 9' },
                { key: 'eval10', label: 'Eval 10' }
            ],
            fields_ollpQuiz: [
                { key: 'quiz1', label: 'Quiz 1' },
                { key: "quiz2", label: "Quiz 2" },
                { key: "quiz3", label: "Quiz 3" },
                { key: 'quiz4', label: 'Quiz 4' },
                { key: 'quiz5', label: 'Quiz 5' },
                { key: 'quiz6', label: 'Quiz 6' },
                { key: "quiz7", label: "Quiz 7" },
                { key: "quiz8", label: "Quiz 8" },
                { key: 'quiz9', label: 'Quiz 9' },
                { key: 'quiz10', label: 'Quiz 10' }
            ],
        };
    },
    mounted() {
        // this.loadEmployees();
        this.loadTrainings();
        this.loadTrainings2();
       
    },
    methods: {
        showMdl(data) {
            this.healthData_update = { ...data };
            this.$refs.updateEmployeeModal.show();
        },
        // loadEmployees: async function() {
        //     try{
        //         const response = await healthAndTraining_service.loadEmployees();
        //         this.employees = response.data.data;
        //         this.totalRows = this.employees.length;
        //     } catch(error) {
        //         this.flashMessage.error({
        //         message: 'Some error occured! Please try again.',
        //         time: 5000
        //         });
        //     }
        // },
        loadTrainings: async function() {
            try{
                const response = await employeeService.loadMaterialRequest();
                this.employees = response.data.data;
                this.totalRows = this.employees.length;
            } catch(error) {
                this.flashMessage.error({
                message: 'Some error occured! Please refresh.',
                time: 5000
                });
            }
        },
        loadTrainings2: async function() {
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
        loadEmployeeHealthAndTraining: async function(data) {
            this.$refs["htData"].show();

            const employees_evaluation_data = { ...data };
            try {
                const evaluation_response = await healthAndTraining_service.loadClientEvaluation(
                    employees_evaluation_data.id
                );


                this.employees_evaluationData = evaluation_response.data;
                console.log(evaluation_response);

            } catch (error) {
                this.flashMessage.error({
                    message: "Some error occured! Please refresh.",
                    time: 5000
                });
            }
        },
        loadEvalAndQuiz: async function(data) {
            this.$refs["evalQuizData"].show();

            const ollp_evaluation_data = { ...data };
            const ollp_quiz_data = { ...data };
            try {
                const ollp_evaluation_response = await healthAndTraining_service.loadOllpEval(
                    ollp_evaluation_data.id
                );
                const ollp_quiz_response = await healthAndTraining_service.loadOllpQuiz(
                    ollp_quiz_data.id
                );

                this.ollp_evalData = ollp_evaluation_response.data;
                console.log(ollp_evaluation_response);
                
                this.ollp_quizData = ollp_quiz_response.data;
                console.log(ollp_quiz_response);

            } catch (error) {
                this.flashMessage.error({
                    message: "Some error occured! Please refresh.",
                    time: 5000
                });
            }
        },
        deleteEmployee: async function(employee) {
            if (
                !window.confirm(
                    `Are you sure you want to delete ${employee.name}`
                )
            ) {
                return;
            }
            try {
                await healthAndTraining_service.deleteEmployee(employee.id);

                this.employees = this.employees.filter(obj => {
                    return obj.id != employee.id;
                });
                this.flashMessage.success({
                    message: "Account deleted succesfully!",
                    time: 5000
                });
            } catch (error) {
                this.flashMessage.error({
                    message: "Some error occured! Please refresh.",
                    time: 5000
                });
            }
        },
        createEmployee: async function() {
            let formData = new FormData();
            formData.append("name", this.employeeData.name);
            formData.append("sex", this.employeeData.sex);
            formData.append("age", this.employeeData.age);
            formData.append("designation", this.employeeData.designation);
            formData.append("nature", this.employeeData.nature);
            formData.append("level", this.employeeData.level);
            formData.append("division", this.employeeData.division);

            try {
                const response = await healthAndTraining_service.createAccount(
                    formData
                );
                console.log(response);
                this.hideEmployeeModal();
                this.flashMessage.success({
                    status: "",
                    message: "Employee added successfully!",
                    time: 5000
                });
                this.employeeData = {
                    name: "",
                    sex: null,
                    age: "",
                    designation: "",
                    nature: null,
                    level: null,
                    division: null
                };
            } catch (error) {
                switch (error.response.status) {
                    case 422:
                        this.errors = error.response.data.errors;
                        break;
                    default:
                        this.flashMessage.error({
                            message: "Some error occurred, Please try again!",
                            time: 5000
                        });
                        break;
                }
            }
            this.loadEmployees();
        },
        filterSearch: async function() {
            try {
                // let formData = new FormData();
                let filter_sex = this.employees_data.sex;
                let filter_dateVisited = this.employees_data.dateVisited;
                let filter_clientType = this.employees_data.clientType;

                const response = await healthAndTraining_service.get_filtered_search(filter_sex,filter_dateVisited,filter_clientType);
                console.log(response);
                this.employees = response.data;
                this.totalRows = this.employees.data.length;

                this.flashMessage.success({
                    status: '',
                    message: 'Employee updated successfully!',
                    time: 5000
                });

            } catch (error) {
                switch (error.response.status) {
                    case 422:
                        this.errors = error.response.data.errors;
                        break;
                    default:
                        this.flashMessage.error({
                            message: "Some error occurred, Please try again!",
                            time: 5000
                        });
                        break;
                }
            }
        },
        clearFilters() {
            this.employees_data.sex = '';
            this.employees_data.dateVisited = '';
            this.employees_data.clientType = '';
            this.loadEmployees();
        },
        hideEmployeeModal() {
            this.$refs["htData"].hide();
        },
        showEmployeeModal() {
            this.$refs["htData"].show();
        },
        hideEvalQuizModal() {
            this.$refs["evalQuizData"].hide();
        },
        showEvalQuizModal() {
            this.$refs["evalQuizData"].show();
        }
    }
};
</script>