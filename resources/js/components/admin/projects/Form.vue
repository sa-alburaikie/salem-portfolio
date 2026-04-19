<script setup>

import axios from 'axios';
import Base from '../../layouts/admin/Base.vue';
import { onMounted, reactive, ref } from 'vue';
import router from '../../../route';
import Swal from 'sweetalert2';
import { useRoute } from 'vue-router';

const route = useRoute()

const form = reactive({
    name: '',
    description: '',
    link: '',
    image: ''
})
const errors = ref([])
const editMode = ref(false)

onMounted(() => {
    if (route.name === 'admin.projects.edit') {
        editMode.value = true
    }
    getProject()
})

const getProject = async () => {
    await axios.get(`/api/projects/${route.params.id}`)
        .then(({ data }) => {
            form.name = data.project.name
            form.description = data.project.description
            form.link = data.project.link
            form.image = data.project.image
        })
}

const ourImage = () => {
    if (form.image) {
        return "/upload/" + form.image
    } else {
        return "/template/assets/img/no-image.png"
    }
}

const handleFileChange = (e) => {
    form.image = e.target.files[0];
    let reader = new FileReader;
    reader.onload = () => {
        let output = document.getElementById('project-img');
        output.src = reader.result;
    }
    reader.readAsDataURL(e.target.files[0]);
}

const handleSave = async (values, actions) => {
    if (editMode.value) {
        updateProject(values, actions)
    } else {
        createProject(values, actions)
    }
}

const createProject = async (values, actions) => {
    const formData = new FormData()
    formData.append('name', form.name)
    formData.append('description', form.description)
    formData.append('link', form.link)
    formData.append('image', form.image)
    await axios.post('/api/projects', formData)
        .then(({ data }) => {
            router.push('/admin/projects')
            Swal.fire({ icon: 'success', title: "Project Added" })
        })
        .catch((error) => {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors
            }
        })
}

const updateProject = async () => {
    const formData = new FormData()
    formData.append('name', form.name)
    formData.append('description', form.description)
    formData.append('link', form.link)
    formData.append('image', form.image)
    await axios.post(`/api/projects/${route.params.id}`, formData)
        .then(({ data }) => {
            router.push(`/admin/projects`)
            Swal.fire({ icon: 'success', title: "Project Updated" })
        })
        .catch((error) => {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors
            }
        })
}

</script>

<template>
    <Base />
    <section class="about" id="project">
        <div class="titlebar">
            <h1>
                <span v-if="editMode">Edit Project</span>
                <span v-else>Create Project</span>
            </h1>
            <button @click="handleSave">Save Project</button>
        </div>
        <div class="card-wrapper">
            <div class="wrapper_left">
                <div class="card">
                    <label>Name</label>
                    <span style="color: red;" v-if="errors.name">{{ errors.name }}</span>
                    <input type="text" v-model="form.name" />

                    <label>Description</label>
                    <span style="color: red;" v-if="errors.name">{{ errors.description }}</span>
                    <textarea cols="10" rows="5" v-model="form.description"></textarea>

                    <label>Link</label>
                    <input type="text" v-model="form.link" />
                </div>
            </div>

            <div class="wrapper_right">
                <div class="card">
                    <img :src="ourImage()" alt="" class="project_img" id="project-img">
                    <input type="file" @change="handleFileChange">
                </div>
            </div>

        </div>
        <div class="titlebar">
            <h1></h1>
            <button @click="handleSave">Save Project</button>
        </div>
    </section>
</template>