<script setup>
import axios from 'axios';
import Base from '../../layouts/admin/Base.vue'
import { onMounted, ref } from 'vue';
import router from '../../../route';

let testmonials = ref([])

onMounted(async () => {
    getTestmonials()
})


const ourImage = (img) => {
    if (img) {
        return '/upload/' + img
    } else {
        return "/template/assets/img/avatar.jpg"
    }
}

const getTestmonials = async () => {
    await axios.get('/api/testmonials')
        .then(({ data }) => {
            testmonials.value = data.testmonials
        })
}

const addTestimonial = () => {
    router.push('/admin/testmonials/create')
}

const onEdit = (id) => {
    router.push(`/admin/testmonials/${id}/edit`)
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
            axios.delete(`/api/testmonials/${id}`)
                .then(() => {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                    getTestmonials();
                });
        }
    })
}

</script>

<template>
    <Base />
    <section class="testimonials" id="projects">
        <div class="titlebar">
            <h1>Testimonials </h1>
            <button class="btn__open--modal" @click="addTestimonial">New Testimonial</button>
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
                    <input class="search-input" type="text" name="search" placeholder="Search Project...">
                </div>
            </div>

            <div class="testimonial_table-heading">
                <p>Photo</p>
                <p>name</p>
                <p>Function</p>
                <p>Testimony</p>
                <p>Rating</p>
                <p>Actions</p>
            </div>
            <!-- items -->
            <div class="testimonial_table-items" v-for="testmonial in testmonials" :key="testmonial.id">
                <p>
                    <img :src="ourImage(testmonial.image)" alt="" class="testimonial_img-list">
                </p>
                <p>{{ testmonial.name }}</p>
                <p>{{ testmonial.function }}</p>
                <p>{{ testmonial.testinomy }}</p>
                <p>{{ testmonial.rating }}/5</p>
                <div>
                    <button class="btn-icon success" @click="onEdit(testmonial.id)">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="btn-icon danger" @click="onDelete(testmonial.id)">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
            <div class="table-paginate">
                <div class="pagination">
                    <a href="#" class="btn">&laquo;</a>
                    <a href="#" class="btn active">1</a>
                    <a href="#" class="btn">2</a>
                    <a href="#" class="btn">3</a>
                    <a href="#" class="btn">&raquo;</a>
                </div>
            </div>
        </div>
    </section>
</template>