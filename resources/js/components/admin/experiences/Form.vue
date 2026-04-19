<script setup>
import axios from 'axios';
import Swal from 'sweetalert2';
import { reactive, ref } from 'vue';
import EventBus from '../../../lib/EventBus';


let openModal = ref(false)
const editMode = ref(false)
const form = reactive({
    company: "",
    period: "",
    position: ""
})

const showModal = () => {
    openModal.value = true
}

const closeModal = () => {
    openModal.value = false
    editMode.value = false
    form.id = ''
    form.company = ''
    form.period = ''
    form.position = ''
}

EventBus.on('show-form', ((experience) => {
    editMode.value = true
    showModal()
    form.id = experience.id
    form.company = experience.company
    form.period = experience.period
    form.position = experience.position

}))

const handleSave = async (values, actions) => {
    if (editMode) {
        updateExperience(values, actions)
    } else {
        createExperience(values, actions)
    }
}

const createExperience = async (values, action) => {
    await axios.post('/api/experiences', form)
        .then(({ data }) => {
            closeModal()
            Swal.fire(
                {
                    icon: 'success',
                    title: "Experience Added"
                }
            )
            EventBus.emit('show-experiences')
        })
}

const updateExperience = async (values, actions) => {
    await axios.post(`/api/experiences/${form.id}`, form)
        .then(({ data }) => {
            closeModal()
            Swal.fire(
                {
                    icon: 'success',
                    title: "Experience Updated"
                }
            )
            EventBus.emit('show-experiences')
        })
}

</script>

<template>
    <button @click="showModal">New Experience</button>
    <div class="modal" :class="openModal ? 'show' : ''">
        <div class="modal-content">
            <h2>
                <span v-if="editMode">Edit Experience</span>
                <span v-else>Create Experience</span>
            </h2>
            <span @click="closeModal">×</span>
            <hr>
            <div>
                <p>Company</p>
                <input type="text" v-model="form.company" />

                <p>Period</p>
                <input type="text" v-model="form.period" />

                <p>Position</p>
                <input type="text" v-model="form.position" />
            </div>
            <hr>
            <div class="modal-footer">
                <button class="close-modal" @click="closeModal">Cancel</button>
                <button class="secondary" @click="handleSave">
                    <span><i class="fa fa-spinner fa-spin"></i></span>Save
                </button>
            </div>
        </div>
    </div>
</template>