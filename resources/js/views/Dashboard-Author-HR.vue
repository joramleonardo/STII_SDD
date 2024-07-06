<template>
  <div class="container-fluid">
    <div class="breakcrumbs mt-3">
        Home > Reports > <span style="color:#886ab5; font-weight: 900"> Human Resources</span>
    </div>
    <div class="row" style="padding-top:15px">
        <div class="col-xl-12">
            <div class="card-body">
            <div class="card mb-1">
                <div class="card-body p-4" inline>
                    <b-row>
                        <b-col align-self="start">
                            <b-form v-on:submit.prevent="filterSearch" inline>
                                    <label class="mr-sm-2 font-weight-700" >MONTH:</label>
                                    <b-form-select
                                            v-model="employees_data.month"
                                            id="month"
                                            label-cols-sm="4" 
                                            label-cols-lg="3"
                                            content-cols-sm
                                            content-cols-lg="7" 
                                            class="mr-sm-4"
                                            :options="drop_month">
                                    </b-form-select>
                                    <label class="mr-sm-2 font-weight-700" >YEAR:</label>
                                    <b-form-select
                                            v-model="employees_data.year"
                                            id="year"
                                            label-cols-sm="4" 
                                            label-cols-lg="3"
                                            content-cols-sm
                                            content-cols-lg="7" 
                                            class="mr-sm-4"
                                            :options="drop_year">
                                    </b-form-select>
                                    <b-button type="submit" class="theme-button">Search</b-button> 
                            </b-form>
                        </b-col>
                        <b-col align-self="center"></b-col>
                        <b-col align-self="end">
                            <b-row cols="3">
                                <b-col>
                                    <strong v-if="employees_data.month=='01'">
                                        Month: <span class="month-year-style">January</span>
                                    </strong>
                                    <strong v-if="employees_data.month=='02'">
                                        Month: <span class="month-year-style">February</span>
                                    </strong>
                                    <strong v-if="employees_data.month=='03'">
                                        Month: <span class="month-year-style">March</span>
                                    </strong>
                                    <strong v-if="employees_data.month=='04'">
                                        Month: <span class="month-year-style">April</span>
                                    </strong>
                                    <strong v-if="employees_data.month=='05'">
                                        Month: <span class="month-year-style">May</span>
                                    </strong>
                                    <strong v-if="employees_data.month=='06'">
                                        Month: <span class="month-year-style">June</span>
                                    </strong>
                                    <strong v-if="employees_data.month=='07'">
                                        Month: <span class="month-year-style">July</span>
                                    </strong>
                                    <strong v-if="employees_data.month=='08'">
                                        Month: <span class="month-year-style">August</span>
                                    </strong>
                                    <strong v-if="employees_data.month=='09'">
                                        Month: <span class="month-year-style">September</span>
                                    </strong>
                                    <strong v-if="employees_data.month=='10'">
                                        Month: <span class="month-year-style">October</span>
                                    </strong>
                                    <strong v-if="employees_data.month=='11'">
                                        Month: <span class="month-year-style">November</span>
                                    </strong>
                                    <strong v-if="employees_data.month=='11'">
                                        Month: <span class="month-year-style">December</span>
                                    </strong>
                                </b-col>
                                <b-col> 
                                    <strong v-if="employees_data.year=='2019'">
                                        Year: <span class="month-year-style">2019</span>
                                    </strong>
                                    <strong v-if="employees_data.year=='2020'">
                                        Year: <span class="month-year-style">2020</span>
                                    </strong>
                                    <strong v-if="employees_data.year=='2021'">
                                        Year: <span class="month-year-style">2021</span>
                                    </strong>
                                    <strong v-if="employees_data.year=='2022'">
                                        Year: <span class="month-year-style">2022</span>
                                    </strong>
                                </b-col>
                            </b-row>
                        </b-col>
                    </b-row>
                    <div class="mt-3" inline>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!--
    <div class="row mt-4">
        <div class="col-xl-12">
            <div class="card mb-1">
                <div class="card-body p-4" inline>
                    <b-row>
                        <b-col align-self="start">
                            <b-form v-on:submit.prevent="filterSearch" inline>
                                    <label class="mr-sm-2 font-weight-700" >Month:</label>
                                    <b-form-select
                                            v-model="employees_data.month"
                                            id="month"
                                            label-cols-sm="4" 
                                            label-cols-lg="3"
                                            content-cols-sm
                                            content-cols-lg="7" 
                                            class="mr-sm-4"
                                            :options="drop_month">
                                    </b-form-select>
                                    <label class="mr-sm-2 font-weight-700" >Year:</label>
                                    <b-form-select
                                            v-model="employees_data.year"
                                            id="year"
                                            label-cols-sm="4" 
                                            label-cols-lg="3"
                                            content-cols-sm
                                            content-cols-lg="7" 
                                            class="mr-sm-4"
                                            :options="drop_year">
                                    </b-form-select>
                                    <b-button type="submit" class="btn" variant="primary">Search</b-button> 
                            </b-form>
                        </b-col>
                        <b-col align-self="center"></b-col>
                        <b-col align-self="end">
                            <b-row cols="3">
                                <b-col>
                                    <strong v-if="employees_data.month=='01'">
                                        Month: <span class="month-year-style">January</span>
                                    </strong>
                                    <strong v-if="employees_data.month=='02'">
                                        Month: <span class="month-year-style">February</span>
                                    </strong>
                                    <strong v-if="employees_data.month=='03'">
                                        Month: <span class="month-year-style">March</span>
                                    </strong>
                                    <strong v-if="employees_data.month=='04'">
                                        Month: <span class="month-year-style">April</span>
                                    </strong>
                                    <strong v-if="employees_data.month=='05'">
                                        Month: <span class="month-year-style">May</span>
                                    </strong>
                                    <strong v-if="employees_data.month=='06'">
                                        Month: <span class="month-year-style">June</span>
                                    </strong>
                                    <strong v-if="employees_data.month=='07'">
                                        Month: <span class="month-year-style">July</span>
                                    </strong>
                                    <strong v-if="employees_data.month=='08'">
                                        Month: <span class="month-year-style">August</span>
                                    </strong>
                                    <strong v-if="employees_data.month=='09'">
                                        Month: <span class="month-year-style">September</span>
                                    </strong>
                                    <strong v-if="employees_data.month=='10'">
                                        Month: <span class="month-year-style">October</span>
                                    </strong>
                                    <strong v-if="employees_data.month=='11'">
                                        Month: <span class="month-year-style">November</span>
                                    </strong>
                                    <strong v-if="employees_data.month=='12'">
                                        Month: <span class="month-year-style">December</span>
                                    </strong>
                                </b-col>
                                <b-col> 
                                    <strong v-if="employees_data.year=='2017'">
                                        Year: <span class="month-year-style">2017</span>
                                    </strong>
                                    <strong v-if="employees_data.year=='2018'">
                                        Year: <span class="month-year-style">2018</span>
                                    </strong>
                                    <strong v-if="employees_data.year=='2019'">
                                        Year: <span class="month-year-style">2019</span>
                                    </strong>
                                    <strong v-if="employees_data.year=='2020'">
                                        Year: <span class="month-year-style">2020</span>
                                    </strong>
                                    <strong v-if="employees_data.year=='2021'">
                                        Year: <span class="month-year-style">2021</span>
                                    </strong>
                                    <strong v-if="employees_data.year=='2022'">
                                        Year: <span class="month-year-style">2022</span>
                                    </strong>
                                </b-col>
                            </b-row>
                        </b-col>
                    </b-row>
                    <div class="mt-3" inline>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body p-4 small-card-background">
                            <div class="data-card">
                                <h3>{{this.totalTrainings}}</h3>
                                <h4>Trainings</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body p-4 small-card-background">
                            <div class="data-card">
                                <h3>{{this.totalParticipants}}</h3>
                                <h4>Participants</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body p-4 small-card-background">
                            <div class="data-card">
                                <h3>-</h3>
                                <h4>Female</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body p-4 small-card-background">
                            <div class="data-card">
                                <h3>-</h3>
                                <h4>Male</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->
    <div class="row ">
        <div class="col-xl-12">
            <div class="">
                <div class="card-body">
                    <b-card header="List of Training and Activities" align="center" style="padding:1.25rem;">
                            <div>
                                <div class="card-tools">
                                    <b-row >
                                        <b-col lg="10" class="">
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
                            </div>
                            <div class="my-1">
                                <b-pagination
                                    v-model="currentPage"
                                    :total-rows="totalRows"
                                    :per-page="perPage"
                                    align="center"
                                    class="my-0">
                                </b-pagination>
                            </div>
                    </b-card>
                </div>
            </div>
        </div>
    </div>

  </div>
</template>

<script>
    import * as dashboard from '../services/dashboard_service';

    // import LineChart from '../components/charts/LineChart.js';
    // import BarChart from '../components/charts/BarChart.js';
    // import PieChart from '../components/charts/PieChart.js';
    // import DoughnutChart from '../components/charts/DoughnutChart.js';

    var chart1;
// var chart2;
// var chart3;
// var chart4;

    export default {
        name: "AQIChartComponent",
        components: {
        },

    data() {
        return {
            filter_month: 0,
            filter_year: 0,
            employees: [],

            countParticipants: [],
            totalParticipants:0,
            
            countTrainings: [],
            totalTrainings:0,

            employees_data: [],
            drop_month: [   { text: 'January', value: '01' },
                            { text: 'February', value: '02' },
                            { text: 'March', value: '03' },
                            { text: 'April', value: '04' },
                            { text: 'May', value: '05' },
                            { text: 'June', value: '06' },
                            { text: 'July', value: '07' },
                            { text: 'August', value: '08' },
                            { text: 'September', value: '09' },
                            { text: 'October', value: '10' },
                            { text: 'November', value: '11' },
                            { text: 'December', value: '12' }],
            drop_year: [{ text: '2017', value: '2017' },
                        { text: '2018', value: '2018' }, 
                        { text: '2019', value: '2019' }, 
                        { text: '2020', value: '2020' }, 
                        { text: '2021', value: '2021' },
                        { text: '2022', value: '2022' }],
            dataArray: [],
            data_month: [],
            data_year: [],
            totalRows: 1,
            currentPage: 1,
            perPage: 10,
            filterOn: [],
            filter: null,
            sortDirection: "asc",
            sortBy: "id",
            sortDesc: false,
            fields: [
                { key: "trainingTitle", label: "Training Title", thClass: 'text-left', tdClass: 'text-left', },
                { key: 'startDate', label: 'Date'},
                { key: 'female', label: 'Female'},
                { key: 'male', label: 'Male'},
                { key: 'totalParticipants', label: 'Total Participants'}
            ],
        
        };
    },
    mounted() {
        this.loadCharts();
    },
    methods: {
            loadCharts: async function() {
                        let filter_month = '04';
                        let filter_year = '2022';

                        const response_set_month = await dashboard.setMonth(filter_month);
                        const response_set_year = await dashboard.setYear(filter_year);

                        this.data_month = response_set_month.data;
                        this.data_year = response_set_year.data;
                try{
                    const response = await dashboard.getHR_trainingsList();
                    this.employees = response.data;
                    

                    const response_countParticipants = await dashboard.getHR_countParticipants();
                    this.countParticipants = response_countParticipants.data;
                    this.totalParticipants = this.countParticipants[0]['totalParticipants'];

                    const response_countTrainings = await dashboard.getHR_countTrainings();
                    this.countTrainings = response_countTrainings.data;
                    this.totalTrainings = this.countTrainings[0]['totalTrainings'];
                    
                } catch(error) {
                    // this.flashMessage.error({
                    // message: 'Some error occured! Please refresh.',
                    // time: 5000
                    // });
                }
            },
            filterSearch: async function(){
                    let filter_month = this.employees_data.month;
                    let filter_year = this.employees_data.year;
                
                    const response_set_month = await dashboard.setMonth(filter_month);
                    const response_set_year = await dashboard.setYear(filter_year);

                    this.data_month = response_set_month.data;
                    this.data_year = response_set_year.data;

                    try{
                        const response = await dashboard.getHR_trainingsList();
                        this.employees = response.data;
                        

                        const response_countParticipants = await dashboard.getHR_countParticipants();
                        this.countParticipants = response_countParticipants.data;
                        this.totalParticipants = this.countParticipants[0]['totalParticipants'];

                        const response_countTrainings = await dashboard.getHR_countTrainings();
                        this.countTrainings = response_countTrainings.data;
                        this.totalTrainings = this.countTrainings[0]['totalTrainings'];
                    } catch(error) {
                        console.log(error);
                    }
            },
            returnPaginate(){
                this.currentPage = 1;
            },
           

    }
    };
</script>

<style >
    .Chart {
        padding: 20px;
        box-shadow: 0px 0px 20px 2px rgba(0, 0, 0, .4);
        border-radius: 20px;
        margin: 50px 0;
    }
    .container {
        max-width: 800px;
        margin: 0 auto;
    }
</style>