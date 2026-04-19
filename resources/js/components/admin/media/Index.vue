<script setup>
import axios from 'axios';
import Base from '../../layouts/admin/Base.vue';
import Nav from '../../layouts/admin/Nav.vue';
import { onMounted, ref } from 'vue';
import Form from './Form.vue';
import MediaForm from './Form.vue'
import EventBus from '../../../lib/EventBus';
import Swal from 'sweetalert2';

let media = ref([])

onMounted(async () => {
    getMedia();
})

EventBus.on('show-media',(()=> {
    getMedia();
}))

const getMedia = async () => {
    await axios.get('/api/media')
        .then(({ data }) => {
            media.value = data.media
        })
        ;
}

const deleteMedia = async (id) => {
    await axios.delete(`/api/media/${id}`)
    .then(({data}) => {
        Swal.fire({
            icon: 'success',
            title: 'Social Media Deleted'
        });
        getMedia();
    });
}

</script>

<template>
    <Base />
    <section class="setting" id="setting">
        <div class="setting-wrapper">
            <div class="setting_nav">
                <div class="setting-titlebar">
                    <img src="/public/template/assets/img/avatar.jpg" alt="" class="setting-avatar">
                    <p>Natalia Brakux</p>
                </div>
                <Nav />
            </div>
            <div class="setting_content">
                <section class="about" id="about">
                    <div class="titlebar">
                        <h1>Medias</h1>
                    </div>
                    <div class="card-wrappere">
                        <div class="card">
                            <h2>Social media</h2>
                            <div class="social_table-heading">
                                <p>Link</p>
                                <p>Icon</p>
                                <p></p>
                            </div>
                            <!-- item 1 -->
                            <div class="social_table-items" v-for="item in media" :key="item.id">
                                <p>{{ item.link }}</p>
                                <button class="service_table-icon">
                                    <i :class="item.icon"></i>
                                </button>
                                <button @click="deleteMedia(item.id)">
                                    delete
                                </button>
                            </div>

                            <br>
                            <MediaForm />
                        </div>
                    </div>


                </section>
            </div>
        </div>
    </section>
</template>