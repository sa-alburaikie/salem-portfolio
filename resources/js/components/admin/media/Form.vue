<script setup>
import axios from 'axios';
import Swal from 'sweetalert2';
import { reactive } from 'vue';
import EventBus from '../../../lib/EventBus';

const form = reactive({
    link: '',
    icon: ''
});

const handleSave = async () => {
    await axios.post('/api/media',form)
    .then((data)=> {
        Swal.fire({
            icon: 'success',
            title: 'Social Media Added'
        });
        form.link = '';
        form.icon = '';
        EventBus.emit('show-media');
    });
}

</script>


<template>
    <div class="social_table-heading">
        <p>Link</p>
        <span style="color:#006fbb;">(Find your icon class: Font Awesome)</span>
        <p></p>
    </div>
    <p></p>
    <div class="social_table-items">

        <input type="text" v-model="form.link" />

        <input type="text" v-model="form.icon" />
        <button @click="handleSave">
            Add Media
        </button>
    </div>
</template>