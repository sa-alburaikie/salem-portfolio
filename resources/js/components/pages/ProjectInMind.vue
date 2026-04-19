<template>
  <section class="project-mind section">
    <div class="project-mind_container container glass">
      <div class="project-mind_content">
        <h2 class="project-mind_title">Have a Project in Mind?</h2>
        <p class="project-mind_desc">
          Let's collaborate and build something amazing together. 
          I'm always open to new opportunities and exciting challenges.
        </p>
        <a href="#contact" class="button button--flex">
          Let's Talk
          <i class="uil uil-message"></i>
        </a>
      </div>
      
      <div class="project-mind_visual">
        <img src="/public/template/assets/img/home.png" alt="Let's Work Together">
      </div>
    </div>
  </section>
</template>

<style scoped>
.project-mind {
  padding: 6rem 0;
}

.project-mind_container {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 5rem;
  align-items: center;
  padding: 4.5rem 5rem;
  border-radius: 2.5rem;
}

.project-mind_title {
  font-size: 2.8rem;
  line-height: 1.2;
  margin-bottom: 1.5rem;
}

.project-mind_desc {
  font-size: 1.2rem;
  color: var(--text-color);
  margin-bottom: 2.5rem;
  max-width: 420px;
}

.project-mind_visual img {
  width: 100%;
  max-width: 380px;
  border-radius: 2rem;
}

@media (max-width: 992px) {
  .project-mind_container {
    grid-template-columns: 1fr;
    text-align: center;
    padding: 3.5rem 2rem;
  }
}
</style>