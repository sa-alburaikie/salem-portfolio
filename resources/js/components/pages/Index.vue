<template>
  <Header />

  <main class="main">
    <!-- HERO SECTION - أكثر فخامة -->
    <section class="hero section" id="home">
      <div class="hero_container container grid">
        <div class="hero_content">
          <h1 class="hero_title">
            Salem Mobarek<br>Alburaikie
          </h1>
          <h2 class="hero_subtitle">
            Full-Stack &amp; Mobile Developer
          </h2>
          <p class="hero_description">
            I build exceptional digital experiences using Laravel, Vue.js, and Flutter. 
            Turning ideas into high-performance, beautiful, and scalable products.
          </p>

          <div class="hero_buttons">
            <a href="#contact" class="button">Get In Touch</a>
            <a href="#portfolio" class="button button--white">View My Work</a>
          </div>

          <div class="hero_social">
            <a href="#" target="_blank"><i class="uil uil-linkedin-alt"></i></a>
            <a href="https://github.com/sa-alburaikie" target="_blank"><i class="uil uil-github-alt"></i></a>
          </div>
        </div>

        <div class="hero_img glass">
          <img :src="'/upload/profile2.jpg'" alt="Salem Alburaikie">
        </div>
      </div>
    </section>

    <About />
    <Skills />
    <Qualifications />
    <Services />
    <Projects />
    <ProjectInMind />
    <Testmonials />
    <ContactMe />
  </main>

  <Footer />

  <a href="#" class="scrollup" id="scroll-up">
    <i class="uil uil-arrow-up"></i>
  </a>
</template>

<script setup>
// نفس الكود السابق للـ scrollActive (لم يتغير)
import { onMounted, onUnmounted } from 'vue'
import Header from '../layouts/pages/Header.vue'
import Footer from '../layouts/pages/Footer.vue'
import About from './about.vue'
import Skills from './skills.vue'
import Qualifications from './Qualifications.vue'
import Services from './Services.vue'
import Projects from './Projects.vue'
import Testmonials from './Testmonials.vue'
import ContactMe from './ContactMe.vue'

const scrollActive = () => {
    const sections = document.querySelectorAll('section[id], header[id]')
    const scrollY = window.pageYOffset

    sections.forEach(current => {
        const sectionHeight = current.offsetHeight
        const sectionTop = current.offsetTop - 70
        const sectionId = current.getAttribute('id')

        const link = document.querySelector(
            `.nav_menu a[href="#${sectionId}"]`
        )

        if (!link) return

        if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
            document
                .querySelectorAll('.nav_link')
                .forEach(l => l.classList.remove('active_link'))

            link.classList.add('active_link')
        }
    })
}
onMounted(() => window.addEventListener('scroll', scrollActive))
onUnmounted(() => window.removeEventListener('scroll', scrollActive))
</script>

<style scoped>
.hero {
  min-height: 100vh;
  display: flex;
  align-items: center;
  padding-top: var(--header-height);
}

.hero_container {
  grid-template-columns: 1fr 1fr;
  gap: 5rem;
  align-items: center;
}

.hero_title {
  font-size: 4.8rem;
  line-height: 1.05;
  margin-bottom: 1rem;
}

.hero_subtitle {
  font-size: 1.85rem;
  color: var(--first-color);
  margin-bottom: 1.8rem;
}

.hero_description {
  font-size: 1.25rem;
  max-width: 520px;
  margin-bottom: 3rem;
  color: var(--text-color);
}

.hero_buttons {
  display: flex;
  gap: 1.2rem;
  margin-bottom: 4rem;
}

.hero_img {
  width: 100%;
  max-width: 460px;
  height: 460px;
  border-radius: 2.5rem;
  overflow: hidden;
  justify-self: center;
  border: 8px solid rgba(255,255,255,0.6);
}

.hero_img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.hero_social {
  display: flex;
  gap: 1.8rem;
  font-size: 1.8rem;
  padding-left: 25%;
}

.hero_social a {
  color: var(--text-color);
  transition: all 0.3s;
}

.hero_social a:hover {
  color: var(--first-color);
  transform: translateY(-5px);
}

@media (max-width: 992px) {
  .hero_container {
    grid-template-columns: 1fr;
    gap: 2rem;
    text-align: center;
  }
  .hero_social {
    padding-left: 40%;
  }
  .hero_title { font-size: 2.0rem; }
  .hero_subtitle { font-size: 1.5rem; }
  .hero_img { max-width: 200px; height: 200px;order: -1; }
}
</style>