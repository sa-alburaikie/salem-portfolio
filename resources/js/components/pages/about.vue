<template>
  <section class="about section" id="about">
    <div class="container">
      <h2 class="section__title">About Me</h2>
      <div class="about_container grid">
        <!-- Image Side -->
        <div class="about_img-wrapper">
          <div class="about_img glass">
            <img :src="'/upload/profile3.jpg'" alt="Salem Alburaikie">
          </div>
        </div>

        <!-- Content Side -->
        <div class="about_content">
          <p class="about_description">
            I am a passionate Full-Stack & Mobile Developer who loves crafting exceptional digital experiences. 
            With strong expertise in Laravel, Vue.js, and Flutter, I transform complex ideas into clean, 
            scalable, and high-performance solutions that users truly love.
          </p>

          <div class="about_stats grid">
            <div class="stat-item">
              <span class="stat-number">2+</span>
              <span class="stat-label">Years of Experience</span>
            </div>
            <div class="stat-item">
              <span class="stat-number">5+</span>
              <span class="stat-label">Projects Completed</span>
            </div>
            <div class="stat-item">
              <span class="stat-number">3+</span>
              <span class="stat-label">Happy Clients</span>
            </div>
          </div>

          <a href="/template/assets/pdf/salem.pdf" 
             target="_blank"
             class="button">
            Download CV
            <i class="uil uil-download-alt button_icon"></i>
          </a>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.about_container {
  grid-template-columns: 1fr 1.25fr;
  gap: 6rem;
  align-items: center;
}

.about_img-wrapper {
  position: relative;
}

.about_img {
  width: 100%;
  max-width: 420px;
  aspect-ratio: 1 / 1.15;
  border-radius: 2.5rem;
  overflow: hidden;
  border: 12px solid rgba(255,255,255,0.7);
  box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.2);
}

.about_img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.about_content {
  display: flex;
  flex-direction: column;
  gap: 2.5rem;
}

.about_description {
  font-size: 1.22rem;
  line-height: 1.85;
  color: var(--text-color);
}

.about_stats {
  grid-template-columns: repeat(3, 1fr);
  gap: 2rem;
}

.stat-item {
  text-align: center;
}

.stat-number {
  display: block;
  font-size: 3.2rem;
  font-weight: 700;
  background: var(--first-color-gradient);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  line-height: 1;
  margin-bottom: 0.4rem;
}

.stat-label {
  font-size: 0.95rem;
  color: var(--text-color-light);
  font-weight: 500;
}

@media (max-width: 992px) {
  .about_container {
    grid-template-columns: 1fr;
    gap: 4rem;
    text-align: center;
  }
  
  .about_img {
    max-width: 340px;
    margin: 0 auto;
  }
}
</style>