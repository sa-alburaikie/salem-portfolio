<script setup>

import axios from 'axios';
import Base from '../../layouts/admin/Base.vue';
import { onMounted, ref, watch } from 'vue';
import router from '../../../route';

let projects = ref([])
let links = ref([])
const searchQuery = ref([])

onMounted(async () => {
    getProjects()
})

watch(searchQuery, () => {
    getProjects()
})

const ourImage = (img) => {
    if (img) {
        return "/upload/" + img
    } else {
        return "/template/assets/img/no-image.png"
    }
}

const getProjects = async () => {
    await axios.get('/api/projects?&searchQuery=' + searchQuery.value)
        .then(({ data }) => {
            projects.value = data.projects.data
            links.value = data.projects.links
        })
}

const changePage = (link) => {
    if (!link.url || link.active) {
        return
    }
    axios.get(link.url)
        .then(({ data }) => {
            projects.value = data.projects.data
            links.value = data.projects.links
        })
}

const addProject = () => {
    router.push('/admin/projects/create')
}

const onEdit = (id) => {
    router.push(`/admin/projects/${id}/edit`)
}

const onDelete = async (id) => {
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
            axios.delete(`/api/projects/${id}`)
                .then(() => {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                    getProjects();
                });
        }
    })
}

</script>

<template>
    <Base />
    <section class="projects" id="projects">
        <div class="titlebar">
            <h1>Projects </h1>
            <button @click="addProject">New Project</button>
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
                        <option value="">Filter Project</option>
                    </select>
                </div>
                <div class="relative">
                    <input class="search-input" type="text" name="search" placeholder="Search Project..."
                        v-model="searchQuery">
                </div>
            </div>

            <div class="project_table-heading">
                <p>Image</p>
                <p>Title</p>
                <p>Description</p>
                <p>Link</p>
                <p>Actions</p>
            </div>
            <!-- items -->
            <div class="project_table-items" v-for="project in projects" :key="project.id">
                <p>
                    <img :src="ourImage(project.image)" alt="" class="project_img-list">
                </p>
                <p>{{ project.name }}</p>
                <p>{{ project.description }}</p>
                <p>{{ project.link }}</p>
                <div>
                    <button class="btn success" @click="onEdit(project.id)">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="btn danger" @click="onDelete(project.id)">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
            <div class="table-paginate">
                <div class="pagination">
                    <a class="btn" v-for="(link, index) in links" :key="index" v-html="link.label"
                        :class="{ active: link.active, disabled: !link.url }" @click="changePage(link)">

                    </a>
                </div>
            </div>
        </div>
    </section>
</template>