<script setup>
import axios from 'axios';
import Base from '../../layouts/admin/Base.vue';
import { onMounted, reactive, ref } from 'vue';
import router from '../../../route';
import Swal from 'sweetalert2';
import { useRoute } from 'vue-router';

const form = reactive({
    name: '',
    function: '',
    testinomy: '',
    rating: '',
    image: ''
})
const errors = ref([])
const editMode = ref(false)
const route = useRoute()

onMounted(() => {
    if (route.name === 'admin.testmonials.edit') {
        editMode.value = true
    }
    getTestmonials()
})

const getTestmonials = async () => {
    await axios.get(`/api/testmonials/${route.params.id}`)
        .then(({ data }) => {
            form.name = data.testmonial.name
            form.function = data.testmonial.function
            form.testinomy = data.testmonial.testinomy
            form.rating = data.testmonial.rating
            form.image = data.testmonial.image
        })
}

const ourImage = () => {
    if (form.image) {
        return "/upload/" + form.image
    } else {
        return "/template/assets/img/avatar.jpg"
    }
}

const handleFileChange = (e) => {
    form.image = e.target.files[0];
    let reader = new FileReader;
    reader.onload = () => {
        let output = document.getElementById('testmonial-img');
        output.src = reader.result;
    }
    reader.readAsDataURL(e.target.files[0]);
}

const handleSave = async (values, actions) => {
    if (editMode.value) {
        updateTestmonial(values, actions)
    } else {
        createTestmonial(values, actions)
    }
}

const createTestmonial = async (values, actions) => {
    const formData = new FormData
    formData.append('name', form.name)
    formData.append('function', form.function)
    formData.append('testinomy', form.testinomy)
    formData.append('rating', form.rating)
    formData.append('image', form.image)
    await axios.post('/api/testmonials', formData)
        .then(({ data }) => {
            router.push('/admin/testmonials')
            Swal.fire({
                icon: 'success',
                title: 'Testimonial Added !'
            })
        })
        .catch((error) => {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors
            }
        })
}

const updateTestmonial = async (values,actions) => {
    const formData = new FormData
    formData.append('name', form.name)
    formData.append('function', form.function)
    formData.append('testinomy', form.testinomy)
    formData.append('rating', form.rating)
    formData.append('image', form.image)
    await axios.post(`/api/testmonials/${route.params.id}`, formData)
        .then(({ data }) => {
            router.push('/admin/testmonials')
            Swal.fire({
                icon: 'success',
                title: 'Testimonial Updated !'
            })
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
    <section class="about">
        <div class="titlebar">
            <h1>
                <span v-if="editMode">Edit Testimonial</span>
                <span v-else>Create Testimonial</span>
            </h1>
            <button @click="handleSave">Save Testimonial</button>
        </div>
        <div class="card-wrapper">
            <div class="wrapper_left">
                <div class="card">
                    <label>Name</label>
                    <span style="color: red;" v-if="errors.name">{{ errors.name }}</span>
                    <input type="text" v-model="form.name" />

                    <label>Function</label>
                    <span style="color: red;" v-if="errors.function">{{ errors.function }}</span>
                    <input type="text" v-model="form.function" />

                    <label>Testimony</label>
                    <textarea cols="10" rows="5" v-model="form.testinomy"></textarea>

                    <label>Rating</label>
                    <input type="text" v-model="form.rating" />
                </div>
            </div>

            <div class="wrapper_right">
                <div class="card">
                    <img :src="ourImage()" class="avatar_img" id="testmonial-img">
                    <input type="file" id="fileimg" @change="handleFileChange">
                </div>
            </div>

        </div>
        <div class="titlebar">
            <h1></h1>
            <button @click="handleSave">Save Testimonial</button>
        </div>
    </section>
</template>