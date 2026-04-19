<script setup>
import axios from 'axios';
import { nextTick, onMounted, ref } from 'vue';
import Swiper from 'swiper';
import 'swiper/css';
import 'swiper/css/pagination';
import { Pagination } from 'swiper/modules';

const testmonials = ref([]);

onMounted(async () => {
    await getTestmonials();
});

const getTestmonials = async () => {
    const { data } = await axios.get('/api/testmonials');
    testmonials.value = data.testmonials;

    await nextTick();

    new Swiper('.testimonial_swiper', {
        modules: [Pagination],
        loop: true,
        grabCursor: true,
        spaceBetween: 40,
        pagination: {
            el: '.swiper-pagination-testimonial',
            clickable: true,
        },
        breakpoints: {
            640: { slidesPerView: 2 },
            1024: { slidesPerView: 3 }
        }
    });
};

const ourImage = (img) => {
    return img ? `/upload/${img}` : `/template/assets/img/avatar.jpg`;
};
</script>

<template>
    <section class="testimonial section">
        <div class="container">
            <h2 class="section__title">Client Testimonials</h2>
            <p class="section__subtitle">What people say about working with me</p>

            <div class="testimonial_swiper swiper-container">
                <div class="swiper-wrapper">
                    <div class="testimonial_slide swiper-slide glass" v-for="item in testmonials" :key="item.id">

                        <div class="testimonial_quote">“</div>

                        <p class="testimonial_text">
                            {{ item.testinomy }}
                        </p>

                        <div class="testimonial_author">
                            <img :src="ourImage(item.image)" alt="" class="testimonial_avatar">
                            <div>
                                <h4 class="testimonial_name">{{ item.name }}</h4>
                                <p class="testimonial_position">{{ item.function }}</p>
                            </div>
                        </div>

                        <div class="testimonial_stars">
                            <i v-for="n in 5" :key="n" class="uil uil-star testimonial_icon-star" :style="{
                                color: n <= Number(item.rating) ? '#FFD700' : '#ccc',
                                '-webkit-text-fill-color': n <= Number(item.rating) ? '#FFD700' : '#transparent',
                                '-webkit-text-stroke': n <= Number(item.rating) ? '1px #FFD700' : '1px #ccc'   // أو #ccc للنجوم الفارغة
                            }">
                            </i>
                        </div>
                    </div>
                </div>

                <div class="swiper-pagination swiper-pagination-testimonial"></div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.swiper_slide {
    height: auto !important;
    display: flex;
}

.testimonial_slide {
    padding: 2.8rem 2.2rem;
    height: 400px;
    display: flex;
    flex-direction: column;
}

.testimonial_swiper .swiper-wrapper {
  align-items: stretch;
}

.testimonial_quote {
    font-size: 4.5rem;
    line-height: 1;
    color: var(--first-color);
    opacity: 0.15;
    margin-bottom: 1rem;
}

.testimonial_text {
    flex: 1;
    overflow: auto;
    font-size: 1.15rem;
    line-height: 1.8;
    font-style: italic;
    color: var(--text-color);
    margin-bottom: 2rem;
}

.testimonial_author {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.testimonial_avatar {
    width: 58px;
    height: 58px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--first-color);
}

.testimonial_name {
    font-size: 1.25rem;
    margin-bottom: 0.2rem;
}

.testimonial_position {
    color: var(--text-color-light);
    font-size: 0.95rem;
}

.testimonial_stars {
    color: #facc15;
    font-size: 1.4rem;
}

.testimonial_stars .active {
    color: #facc15;
}
</style>