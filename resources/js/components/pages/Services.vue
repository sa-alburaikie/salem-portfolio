<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';

const services = ref([]);
const modalState = ref(false);
const selectedService = ref(null);

onMounted(async () => {
  const { data } = await axios.get('/api/services');
  services.value = data.services;
});

const openModal = (service) => {
  selectedService.value = service;
  modalState.value = true;
};

const closeModal = () => {
  modalState.value = false;
};
</script>

<template>
  <section class="services section" id="services">
    <div class="container">
      <h2 class="section__title">Services I Offer</h2>
      <p class="section__subtitle">What I can do for you</p>

      <div class="services_grid grid">
        <div class="service_card glass" 
             v-for="service in services" 
             :key="service.id"
             @click="openModal(service)">
          
          <div class="service_icon-wrapper">
            <i :class="service.icon" class="service_icon"></i>
          </div>
          
          <h3 class="service_title">{{ service.name }}</h3>
          <p class="service_desc">Click to see details</p>
          
          <span class="service_link">
            View Details 
            <i class="uil uil-arrow-right"></i>
          </span>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div v-if="modalState" class="modal-overlay" @click="closeModal">
      <div class="modal-content glass" @click.stop>
        <button class="modal-close" @click="closeModal">
          <i class="uil uil-times"></i>
        </button>
        
        <h3 class="modal-title">{{ selectedService?.name }}</h3>
        
        <ul class="modal-list">
          <li v-for="(item, i) in selectedService?.description?.split('\n')" 
              :key="i">
            <i class="uil uil-check-circle"></i>
            <span>{{ item }}</span>
          </li>
        </ul>
      </div>
    </div>
  </section>
</template>

<style scoped>
.services_grid {
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 2.5rem;
}

.service_card {
  padding: 3rem 2.2rem;
  text-align: center;
  cursor: pointer;
  transition: all 0.5s ease;
}

.service_card:hover {
  transform: translateY(-15px) scale(1.03);
}

.service_icon-wrapper {
  width: 90px;
  height: 90px;
  margin: 0 auto 1.8rem;
  background: rgba(var(--hue-color), 90%, 64%, 0.1);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.service_icon {
  font-size: 3.2rem;
  color: var(--first-color);
}

.service_title {
  font-size: 1.5rem;
  margin-bottom: 1rem;
}

.service_desc {
  color: var(--text-color-light);
  margin-bottom: 2rem;
}

.service_link {
  color: var(--first-color);
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

/* Modal */
.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.75);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
}

.modal-content {
  max-width: 560px;
  width: 90%;
  padding: 3rem 2.5rem;
  position: relative;
}

.modal-close {
  position: absolute;
  top: 1.5rem;
  right: 1.5rem;
  font-size: 1.8rem;
  background: none;
  border: none;
  color: var(--text-color-light);
  cursor: pointer;
}

.modal-title {
  text-align: center;
  margin-bottom: 2.2rem;
  font-size: 1.8rem;
}

.modal-list {
  list-style: none;
}

.modal-list li {
  display: flex;
  gap: 1rem;
  margin-bottom: 1.2rem;
  font-size: 1.08rem;
}

.modal-list i {
  color: var(--first-color);
  font-size: 1.4rem;
}
</style>