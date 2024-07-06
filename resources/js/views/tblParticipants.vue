<template>
  <div class="container-fluid">
    <h1 class="mt-4 stii-font-color-red">Science Journo Ako</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Home > Science Journo Ako > Participant </li>
    </ol>
    <div class="row">
      <div class="col-xl-12">
        <div class="card mb-4">
          <div class="card-header card-header-title" style="background-color: #ed262a; color: white">
            <i class="fas fa-list-alt mr-1"></i>
            LIST OF PARTICIPANTS
            <b-button v-b-modal.add-teacher class="float-right add-specific-button" style="background-color:white; color:black">
                <i class="fas fa-plus-square"> Teacher</i>
            </b-button>
            <b-button v-b-modal.add-student class="float-right add-specific-button" style="background-color:white; color:black">
                <i class="fas fa-plus-square"> Student</i>
            </b-button>
            <b-button v-b-modal.add-professional class="float-right add-specific-button" style="background-color:white; color:black">
                <i class="fas fa-plus-square"> Professional</i>
            </b-button>
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
    <b-modal id="add-student" ref="add-student" title="Add Student Participant" hide-footer>
        <b-form v-on:submit.prevent="createEmployee">
        <b-card no-body>
            <b-card bg-variant="light">
                    <b-form-group label="Event ID:" label-for="event_id" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.event_id" id="event_id" type="text" placeholder="Enter Event ID here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Name:" label-for="name" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.name" id="name" type="text" placeholder="Enter name here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Email:" label-for="email" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.email" id="email" type="text" placeholder="Enter email here..."></b-form-input>
                    </b-form-group>
                    <b-form-group label="Sex:" label-cols-sm="2" label-align-sm="right" class="mb-0 font-weight-700"  v-slot="{ }" >
                        <b-form-radio-group v-model="employeeData.sex" id="sex" class="pt-2 font-weight-600" :options="radio_sex" required></b-form-radio-group>
                    </b-form-group>
                    <b-form-group label="Age:" label-for="age" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.age" id="v" type="text" placeholder="Enter age here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Participant Type:" label-for="participantType" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData.participantType" id="participantType" :options="drop_participantType" required></b-form-select>
                    </b-form-group>
                    <b-form-group label="School:" label-for="school" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.school" id="school" type="text" placeholder="Enter School here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Grade Level:" label-for="gradeLevel" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData.gradeLevel" id="gradeLevel" :options="drop_gradeLevel" ></b-form-select>
                    </b-form-group>
                    <b-form-group label="Province:" label-for="province" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.province" id="province" type="text" placeholder="Enter province here..." ></b-form-input>
                    </b-form-group>
                    <b-form-group label="Region:" label-for="region" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData.region" id="region" :options="drop_region" ></b-form-select>
                    </b-form-group>

            </b-card> 
        </b-card>
        <div class="float-right">
            <b-button type="button" class="btn btn-default" variant="outline-danger" v-on:click="hideEmployeeModal">Cancel</b-button>
            <b-button type="submit" class="btn" variant="outline-success" >Save</b-button> 
        </div>
        </b-form>
    </b-modal>
    <b-modal id="add-professional" ref="add-professional" title="Add Professional Participant" hide-footer>
        <b-form v-on:submit.prevent="createEmployee">
        <b-card no-body>
            <b-card bg-variant="light">
                    <b-form-group label="Event ID:" label-for="event_id" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.event_id" id="event_id" type="text" placeholder="Enter Event ID here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Name:" label-for="name" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.name" id="name" type="text" placeholder="Enter name here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Email:" label-for="email" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.email" id="email" type="text" placeholder="Enter email here..."></b-form-input>
                    </b-form-group>
                    <b-form-group label="Sex:" label-cols-sm="2" label-align-sm="right" class="mb-0 font-weight-700"  v-slot="{ }" >
                        <b-form-radio-group v-model="employeeData.sex" id="sex" class="pt-2 font-weight-600" :options="radio_sex" required></b-form-radio-group>
                    </b-form-group>
                    <b-form-group label="Age:" label-for="age" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.age" id="v" type="text" placeholder="Enter age here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Participant Type:" label-for="participantType" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData.participantType" id="participantType" :options="drop_participantType" required></b-form-select>
                    </b-form-group>
                    <b-form-group label="Affiliation:" label-for="affiliation" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.affiliation" id="affiliation" type="text" placeholder="Enter affiliation here..." ></b-form-input>
                    </b-form-group>
                    <b-form-group label="Designation:" label-for="designation" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.designation" id="designation" type="text" placeholder="Enter designation here..." ></b-form-input>
                    </b-form-group>

            </b-card> 
        </b-card>
        <div class="float-right">
            <b-button type="button" class="btn btn-default" variant="outline-danger" v-on:click="hideEmployeeModal">Cancel</b-button>
            <b-button type="submit" class="btn" variant="outline-success" >Save</b-button> 
        </div>
        </b-form>
    </b-modal>
    <b-modal id="add-teacher" ref="add-teacher" title="Add Teacher Participant" hide-footer>
        <b-form v-on:submit.prevent="createEmployee">
        <b-card no-body>
            <b-card bg-variant="light">
                    <b-form-group label="Event ID:" label-for="event_id" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.event_id" id="event_id" type="text" placeholder="Enter Event ID here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Name:" label-for="name" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.name" id="name" type="text" placeholder="Enter name here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Email:" label-for="email" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.email" id="email" type="text" placeholder="Enter email here..."></b-form-input>
                    </b-form-group>
                    <b-form-group label="Sex:" label-cols-sm="2" label-align-sm="right" class="mb-0 font-weight-700"  v-slot="{ }" >
                        <b-form-radio-group v-model="employeeData.sex" id="sex" class="pt-2 font-weight-600" :options="radio_sex" required></b-form-radio-group>
                    </b-form-group>
                    <b-form-group label="Age:" label-for="age" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.age" id="v" type="text" placeholder="Enter age here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Participant Type:" label-for="participantType" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData.participantType" id="participantType" :options="drop_participantType" required></b-form-select>
                    </b-form-group>
                    <b-form-group label="Location:" label-for="location" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.location" id="location" type="text" placeholder="Enter Location here..." ></b-form-input>
                    </b-form-group>
                    <b-form-group label="School:" label-for="school" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData.school" id="school" type="text" placeholder="Enter School here..." ></b-form-input>
                    </b-form-group>
            </b-card> 
        </b-card>
        <div class="float-right">
            <b-button type="button" class="btn btn-default" variant="outline-danger" v-on:click="hideEmployeeModal">Cancel</b-button>
            <b-button type="submit" class="btn" variant="outline-success" >Save</b-button> 
        </div>
        </b-form>
    </b-modal>
    <b-modal id="updateStudentModal" ref="updateStudentModal" title="Update Student Details" hide-footer>
        <b-form v-on:submit.prevent="updateEmployee">
        <b-card no-body>
            <b-card bg-variant="light">
                    <b-form-group label="Event ID:" label-for="event_id" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.event_id" id="event_id" type="text" placeholder="Enter Event ID here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Name:" label-for="name" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.name" id="name" type="text" placeholder="Enter name here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Email:" label-for="email" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.email" id="email" type="text" placeholder="Enter email here..."></b-form-input>
                    </b-form-group>
                    <b-form-group label="Sex:" label-cols-sm="2" label-align-sm="right" class="mb-0 font-weight-700"  v-slot="{ }" >
                        <b-form-radio-group v-model="employeeData_update.sex" id="sex" class="pt-2 font-weight-600" :options="radio_sex" required></b-form-radio-group>
                    </b-form-group>
                    <b-form-group label="Age:" label-for="age" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.age" id="v" type="text" placeholder="Enter age here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Participant Type:" label-for="participantType" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData_update.participantType" id="participantType" :options="drop_participantType" required></b-form-select>
                    </b-form-group>
                    <b-form-group label="School:" label-for="school" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.school" id="school" type="text" placeholder="Enter School here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Grade Level:" label-for="gradeLevel" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData_update.gradeLevel" id="gradeLevel" :options="drop_gradeLevel" ></b-form-select>
                    </b-form-group>
                    <b-form-group label="Province:" label-for="province" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.province" id="province" type="text" placeholder="Enter province here..." ></b-form-input>
                    </b-form-group>
                    <b-form-group label="Region:" label-for="region" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData_update.region" id="region" :options="drop_region" ></b-form-select>
                    </b-form-group>

            </b-card> 
        </b-card>
        <div class="float-right">
            <b-button type="button" class="btn btn-default" variant="outline-danger" v-on:click="hideEmployeeModal">Cancel</b-button>
            <b-button type="submit" class="btn" variant="outline-success" >Save</b-button> 
        </div>
        </b-form>
    </b-modal>
    <b-modal id="updateProfessionalModal" ref="updateProfessionalModal" title="Update Professional Details" hide-footer>
        <b-form v-on:submit.prevent="updateEmployee">
        <b-card no-body>
            <b-card bg-variant="light">
                    <b-form-group label="Event ID:" label-for="event_id" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.event_id" id="event_id" type="text" placeholder="Enter Event ID here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Name:" label-for="name" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.name" id="name" type="text" placeholder="Enter name here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Email:" label-for="email" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.email" id="email" type="text" placeholder="Enter email here..."></b-form-input>
                    </b-form-group>
                    <b-form-group label="Sex:" label-cols-sm="2" label-align-sm="right" class="mb-0 font-weight-700"  v-slot="{ }" >
                        <b-form-radio-group v-model="employeeData_update.sex" id="sex" class="pt-2 font-weight-600" :options="radio_sex" required></b-form-radio-group>
                    </b-form-group>
                    <b-form-group label="Age:" label-for="age" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.age" id="v" type="text" placeholder="Enter age here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Participant Type:" label-for="participantType" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData_update.participantType" id="participantType" :options="drop_participantType" required></b-form-select>
                    </b-form-group>
                    <b-form-group label="Affiliation:" label-for="affiliation" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.affiliation" id="affiliation" type="text" placeholder="Enter affiliation here..." ></b-form-input>
                    </b-form-group>
                    <b-form-group label="Designation:" label-for="designation" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.designation" id="designation" type="text" placeholder="Enter designation here..." ></b-form-input>
                    </b-form-group>
            </b-card> 
        </b-card>
        <div class="float-right">
            <b-button type="button" class="btn btn-default" variant="outline-danger" v-on:click="hideEmployeeModal">Cancel</b-button>
            <b-button type="submit" class="btn" variant="outline-success" >Save</b-button> 
        </div>
        </b-form>
    </b-modal>
    <b-modal id="updateTeacherModal" ref="updateTeacherModal" title="Update Teacher Details" hide-footer>
        <b-form v-on:submit.prevent="updateEmployee">
        <b-card no-body>
            <b-card bg-variant="light">
                    <b-form-group label="Event ID:" label-for="event_id" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.event_id" id="event_id" type="text" placeholder="Enter Event ID here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Name:" label-for="name" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.name" id="name" type="text" placeholder="Enter name here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Email:" label-for="email" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.email" id="email" type="text" placeholder="Enter email here..."></b-form-input>
                    </b-form-group>
                    <b-form-group label="Sex:" label-cols-sm="2" label-align-sm="right" class="mb-0 font-weight-700"  v-slot="{ }" >
                        <b-form-radio-group v-model="employeeData_update.sex" id="sex" class="pt-2 font-weight-600" :options="radio_sex" required></b-form-radio-group>
                    </b-form-group>
                    <b-form-group label="Age:" label-for="age" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.age" id="v" type="text" placeholder="Enter age here..." required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Participant Type:" label-for="participantType" label-cols-sm="2" label-align-sm="right" class="font-weight-700"> 
                        <b-form-select v-model="employeeData_update.participantType" id="participantType" :options="drop_participantType" required></b-form-select>
                    </b-form-group>
                    <b-form-group label="Location:" label-for="location" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.school" id="school" type="text" placeholder="Enter Location here..." ></b-form-input>
                    </b-form-group>
                    <b-form-group label="School:" label-for="school" label-cols-sm="2" label-align-sm="right" class="font-weight-700">
                        <b-form-input v-model="employeeData_update.school" id="school" type="text" placeholder="Enter School here..." ></b-form-input>
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
import * as employeeService from '../services/sja_service';

export default {
    name: 'employee',
    data() {
        return {
            employees: [],
            employeeData:{
                event_id:'',
                name:'',
                email:'',
                sex: null,
                age:'',
                school:'',
                gradeLevel: null,
                affiliation:'',
                designation:'',
                location:'',
                province:'',
                region: null,
                participantType: null
            },
            employeeData_update:{},
            radio_sex: [{ text: 'Male', value: 'Male' },{ text: 'Female', value: 'Female'}],
            drop_gradeLevel: [{ text: 'Select Grade Level here', value: null }, 'Grade 1', 
                                                                                'Grade 2', 
                                                                                'Grade 3', 
                                                                                'Grade 4', 
                                                                                'Grade 5', 
                                                                                'Grade 6', 
                                                                                'Grade 7', 
                                                                                'Grade 8', 
                                                                                'Grade 9', 
                                                                                'Grade 10', 
                                                                                'Grade 11', 
                                                                                'Grade 12'],
            drop_region: [{text: 'Select Region here', value: null},
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
            drop_participantType: [{ text: 'Select Paticipant Type here', value: null }, 'Student', 'Professional', 'Teacher'],
            // drop_status: [{ text: 'Select Status here', value: null }, 'Requested', 'Initiated'],
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
                { key: 'id', label: 'Participant ID'  },
                { key: 'name', label: 'Name' },
                { key: 'sex', label: 'Sex' },
                { key: 'age', label: 'Age' },
                { key: 'participantType', label: 'Participant Type' },
                // { key: 'event_id', label: 'Event Attended'  },
                // { key: 'pwd', label: 'PWD' },
                // { key: 'affiliation', label: 'Affiliation' },
                // { key: 'topic', label: 'Topic' },
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
            if (data['participantType'] == 'Student'){
                this.$refs.updateStudentModal.show()
            }
            else if (data['participantType'] == 'Professional'){
                this.$refs.updateProfessionalModal.show()
            }
            else if (data['participantType'] == 'Teacher'){
                this.$refs.updateTeacherModal.show()
            }
        },
        hideUpdateMdl(data){
            this.employeeData_update = {...data}
            this.$refs.updateStudentModal.hide()
            this.$refs.updateProfessionalModal.hide()
            this.$refs.updateTeacherModal.hide()
        },
        clearModal(){
            this.$refs.add-teacher.removeData();
            this.$refs.add-professional.removeData();
            this.$refs.add-student.removeData();
        },
        // loadEmployees: async function() {
        //     try{
        //         const response = await employeeService.loadHealth();
        //         this.employees = response.data.data;
        //         this.totalRows = this.employees.length;
        //         console.log(response);
        //     } catch(error) {
        //         this.flashMessage.error({
        //         message: 'Some error occured! Please try again.',
        //         time: 5000
        //         });
        //     }
        // },
        loadEmployees: async function() {
            try{
                const response = await employeeService.loadHealth();
                this.employees = response.data.data;
                this.totalRows = this.employees.length;
                console.log('aa');
            } catch(error) {
                this.flashMessage.error({
                message: 'Some error occured! Please try again.',
                time: 5000
                });
            }
        },
        createEmployee: async function() {

            let formData = new FormData();
            formData.append('event_id', this.employeeData.event_id);
            formData.append('name', this.employeeData.name);
            formData.append('email', this.employeeData.email);
            formData.append('sex', this.employeeData.sex);
            formData.append('age', this.employeeData.age);
            formData.append('school', this.employeeData.school);
            formData.append('gradeLevel', this.employeeData.gradeLevel);
            formData.append('affiliation', this.employeeData.affiliation);
            formData.append('designation', this.employeeData.designation);
            formData.append('location', this.employeeData.location);
            formData.append('province', this.employeeData.province);
            formData.append('region', this.employeeData.region);
            formData.append('participantType', this.employeeData.participantType);

            try {
                const response = await employeeService.createHealth(formData);
                console.log(response);
                this.hideEmployeeModal();
                this.flashMessage.success({
                    status: '',
                    message: 'Employee added successfully!',
                    time: 5000
                });
                this.employeeData = {
                    event_id:'',
                    name:'',
                    email:'',
                    sex: null,
                    age:'',
                    school:'',
                    gradeLevel: null,
                    affiliation:'',
                    designation:'',
                    location:'',
                    province:'',
                    region: null,
                    participantType: null
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
                formData.append('event_id', this.employeeData_update.event_id);
                formData.append('name', this.employeeData_update.name);
                formData.append('email', this.employeeData_update.email);
                formData.append('sex', this.employeeData_update.sex);
                formData.append('age', this.employeeData_update.age);
                formData.append('school', this.employeeData_update.school);
                formData.append('gradeLevel', this.employeeData_update.gradeLevel);
                formData.append('affiliation', this.employeeData_update.affiliation);
                formData.append('designation', this.employeeData_update.designation);
                formData.append('location', this.employeeData_update.location);
                formData.append('province', this.employeeData_update.province);
                formData.append('region', this.employeeData_update.region);
                formData.append('participantType', this.employeeData_update.participantType);

                formData.append("_method", "put");

                const response = await employeeService.updateHealthData(this.employeeData_update.id, formData);
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
                const response = await employeeService.deleteHealths(employee_data.id);
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
            this.$refs['add-student'].hide();
            this.$refs['add-teacher'].hide();
            this.$refs['add-professional'].hide();
        },
        showEmployeeModal() {
            this.$refs.add-employee.show();
        }
    }
}

</script>