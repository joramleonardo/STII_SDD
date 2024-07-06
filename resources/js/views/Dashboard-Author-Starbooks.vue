<template>
  <div class="container-fluid">
    <div class="breakcrumbs mt-3">
        Home > Reports > <span style="color:#886ab5; font-weight: 900"> STARBOOKS</span>
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
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card-body">
                        <div class="card-body p-4 small-card">
                            <div class="data-card">
                                <h3>{{this.totalParticipants}}</h3>
                                <h4>Total</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card-body">
                        <div class="card-body p-4 small-card">
                            <div class="data-card">
                                <h3>{{this.totalFemaleParticipants}}</h3>
                                <h4>Female</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card-body">
                        <div class="card-body p-4 small-card">
                            <div class="data-card">
                                <h3>{{this.totalMaleParticipants}}</h3>
                                <h4>Male</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card-body">
                        <div class="card-body p-4 small-card">
                            <div class="data-card">
                                <h3>{{this.totalNotToSayParticipants}}</h3>
                                <h4>Prefer not to say</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->
    
    <div class="row">
        <div class="col-xl-7">
            <!--<div class="card">-->
            <div class="">
                <div class="card-body">
                    <b-card header="Category" align="center" style="padding:1.25rem;">
                        <canvas id="chart1" width="400" height="400"></canvas>
                    </b-card>
                </div>
            </div>
        </div>
        <div class="col-xl-5">
            <!--<div class="card">-->
            <div class="">
                <div class="card-body">
                    <b-card header="School Type" align="center" style="padding:1.25rem;">
                        <canvas id="chart2" width="400" height="400"></canvas>
                    </b-card>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-xl-6">
            <div class="">
                <div class="card-body">
                    <b-card header="Logs" align="center" style="padding:1.25rem;">
                        <div>
                            <!--
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
                            -->
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
                        </div>
                        <!--
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
                        -->
                    </b-card>
                </div>
            </div>
        </div>
    </div>

    <!--
    <div class="row mt-4">
        <div class="col-xl-7">
            <div class="card">
                <div class="card-body p-4">
                    <b-card header="Region" align="center">
                        <canvas id="chart4" width="400" height="400"></canvas>
                    </b-card>
                </div>
            </div>
        </div>
        <div class="col-xl-5">
            <div class="card">
                <div class="card-body p-4">
                    <b-card header="Client Type" align="center">
                        <canvas id="chart2" width="400" height="400"></canvas>
                    </b-card>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body p-4">
                    <b-card border-variant="light" header="Research Interests" align="center">
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
                    </b-card>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body p-4">
                    <b-card border-variant="light" header="Topic/Title not found in the Library" align="center">
                        <div>
                            <div class="card-tools">
                                <b-row >
                                    <b-col lg="10" class="mt-3">
                                        <b-form-group label="Search" label-for="filter-input2" label-cols-sm="2" label-align-sm="center">
                                            <b-input-group>
                                                <b-form-input id="filter-input2" v-model="filter2" type="search" placeholder="Type to Search" v-on:keydown="returnPaginate2($event)"></b-form-input>
                                            </b-input-group>
                                        </b-form-group>
                                    </b-col>
                                </b-row>
                            </div>
                            <b-table
                                striped
                                hover
                                :items="topics"
                                :fields="fields_topics"
                                :sort-by.sync="sortBy2"
                                :sort-desc.sync="sortDesc2"
                                sort-icon-left
                                responsive="sm"
                                :filter="filter2"
                                :current-page="currentPage2"
                                :per-page="perPage2"
                                :filter-included-fields="filterOn2">
                            </b-table>
                            Total Rows: <b>{{totalRows2}}</b>
                        </div>
                        <div class="my-1">
                            <b-pagination
                                v-model="currentPage2"
                                :total-rows="totalRows2"
                                :per-page="perPage2"
                                align="center"
                                class="my-0"
                            >
                            </b-pagination>
                        </div>
                    </b-card>
                </div>
            </div>
        </div>
    </div>
    -->
  </div>
</template>

<script>
    import * as dashboard from '../services/dashboard_service';
    import Chart from '../../../node_modules/chart.js/dist/Chart.js';

    // var ctx1 = document.getElementById('chart1');
 
    var chart1;
    var chart2;

    export default {
        name: "AQIChartComponent",
        components: {
        },
        
        data() {
            return {
                filter_month: 0,
                filter_year: 0,
                employees: [],
                topics: [],
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
                drop_year: [{ text: '2019', value: '2019' },
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
                    { key: "totalParticipants", label: "Total", thClass: 'text-left', tdClass: 'text-left', },
                    { key: 'femaleParticipants', label: 'Female', thClass: 'text-left', tdClass: 'text-left',},
                    { key: 'maleParticipants', label: 'Male', thClass: 'text-left', tdClass: 'text-left',},
                    { key: 'preferNotToSayParticipants', label: 'Prefer not to say', thClass: 'text-left', tdClass: 'text-left',},
                    { key: 'undefined', label: 'Undefined', thClass: 'text-left', tdClass: 'text-left',}
                ],
                totalClients: 1,
                totalMaterialsServed: 1,
                totalMaterialsReferred: 1,

                totalParticipants:0,
                totalFemaleParticipants:0,
                totalMaleParticipants:0,
                totalUndefinedParticipants:0,
                totalNotToSayParticipants:0,

                totalRows2: 1,
                currentPage2: 1,
                perPage2: 10,
                filterOn2: [],
                filter2: null,
                sortDirection2: "asc",
                sortBy2: "id",
                sortDesc2: false,
                fields_topics: [
                    { key: "sex", label: "Sex", thClass: 'text-left', tdClass: 'text-left', },
                    { key: 'topic', label: 'Topic/Title not found in the Library', thClass: 'text-left', tdClass: 'text-left',}
                ],
            };
        },
        mounted() {
            this.loadCharts();
        },
        methods: {
                loadCharts: async function() {
                        let filter_month = '12';
                        let filter_year = '2021';

                        const response_set_month = await dashboard.setMonth(filter_month);
                        const response_set_year = await dashboard.setYear(filter_year);

                        this.data_month = response_set_month.data;
                        this.data_year = response_set_year.data;
                    try{
                        const response = await dashboard.getSTARBOOKS_logbookList();
                        this.employees = response.data;

                        this.totalParticipants = this.employees[0]['totalParticipants'];
                        this.totalFemaleParticipants = this.employees[0]['femaleParticipants'];
                        this.totalMaleParticipants = this.employees[0]['maleParticipants'];
                        this.totalNotToSayParticipants = this.employees[0]['preferNotToSayParticipants'];
                        this.totalUndefinedParticipants = this.employees[0]['undefined'];
                        // this.totalRows = this.employees.length;
                        console.log(this.employees);


                        const response_female = await dashboard.getSTARBOOKS_category_female();
                        this.dataArray_female = response_female.data;
                        let arrayData_female = [
                            parseInt(this.dataArray_female[0]['category1']),
                            parseInt(this.dataArray_female[0]['category2']),
                            parseInt(this.dataArray_female[0]['category3']),
                            parseInt(this.dataArray_female[0]['category4']),
                            parseInt(this.dataArray_female[0]['category5']),
                            parseInt(this.dataArray_female[0]['category6']),
                        ]

                        const response_male = await dashboard.getSTARBOOKS_category_male();
                        this.dataArray_male = response_male.data;
                        let arrayData_male = [
                            parseInt(this.dataArray_male[0]['category1']),
                            parseInt(this.dataArray_male[0]['category2']),
                            parseInt(this.dataArray_male[0]['category3']),
                            parseInt(this.dataArray_male[0]['category4']),
                            parseInt(this.dataArray_male[0]['category5']),
                            parseInt(this.dataArray_male[0]['category6']),
                        ]
                        
                        const response_clientType_female = await dashboard.getSTARBOOKS_schoolType_female();
                        this.dataArray_clientType_female = response_clientType_female.data;
                        let arrayData_clientType_female = [
                            parseInt(this.dataArray_clientType_female[0]['schoolType1']),
                            parseInt(this.dataArray_clientType_female[0]['schoolType2']),
                        ]

                        const response_clientType_male = await dashboard.getSTARBOOKS_schoolType_male();
                        this.dataArray_clientType_male = response_clientType_male.data;
                        let arrayData_clientType_male = [
                            parseInt(this.dataArray_clientType_male[0]['schoolType1']),
                            parseInt(this.dataArray_clientType_male[0]['schoolType2']),
                        ]

                        var ctx1 = document.getElementById('chart1').getContext('2d');
                        chart1 = new Chart(ctx1, {
                            type: 'bar',
                            data: {
                                labels: [   'Student',  
                                            'Government Employee', 
                                            'Private Employee',  
                                            'Self-Employed', 
                                            'Not Employed',  
                                            'Others', 
                                            ],
                                datasets: [{
                                                data: arrayData_female,
                                                label: 'Female',
                                                backgroundColor: '#fe9cca',
                                                borderColor: '#fe9cca',
                                                borderWidth: 1
                                            },
                                            {
                                                data: arrayData_male,
                                                label: 'Male',
                                                backgroundColor: '#a8d6fb',
                                                borderColor: '#a8d6fb',
                                                borderWidth: 1
                                            }]
                            },
                            options: {
                                        tooltips: {
                                        displayColors: true,
                                        callbacks:{
                                            mode: 'x',
                                        },
                                        },
                                        scales: {
                                        xAxes: [{
                                            stacked: false, //set true for stackable
                                            gridLines: {
                                            display: false,
                                            }
                                        }],
                                        yAxes: [{
                                            stacked: false, //set true for stackable
                                            ticks: {
                                            beginAtZero: true,
                                            },
                                            type: 'linear',
                                        }]
                                        },
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        legend: { position: 'bottom' },
                                    }
                        });
                        
                        var ctx2 = document.getElementById('chart2').getContext('2d');
                        chart2 = new Chart(ctx2, {
                            type: 'bar',
                            data: {
                                labels: [   'Public',  
                                            'Private',  
                                            ],
                                datasets: [{
                                                data: arrayData_clientType_female,
                                                label: 'Female',
                                                backgroundColor: '#fe9cca',
                                                borderColor: '#fe9cca',
                                                borderWidth: 1
                                            },
                                            {
                                                data: arrayData_clientType_male,
                                                label: 'Male',
                                                backgroundColor: '#a8d6fb',
                                                borderColor: '#a8d6fb',
                                                borderWidth: 1
                                            }]
                            },
                            options: {
                                        tooltips: {
                                        displayColors: true,
                                        callbacks:{
                                            mode: 'x',
                                        },
                                        },
                                        scales: {
                                        xAxes: [{
                                            stacked: false, //set true for stackable
                                            gridLines: {
                                            display: false,
                                            }
                                        }],
                                        yAxes: [{
                                            stacked: false, //set true for stackable
                                            ticks: {
                                            beginAtZero: true,
                                            },
                                            type: 'linear',
                                        }]
                                        },
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        legend: { position: 'bottom' },
                                    }
                        });
                        


                    } catch(error) {
                        console.log(error);
                        // this.flashMessage.error({
                        // message: 'Some error occured! Please refresh.',
                        // time: 5000
                        // });
                    }
                    
                },
                filterSearch: async function(){

                        chart1.destroy();
                        chart2.destroy();

                        let filter_month = this.employees_data.month;
                        let filter_year = this.employees_data.year;
                    
                        const response_set_month = await dashboard.setMonth(filter_month);
                        const response_set_year = await dashboard.setYear(filter_year);

                        this.data_month = response_set_month.data;
                        this.data_year = response_set_year.data;

                    try{
                        const response = await dashboard.getSTARBOOKS_logbookList();
                        this.employees = response.data;

                        this.totalParticipants = this.employees[0]['totalParticipants'];
                        this.totalFemaleParticipants = this.employees[0]['femaleParticipants'];
                        this.totalMaleParticipants = this.employees[0]['maleParticipants'];
                        this.totalNotToSayParticipants = this.employees[0]['preferNotToSayParticipants'];
                        this.totalUndefinedParticipants = this.employees[0]['undefined'];
                        // this.totalRows = this.employees.length;
                        console.log(this.employees);


                        const response_female = await dashboard.getSTARBOOKS_category_female();
                        this.dataArray_female = response_female.data;
                        let arrayData_female = [
                            parseInt(this.dataArray_female[0]['category1']),
                            parseInt(this.dataArray_female[0]['category2']),
                            parseInt(this.dataArray_female[0]['category3']),
                            parseInt(this.dataArray_female[0]['category4']),
                            parseInt(this.dataArray_female[0]['category5']),
                            parseInt(this.dataArray_female[0]['category6']),
                        ]

                        const response_male = await dashboard.getSTARBOOKS_category_male();
                        this.dataArray_male = response_male.data;
                        let arrayData_male = [
                            parseInt(this.dataArray_male[0]['category1']),
                            parseInt(this.dataArray_male[0]['category2']),
                            parseInt(this.dataArray_male[0]['category3']),
                            parseInt(this.dataArray_male[0]['category4']),
                            parseInt(this.dataArray_male[0]['category5']),
                            parseInt(this.dataArray_male[0]['category6']),
                        ]
                        
                        const response_clientType_female = await dashboard.getSTARBOOKS_schoolType_female();
                        this.dataArray_clientType_female = response_clientType_female.data;
                        let arrayData_clientType_female = [
                            parseInt(this.dataArray_clientType_female[0]['schoolType1']),
                            parseInt(this.dataArray_clientType_female[0]['schoolType2']),
                        ]

                        const response_clientType_male = await dashboard.getSTARBOOKS_schoolType_male();
                        this.dataArray_clientType_male = response_clientType_male.data;
                        let arrayData_clientType_male = [
                            parseInt(this.dataArray_clientType_male[0]['schoolType1']),
                            parseInt(this.dataArray_clientType_male[0]['schoolType2']),
                        ]

                        var ctx1 = document.getElementById('chart1').getContext('2d');
                        chart1 = new Chart(ctx1, {
                            type: 'bar',
                            data: {
                                labels: [   'Student',  
                                            'Government Employee', 
                                            'Private Employee',  
                                            'Self-Employed', 
                                            'Not Employed',  
                                            'Others', 
                                            ],
                                datasets: [{
                                                data: arrayData_female,
                                                label: 'Female',
                                                backgroundColor: '#fe9cca',
                                                borderColor: '#fe9cca',
                                                borderWidth: 1
                                            },
                                            {
                                                data: arrayData_male,
                                                label: 'Male',
                                                backgroundColor: '#a8d6fb',
                                                borderColor: '#a8d6fb',
                                                borderWidth: 1
                                            }]
                            },
                            options: {
                                        tooltips: {
                                        displayColors: true,
                                        callbacks:{
                                            mode: 'x',
                                        },
                                        },
                                        scales: {
                                        xAxes: [{
                                            stacked: false, //set true for stackable
                                            gridLines: {
                                            display: false,
                                            }
                                        }],
                                        yAxes: [{
                                            stacked: false, //set true for stackable
                                            ticks: {
                                            beginAtZero: true,
                                            },
                                            type: 'linear',
                                        }]
                                        },
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        legend: { position: 'bottom' },
                                    }
                        });
                        
                        var ctx2 = document.getElementById('chart2').getContext('2d');
                        chart2 = new Chart(ctx2, {
                            type: 'bar',
                            data: {
                                labels: [   'Public',  
                                            'Private',  
                                            ],
                                datasets: [{
                                                data: arrayData_clientType_female,
                                                label: 'Female',
                                                backgroundColor: '#fe9cca',
                                                borderColor: '#fe9cca',
                                                borderWidth: 1
                                            },
                                            {
                                                data: arrayData_clientType_male,
                                                label: 'Male',
                                                backgroundColor: '#a8d6fb',
                                                borderColor: '#a8d6fb',
                                                borderWidth: 1
                                            }]
                            },
                            options: {
                                        tooltips: {
                                        displayColors: true,
                                        callbacks:{
                                            mode: 'x',
                                        },
                                        },
                                        scales: {
                                        xAxes: [{
                                            stacked: false, //set true for stackable
                                            gridLines: {
                                            display: false,
                                            }
                                        }],
                                        yAxes: [{
                                            stacked: false, //set true for stackable
                                            ticks: {
                                            beginAtZero: true,
                                            },
                                            type: 'linear',
                                        }]
                                        },
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        legend: { position: 'bottom' },
                                    }
                        });
                        


                    } catch(error) {
                        console.log(error);
                        // this.flashMessage.error({
                        // message: 'Some error occured! Please refresh.',
                        // time: 5000
                        // });
                    }
                },
                returnPaginate(){
                    this.currentPage = 1;
                },
                returnPaginate2(){
                    this.currentPage2 = 1;
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