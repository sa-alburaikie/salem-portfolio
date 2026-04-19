<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';

const services = ref([])

onMounted(async () => {
  getServices()
})

const getServices = async () => {
  const { data } = await axios.get('/api/services')
  services.value = data.services
}
</script>

<template>
  <section class="skills section" id="skills">
    <h2 class="section__title">Skills</h2>
    <p class="section__subtitle">My technical level</p>

    <div class="skills_container container grid">
      <div class="skills_content glass" v-for="service in services" :key="service.id">
        <div class="skills_header">
          <i class="uil uil-brackets-curly skills_icon"></i>
          <div>
            <h3 class="skills_title">{{ service.name }}</h3>
          </div>
          <i class="uil uil-angle-down skills_arrow"></i>
        </div>

        <div class="skills_list">
          <div class="skills_data" v-for="skill in service.skills" :key="skill.id">
            <div class="skills_titles">
              <h4 class="skills_name">{{ skill.name }}</h4>
              <span class="skills_number">{{ skill.proficiency }}%</span>
            </div>
            <div class="skills_bar">
              <div class="skills_percentage" 
                   :style="{ width: `${skill.proficiency}%` }"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.skills_container {
  grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
  gap: 2rem;
}

.skills_content {
  padding: 2rem;
}

.skills_header {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1.8rem;
  cursor: pointer;
}

.skills_icon {
  font-size: 2.2rem;
  color: var(--first-color);
}

.skills_title {
  font-size: 1.35rem;
}

.skills_arrow {
  margin-left: auto;
  font-size: 1.8rem;
  transition: transform 0.4s;
}

.skills_list {
  display: grid;
  gap: 1.4rem;
}

.skills_data {
  margin-bottom: 0.8rem;
}

.skills_titles {
  display: flex;
  justify-content: space-between;
  margin-bottom: 0.6rem;
}

.skills_name {
  font-weight: var(--font-medium);
}

.skills_number {
  color: var(--first-color);
  font-weight: var(--font-medium);
}

.skills_bar {
  height: 6px;
  background: var(--first-color-lighter);
  border-radius: 9999px;
  overflow: hidden;
}

.skills_percentage {
  height: 100%;
  background: linear-gradient(90deg, var(--first-color), var(--first-color-alt));
  border-radius: 9999px;
  transition: width 1.5s ease;
}
</style>