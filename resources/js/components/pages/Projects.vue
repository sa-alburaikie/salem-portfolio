<script setup>
import axios from 'axios';
import { nextTick, onMounted, ref } from 'vue';
import Swiper from 'swiper';
import 'swiper/css';
import 'swiper/css/pagination';
import { Pagination, Navigation } from 'swiper/modules';

const projects = ref([]);
const status = ref(false);

onMounted(async () => {
  await getProjects();
});

const getProjects = async () => {
  const { data } = await axios.get('/api/projects-list');
  projects.value = data.projects;

  await nextTick();

  new Swiper('.portfolio_swiper', {
    modules: [Pagination, Navigation],
    loop: true,
    grabCursor: true,
    spaceBetween: 40,
    slidesPerView: 1,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    breakpoints: {
      768: { slidesPerView: 2 },
      1024: { slidesPerView: 2 }
    }
  });
};

const ourImage = (img) => {
  return img ? `/upload/${img}` : `/template/assets/img/portfolio1.jpeg`;
};

const handleClick = (event, demo) => {
  if (!demo) {
    event.preventDefault();
    status.value = true;
  }
}
</script>

<template>
  <section class="portfolio section" id="portfolio">
    <div class="container">
      <h2 class="section__title">Recent Projects</h2>
      <div class="portfolio_swiper swiper-container">
        <div class="swiper-wrapper">
          <div class="portfolio_slide swiper-slide" v-for="project in projects" :key="project.id">

            <div class="project_card glass">
              <div class="project_img">
                <img :src="ourImage(project.image)" alt="">
                <div class="project_overlay">
                  <a :href="project.link" target="_blank" class="project_btn">
                    View on GitHub
                  </a>
                </div>
              </div>

              <div class="project_info">
                <h3 class="project_title">{{ project.name }}</h3>
                <p class="project_description">{{ project.description }}</p>

                <div class="project_links">
                  <a :href="project.link" target="_blank" class="button button--small">
                    GitHub
                  </a>
                  <a :href="project.demo || '#'" :class="{ disabled: !project.demo ? true : false }" target="_blank"
                    @click="handleClick($event, project.demo)" class="button button--small button--white">
                    Live Demo
                  </a>
                </div>
                <span v-if="!project.demo && status == true" class="demo-badge">Demo Not Available Yet</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Navigation -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.portfolio_swiper {
  padding-bottom: 4rem;
}

.project_card {
  overflow: hidden;
  height: 700px;
  display: flex;
  flex-direction: column;
}

.project_img {
  position: relative;
  height: 400px;
  overflow: hidden;
}

.project_img img {
  width: 100%;
  height: 100%;
  object-fit: fill;
  transition: transform 0.6s ease;
}

.project_card:hover .project_img img {
  transform: scale(1.08);
}

.project_overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
  opacity: 0;
  transition: opacity 0.4s;
  display: flex;
  align-items: flex-end;
  justify-content: center;
  padding-bottom: 2rem;
}

.project_card:hover .project_overlay {
  opacity: 1;
}

.project_info {
  padding: 2rem 1.8rem;
  flex: 1;
  display: flex;
  flex-direction: column;
}

.project_title {
  font-size: 1.45rem;
  margin-bottom: 0.8rem;
}

.project_description {
  flex: 1;
  color: var(--text-color);
  margin-bottom: 1.8rem;
  line-height: 1.7;
}

.project_links {
  display: flex;
  gap: 1rem;
}

.swiper-button-next,
.swiper-button-prev {
  width: 54px;
  height: 54px;
  background: var(--container-color);
  border-radius: 50%;
  color: var(--first-color);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}


.swiper-button-prev {
  transform: scaleX(-1);
}

.swiper-button-next::after,
.swiper-button-prev::after {
  display: none;
}


.swiper-pagination-bullet-active {
  background: var(--first-color);
}

.demo-badge {
  display: inline-block;
  padding: 6px 12px;
  margin-top: 5px;
  font-size: 12px;
  font-weight: 500;
  color: white;
  background-color: #734bea;
  border: 1px solid #ffeeba;
  border-radius: 20px;
}
</style>