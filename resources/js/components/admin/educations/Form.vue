<script setup>
import axios from 'axios';
import Swal from 'sweetalert2';
import { reactive, ref } from 'vue';
import EventBus from '../../../lib/EventBus';


const showModal = ref(false)
const editMode = ref(false)
const form = reactive({
    institution: "",
    period: "",
    degree: "",
    department: ""
})

const openModal = () => {
    showModal.value = true;
    editMode.value = false

}

const closeModal = () => {
    showModal.value = false
    form.institution = ""
    form.period = ""
    form.degree = ""
    form.department = ""
}

EventBus.on('show-education-form', ((education) => {
    showModal.value = true
    editMode.value = true
    form.id = education.id
    form.institution = education.institution
    form.period = education.period
    form.degree = education.degree
    form.department = education.department
}))

const handleSave = async (values, actions) => {
    if (editMode.value) {
        updateEducation(values, actions)
    } else {
        createEducation(values, actions)
    }
}

const createEducation = async (values, actions) => {
    await axios.post('/api/educations', form)
        .then(({ data }) => {
            closeModal()
            Swal.fire({
                icon: "success",
                title: "Education Added"
            })
            EventBus.emit('show-educations')
        })
}

const updateEducation = async (values, actions) => {
    await axios.post(`/api/educations/${form.id}`, form)
        .then(({ data }) => {
            closeModal()
            Swal.fire({
                icon: "success",
                title: "Education Updated"
            })
            EventBus.emit('show-educations')
        })
}

</script>

<template>
    <button @click="openModal">New Education</button>
    <div class="modal" :class="showModal ? 'show' : ''">
        <div class="modal-content">
            <h2>
                <span v-if="editMode">Edit Education</span>
                <span v-else>Create Education</span>
            </h2>
            <span @click="closeModal">×</span>
            <hr>
            <div>
                <label>Institution</label>
                <input type="text" v-model="form.institution" />

                <label>Period</label>
                <input type="text" v-model="form.period" />

                <label>Degree</label>
                <input type="text" v-model="form.degree" />

                <label>Department</label>
                <input type="text" v-model="form.department" />
            </div>
            <hr>
            <div class="modal-footer">
                <button @click="closeModal">
                    Cancel
                </button>
                <button class="secondary" @click="handleSave">
                    <span><i class="fa fa-spinner fa-spin"></i></span>
                    Save
                </button>
            </div>
        </div>
    </div>
</template>