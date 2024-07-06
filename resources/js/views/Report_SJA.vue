<template>
  <div class="container-fluid">
    <h1 class="mt-4 stii-font-color-red">Philippine Journal of Science Reports</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Home > Reports > Philippine Journal of Science</li>
    </ol>
    
    <div class="row">
      <div class="col-xl-12">
        <div class="card mb-4">
          <div class="card-header" style="background-color: #ed262a; color: white">
            <i class="fas fa-list-alt mr-1"></i>
            LIST OF RESEARCHERS
            <b-modal id="htData" ref="htData" title="Researcher's Data" hide-footer>
                <b-tabs card>  
                    <b-tab title="Manuscripts">
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
                </b-tabs>
            </b-modal>
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
                            <b-button @click="loadEmployeeHealthAndTraining(row.item)" size="sm" class="mr-1" style="background-color: #3090C7">View Manuscripts</b-button>
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

import * as healthAndTraining_service from '../services/pjs_service';

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
                { key: 'id', sortable: true, label: 'Researcher ID'  },
                { key: 'name', sortable: true, label: 'Name'},
                { key: 'sex', sortable: true, label: 'Sex'},
                { key: 'location', label: 'location' },
                { key: 'countryName', sortable: true, label: 'Country Name'},
                { key: 'affiliation', label: 'affiliation' },
                { key: 'affiliationType', label: 'Affiliation Type' },
                { key: 'otherAffiliationType', label: 'Other Affiliation Type' },
                { key: 'actions', label: 'Action' }
            ],
            trainingFields: [
                // { key: 'researcher_id', sortable: true, label: 'Researcher ID'},
                { key: 'title', sortable: true, label: 'Title'},
                { key: 'area', sortable: true, label: 'Area'},
                { key: 'location', label: 'location' },
                { key: 'discipline', sortable: true, label: 'Discipline'},
                { key: 'otherDiscipline', label: 'Other Discipline' },
                { key: 'dateReceived', label: 'Date Received' },
                { key: 'status', label: 'Status' },
                { key: 'issueNo', label: 'Issue No' }
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
            
            try{
                const training_response = await healthAndTraining_service.loadEmployeeManuscript(employees_tData.id);

                console.log(training_response);

                this.employees_trainingData = training_response.data;

            } catch(error) {
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