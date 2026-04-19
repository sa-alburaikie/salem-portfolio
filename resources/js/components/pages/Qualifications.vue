<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';

const educations = ref([]);

onMounted(async () => {
  const { data } = await axios.get('/api/educations');
  educations.value = data.educations;
});
</script>

<template>
  <section class="qualification section">
    <div class="container">
      <h2 class="section__title">My Journey</h2>
      <p class="section__subtitle">Education & Experience</p>

      <div class="qualification_timeline">
        <div class="timeline-item" v-for="(edu, index) in educations" :key="edu.id">
          <div class="timeline-dot"></div>
          
          <div class="timeline-content glass" :class="{ 'right': index % 2 === 1 }">
            <div class="timeline-date">{{ edu.period }}</div>
            <h3 class="timeline-title">{{ edu.degree }}</h3>
            <p class="timeline-subtitle">{{ edu.institution }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.qualification_timeline {
  max-width: 900px;
  margin: 0 auto;
  position: relative;
}

.qualification_timeline::before {
  content: '';
  position: absolute;
  left: 50%;
  top: 0;
  bottom: 0;
  width: 3px;
  background: var(--first-color);
  opacity: 0.15;
  transform: translateX(-50%);
}

.timeline-item {
  display: flex;
  align-items: center;
  margin-bottom: 4.5rem;
  position: relative;
}

.timeline-dot {
  width: 22px;
  height: 22px;
  background: var(--first-color);
  border: 5px solid var(--container-color);
  border-radius: 50%;
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  z-index: 2;
  box-shadow: 0 0 0 6px rgba(var(--hue-color), 90%, 64%, 0.2);
}

.timeline-content {
  width: 45%;
  padding: 2rem 2.2rem;
}

.timeline-content.right {
  margin-left: auto;
}

.timeline-date {
  font-size: 0.95rem;
  color: var(--first-color);
  font-weight: 600;
  margin-bottom: 0.6rem;
}

.timeline-title {
  font-size: 1.45rem;
  margin-bottom: 0.6rem;
}

.timeline-subtitle {
  color: var(--text-color-light);
  font-size: 1.05rem;
}

@media (max-width: 768px) {
  .qualification_timeline::before {
    left: 30px;
  }
  
  .timeline-item {
    flex-direction: column;
    align-items: flex-start;
  }
  
  .timeline-dot {
    left: 30px;
  }
  
  .timeline-content {
    width: 100%;
    margin-left: 70px;
  }
  
  .timeline-content.right {
    margin-left: 70px;
  }
}
</style>