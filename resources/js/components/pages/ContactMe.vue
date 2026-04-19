<script setup>
import axios from 'axios';
import { reactive, ref } from 'vue';

const form = reactive({
  name: '',
  email: '',
  project: '',
  description: ''
});

const isLoading = ref(false);

const submitForm = async () => {
  isLoading.value = true;
  try {
    await axios.post('/api/contact', form);
    alert('✅ تم إرسال الرسالة بنجاح! سأتواصل معك قريباً.');
    
    form.name = '';
    form.email = '';
    form.project = '';
    form.description = '';
  } catch (error) {
    alert('❌ حدث خطأ أثناء الإرسال. يرجى المحاولة مرة أخرى.');
  } finally {
    isLoading.value = false;
  }
};
</script>

<template>
  <section class="contact section" id="contact">
    <div class="container">
      <h2 class="section__title">Let's Start a Project</h2>
      <span class="section__subtitle">I'm always excited to hear about new opportunities</span>

      <div class="contact_grid grid">
        <!-- Contact Info -->
        <div class="contact_info">
          <div class="info_item">
            <i class="uil uil-phone"></i>
            <div>
              <h4>Phone</h4>
              <p>+967 779 011 984</p>
            </div>
          </div>
          <div class="info_item">
            <i class="uil uil-envelope"></i>
            <div>
              <h4>Email</h4>
              <p>smoaa667@gmail.com</p>
            </div>
          </div>
          <div class="info_item">
            <i class="uil uil-map-marker"></i>
            <div>
              <h4>Location</h4>
              <p>Yemen - Hadramout</p>
            </div>
          </div>
        </div>

        <!-- Modern Form -->
        <form @submit.prevent="submitForm" class="contact_form glass">
          <div class="form_grid">
            <div class="form_group">
              <label class="form_label">Full Name</label>
              <input 
                v-model="form.name" 
                type="text" 
                class="form_input"
                required>
            </div>
            <div class="form_group">
              <label class="form_label">Email Address</label>
              <input 
                v-model="form.email" 
                type="email" 
                class="form_input"
                required>
            </div>
          </div>

          <div class="form_group">
            <label class="form_label">Project Title</label>
            <input 
              v-model="form.project" 
              type="text" 
              class="form_input">
          </div>

          <div class="form_group">
            <label class="form_label">Tell me about your project</label>
            <textarea 
              v-model="form.description" 
              rows="7" 
              class="form_input"
              required></textarea>
          </div>

          <button type="submit" class="button" :disabled="isLoading">
            {{ isLoading ? 'Sending Message...' : 'Send Message' }}
            <i class="uil uil-message"></i>
          </button>
        </form>
      </div>
    </div>
  </section>
</template>

<style scoped>
.contact_grid {
  grid-template-columns: 1fr 1.65fr;
  gap: 6rem;
  align-items: start;
}

.contact_info {
  display: flex;
  flex-direction: column;
  gap: 2.8rem;
}

.info_item {
  display: flex;
  gap: 1.4rem;
}

.info_item i {
  font-size: 2.4rem;
  color: var(--first-color);
  margin-top: 4px;
}

.info_item h4 {
  font-size: 1.15rem;
  margin-bottom: 0.3rem;
  color: var(--title-color);
}

.info_item p {
  color: var(--text-color-light);
}

/* Modern Form */
.contact_form {
  padding: 2.8rem 2.5rem;
}

.form_grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.8rem;
}

.form_group {
  margin-bottom: 2rem;
  position: relative;
}

.form_label {
  display: block;
  margin-bottom: 0.7rem;
  font-weight: 500;
  color: var(--title-color);
  font-size: 1.02rem;
}

.form_input {
  width: 100%;
  padding: 1.05rem 1.4rem;
  border: 1.5px solid var(--border-color);
  border-radius: 1.1rem;
  background: var(--container-color);
  font-size: 1.05rem;
  transition: all 0.3s ease;
}

.form_input:focus {
  outline: none;
  border-color: var(--first-color);
  box-shadow: 0 0 0 4px rgba(var(--hue-color), 85%, 62%, 0.12);
}

/* Dark Mode Support */
.dark .form_input {
  background: hsl(var(--hue-color), 25%, 14%);
  border-color: hsl(var(--hue-color), 20%, 28%);
}

.dark .form_input:focus {
  border-color: var(--first-color);
  box-shadow: 0 0 0 4px rgba(var(--hue-color), 85%, 62%, 0.18);
}

button.button {
  margin-top: 1rem;
  width: 100%;
  justify-content: center;
}

/* Responsive */
@media (max-width: 992px) {
  .contact_grid {
    grid-template-columns: 1fr;
    gap: 4.5rem;
  }
}
</style>