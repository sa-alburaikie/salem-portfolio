<script setup>
import axios from 'axios';
import Base from '../../layouts/admin/Base.vue';
import { onMounted, ref } from 'vue';
import Form from './Form.vue';
import EventBus from '../../../lib/EventBus';

const experiences = ref([])

onMounted(async () => {
    getExperiences();
})

EventBus.on('show-experiences', (() => {
    getExperiences()
}))

const onEdit = (experience) => {
    EventBus.emit('show-form', experience)
}

const onDelete = (id) => {
    Swal.fire({
        title: 'Are you sure ?',
        text: "you won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`/api/experiences/${id}`)
                .then(() => {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                    getExperiences();
                });
        }
    })
}

const getExperiences = async () => {
    axios.get('/api/experiences')
        .then(({ data }) => {
            experiences.value = data.experiences
        })
}
</script>

<template>
    <Base />
    <section class="experiences" id="experiences">
        <div class="titlebar">
            <h1>Experiences </h1>
            <Form />
        </div>
        <div class="table">
            <div class="table-filter">
                <div>
                    <ul class="table-filter-list">
                        <li>
                            <p class="table-filter-link link-active">All</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="table-search">
                <div>
                    <select class="search-select" name="" id="">
                        <option value="">Filter Experience</option>
                    </select>
                </div>
                <div class="relative">
                    <input class="search-input" type="text" name="search" placeholder="Search Experience...">
                </div>
            </div>
            <div class="experience_table-heading">
                <p>Company</p>
                <p>Period</p>
                <p>Position</p>
                <p>Actions</p>
            </div>
            <!-- items -->
            <div class="experience_table-items" v-for="experience in experiences" :key="experience.id">
                <p>{{ experience.company }}</p>
                <p>{{ experience.period }}</p>
                <p>{{ experience.position }}</p>
                <div>
                    <button class="btn-icon success" @click="onEdit(experience)">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="btn-icon danger" @click="onDelete(experience.id)">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>

        </div>
    </section>
</template>